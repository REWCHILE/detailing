<?php

namespace App\Http\Controllers;

use App\Models\BusinessHour;
use App\Models\BusinessProfile;
use App\Models\Booking;
use App\Models\BookingExtra;
use App\Models\Customer;
use App\Models\CustomerVehicle;
use App\Models\Extra;
use App\Models\Payment;
use App\Models\ScheduleBlock;
use App\Models\Service;
use App\Models\VehicleType;
use App\Models\WorkBay;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use DateTime;

class BookingController extends Controller
{
    /**
     * Display the dynamic booking stepper form.
     */
    public function showReservaPage(Request $request)
    {
        $services = Service::where('is_active', true)
            ->with(['extras' => function($q) {
                $q->where('is_active', true)->orderBy('display_order');
            }, 'vehicleTypes'])
            ->orderBy('display_order')
            ->get();

        $vehicleTypes = VehicleType::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        $businessProfile = BusinessProfile::firstOrCreate(['id' => 'default'], [
            'business_name' => 'High Contrast Detailing Center',
            'email' => 'contacto@highcontrastdetailing.cl',
            'phone' => '+56 9 1234 5678',
            'address_line1' => 'Chicureo, Colina',
            'city' => 'Colina',
            'region' => 'Región Metropolitana',
        ]);

        $allExtras = Extra::where('is_active', true)->where('price', '>', 0)->orderBy('display_order')->get();

        $path = storage_path('app/category_order.json');
        $categoryOrder = file_exists($path) ? json_decode(file_get_contents($path), true) : ['limpieza', 'correccion', 'ceramico', 'especiales'];

        return view('reserva', compact('services', 'vehicleTypes', 'businessProfile', 'categoryOrder', 'allExtras'));
    }

    /**
     * API Endpoint: Get available time slots for a given date, service, and vehicle type.
     */
    public function getAvailability(Request $request)
    {
        $request->validate([
            'date' => 'required|date_format:Y-m-d',
            'serviceId' => 'required',
            'vehicleTypeId' => 'required',
            'extraIds' => 'nullable|array',
        ]);

        $date = $request->input('date');
        $serviceId = $request->input('serviceId');
        $vehicleTypeId = $request->input('vehicleTypeId');
        $extraIds = $request->input('extraIds', []);

        // Find service, vehicle, extras
        $service = Service::where('id', $serviceId)->orWhere('slug', $serviceId)->first();
        if (!$service || !$service->is_active) {
            return response()->json(['error' => ['message' => 'Servicio no encontrado o inactivo']], 404);
        }

        $vehicleType = VehicleType::where('id', $vehicleTypeId)->orWhere('slug', $vehicleTypeId)->first();
        if (!$vehicleType || !$vehicleType->is_active) {
            return response()->json(['error' => ['message' => 'Tipo de vehículo no encontrado o inactivo']], 404);
        }

        $requiredExtras = $service->extras()->wherePivot('is_required', true)->get();
        $optionalExtras = collect();
        if (!empty($extraIds)) {
            $optionalExtras = $service->extras()
                ->wherePivot('is_required', false)
                ->where(function($q) use ($extraIds) {
                    $q->whereIn('extras.id', $extraIds)
                      ->orWhereIn('extras.slug', $extraIds);
                })
                ->get();
        }
        $extras = $requiredExtras->merge($optionalExtras)->unique('id');

        // Calculate total duration in minutes
        $durationMinutes = $service->duration_minutes + $extras->sum('duration_minutes');

        // Get weekday and business hours
        $dayOfWeek = date('l', strtotime($date)); // e.g. "Monday"
        $weekday = strtoupper($dayOfWeek); // e.g. "MONDAY"

        $businessHour = BusinessHour::where('weekday', $weekday)->first();
        if (!$businessHour || $businessHour->is_closed || is_null($businessHour->open_minute_of_day) || is_null($businessHour->close_minute_of_day)) {
            return response()->json([
                'date' => $date,
                'durationMinutes' => $durationMinutes,
                'slots' => []
            ]);
        }

        $bays = WorkBay::where('is_active', true)->orderBy('display_order')->get();
        if ($bays->isEmpty()) {
            return response()->json(['error' => ['message' => 'No hay bahías de trabajo configuradas']], 409);
        }

        $profile = BusinessProfile::firstOrCreate(['id' => 'default']);

        // Date ranges for queries
        $requestedDate = new DateTime($date);
        $startOfDay = clone $requestedDate;
        $startOfDay->setTime(0, 0, 0);
        $endOfDay = clone $requestedDate;
        $endOfDay->setTime(23, 59, 59);

        // Fetch schedule blocks and bookings for the requested day
        $blocks = ScheduleBlock::where('starts_at', '<', $endOfDay->format('Y-m-d H:i:s'))
            ->where('ends_at', '>', $startOfDay->format('Y-m-d H:i:s'))
            ->get();

        $bookings = Booking::where('start_at', '<', $endOfDay->format('Y-m-d H:i:s'))
            ->where('end_at', '>', $startOfDay->format('Y-m-d H:i:s'))
            ->where('status', '!=', 'CANCELLED')
            ->get();

        $now = new DateTime();
        
        // Allowed booking window limits
        $earliestAllowed = clone $now;
        $earliestAllowed->modify('+' . ($profile->lead_time_hours ?? 12) . ' hours');
        
        $latestAllowedDate = clone $now;
        $latestAllowedDate->setTime(0, 0, 0);
        $latestAllowedDate->modify('+' . ($profile->max_advance_days ?? 60) . ' days');

        if ($requestedDate > $latestAllowedDate) {
            return response()->json(['error' => ['message' => 'La fecha seleccionada está fuera del rango permitido.']], 400);
        }

        $dayTotalMinutes = $businessHour->close_minute_of_day - $businessHour->open_minute_of_day;
        $effectiveDurationMinutes = min($durationMinutes, $dayTotalMinutes);

        $slots = [];
        $interval = $profile->slot_interval_minutes ?? 30;

        for (
            $minute = $businessHour->open_minute_of_day;
            $minute + $effectiveDurationMinutes <= $businessHour->close_minute_of_day;
            $minute += $interval
        ) {
            $slotStart = clone $requestedDate;
            $hours = floor($minute / 60);
            $minutes = $minute % 60;
            $slotStart->setTime($hours, $minutes, 0);

            $slotEnd = clone $slotStart;
            $slotEnd->modify('+' . $durationMinutes . ' minutes');

            // Skip past slots or slots inside lead time
            if ($slotStart < $earliestAllowed) {
                continue;
            }

            // Check schedule blocks
            $blockedBySchedule = false;
            foreach ($blocks as $block) {
                $blockStart = new DateTime($block->starts_at);
                $blockEnd = new DateTime($block->ends_at);
                if ($slotStart < $blockEnd && $slotEnd > $blockStart) {
                    $blockedBySchedule = true;
                    break;
                }
            }

            if ($blockedBySchedule) {
                continue;
            }

            // Find available work bay
            $availableBayId = null;
            foreach ($bays as $bay) {
                $hasConflict = false;
                foreach ($bookings as $booking) {
                    // Check if pending booking is expired
                    $isPendingExpired = ($booking->status === 'PENDING' && $booking->expires_at && new DateTime($booking->expires_at) < $now);
                    if ($isPendingExpired) {
                        continue;
                    }

                    $bookingStart = new DateTime($booking->start_at);
                    $bookingEnd = new DateTime($booking->end_at);

                    if ($booking->bay_id === $bay->id && $slotStart < $bookingEnd && $slotEnd > $bookingStart) {
                        $hasConflict = true;
                        break;
                    }
                }

                if (!$hasConflict) {
                    $availableBayId = $bay->id;
                    break;
                }
            }

            if (!is_null($availableBayId)) {
                $slots[] = [
                    'startAt' => $slotStart->format('Y-m-d H:i:s'),
                    'endAt' => $slotEnd->format('Y-m-d H:i:s'),
                    'bayId' => $availableBayId,
                ];
            }
        }

        return response()->json([
            'date' => $date,
            'durationMinutes' => $durationMinutes,
            'slots' => $slots
        ]);
    }

    /**
     * API Endpoint: Create a new booking.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer.firstName' => 'required|string|max:255',
            'customer.lastName' => 'required|string|max:255',
            'customer.email' => 'required|email|max:255',
            'customer.phone' => 'required|string|max:255',
            'customer.notes' => 'nullable|string',
            'vehicle.vehicleTypeId' => 'required',
            'vehicle.licensePlate' => 'required|string',
            'serviceId' => 'required',
            'extraIds' => 'nullable|array',
            'date' => 'required|date_format:Y-m-d',
            'startAt' => 'required',
            'notes' => 'nullable|string',
        ]);

        $serviceId = $request->input('serviceId');
        $vehicleTypeId = $request->input('vehicle.vehicleTypeId');
        $extraIds = $request->input('extraIds', []);

        $service = Service::where('id', $serviceId)->orWhere('slug', $serviceId)->firstOrFail();
        $vehicleType = VehicleType::where('id', $vehicleTypeId)->orWhere('slug', $vehicleTypeId)->firstOrFail();
        
        $requiredExtras = $service->extras()->wherePivot('is_required', true)->get();
        $optionalExtras = collect();
        if (!empty($extraIds)) {
            $optionalExtras = $service->extras()
                ->wherePivot('is_required', false)
                ->where(function($q) use ($extraIds) {
                    $q->whereIn('extras.id', $extraIds)
                      ->orWhereIn('extras.slug', $extraIds);
                })
                ->get();
        }
        $extras = $requiredExtras->merge($optionalExtras)->unique('id');

        $durationMinutes = $service->duration_minutes + $extras->sum('duration_minutes');
        $startAt = new DateTime($request->input('startAt'));
        $endAt = clone $startAt;
        $endAt->modify('+' . $durationMinutes . ' minutes');

        // Check availability (double check to prevent double bookings)
        $conflicting = Booking::where('bay_id', $request->input('startAt_bayId') ?? DB::raw('bay_id'))
            ->where('start_at', '<', $endAt->format('Y-m-d H:i:s'))
            ->where('end_at', '>', $startAt->format('Y-m-d H:i:s'))
            ->where('status', '!=', 'CANCELLED')
            ->first();

        // Generate public booking ID
        $publicId = 'hc_' . Str::lower(Str::random(12));
        $externalReference = 'booking_' . $publicId . '_' . Str::random(8);

        $subtotal = $service->getPriceForVehicleType($vehicleType->id);
        $extrasTotal = $extras->sum('price');
        $totalAmount = $subtotal + $extrasTotal;

        $profile = BusinessProfile::firstOrCreate(['id' => 'default']);
        $now = new DateTime();
        $expiresAt = $profile->payment_gateway_enabled ? (clone $now)->modify('+' . ($profile->booking_hold_minutes ?? 15) . ' minutes') : null;
        $bookingStatus = $profile->payment_gateway_enabled ? 'PENDING' : 'CONFIRMED';

        $customerEmail = strtolower(trim($request->input('customer.email')));
        $customerPhone = trim($request->input('customer.phone'));
        $licensePlate = trim($request->input('vehicle.licensePlate'));
        $normalizedPlate = strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $licensePlate));

        try {
            $result = DB::transaction(function () use ($request, $service, $vehicleType, $extras, $startAt, $endAt, $expiresAt, $bookingStatus, $publicId, $externalReference, $subtotal, $extrasTotal, $totalAmount, $customerEmail, $customerPhone, $normalizedPlate, $profile, $durationMinutes, $now) {
                // Find or create customer
                $customer = Customer::where('email', $customerEmail)
                    ->orWhere('phone', $customerPhone)
                    ->first();

                $customerData = [
                    'first_name' => $request->input('customer.firstName'),
                    'last_name' => $request->input('customer.lastName'),
                    'email' => $customerEmail,
                    'phone' => $customerPhone,
                    'notes' => $request->input('customer.notes'),
                ];

                if (!$customer) {
                    $customer = Customer::create(array_merge($customerData, ['id' => (string) Str::ulid()]));
                } else {
                    $customer->update($customerData);
                }

                // Check plate conflict
                $existingVehicle = CustomerVehicle::where('license_plate_normalized', $normalizedPlate)->first();
                if ($existingVehicle && $existingVehicle->customer_id !== $customer->id) {
                    throw new \Exception('LICENSE_PLATE_ALREADY_REGISTERED');
                }

                $vehicleData = [
                    'vehicle_type_id' => $vehicleType->id,
                    'license_plate' => $request->input('vehicle.licensePlate'),
                    'license_plate_normalized' => $normalizedPlate,
                ];

                if (!$existingVehicle) {
                    $vehicle = CustomerVehicle::create(array_merge($vehicleData, [
                        'id' => (string) Str::ulid(),
                        'customer_id' => $customer->id,
                    ]));
                } else {
                    $existingVehicle->update($vehicleData);
                    $vehicle = $existingVehicle;
                }

                // Assign to work bay: pick the first active bay or search available
                $activeBays = WorkBay::where('is_active', true)->orderBy('display_order')->get();
                if ($activeBays->isEmpty()) {
                    throw new \Exception('NO_ACTIVE_BAYS');
                }
                
                // Search conflict-free bay
                $selectedBayId = $activeBays->first()->id;
                foreach ($activeBays as $bay) {
                    $conflict = Booking::where('bay_id', $bay->id)
                        ->where('start_at', '<', $endAt->format('Y-m-d H:i:s'))
                        ->where('end_at', '>', $startAt->format('Y-m-d H:i:s'))
                        ->where('status', '!=', 'CANCELLED')
                        ->first();
                    if (!$conflict) {
                        $selectedBayId = $bay->id;
                        break;
                    }
                }

                // Create Booking
                $booking = Booking::create([
                    'id' => (string) Str::ulid(),
                    'public_id' => $publicId,
                    'customer_id' => $customer->id,
                    'customer_vehicle_id' => $vehicle->id,
                    'service_id' => $service->id,
                    'bay_id' => $selectedBayId,
                    'start_at' => $startAt->format('Y-m-d H:i:s'),
                    'end_at' => $endAt->format('Y-m-d H:i:s'),
                    'expires_at' => $expiresAt ? $expiresAt->format('Y-m-d H:i:s') : null,
                    'status' => $bookingStatus,
                    'payment_status' => 'PENDING',
                    'channel' => 'WEB',
                    'notes' => $request->input('notes'),
                    'service_name_snapshot' => $service->name,
                    'service_base_price_snapshot' => $service->base_price,
                    'vehicle_type_name_snapshot' => $vehicleType->name,
                    'vehicle_multiplier_snapshot' => $vehicleType->price_multiplier,
                    'duration_minutes' => $durationMinutes,
                    'subtotal_amount' => $subtotal,
                    'extras_amount' => $extrasTotal,
                    'total_amount' => $totalAmount,
                    'confirmed_at' => $profile->payment_gateway_enabled ? null : $now->format('Y-m-d H:i:s'),
                ]);

                // Booking Extras
                foreach ($extras as $extra) {
                    BookingExtra::create([
                        'id' => (string) Str::ulid(),
                        'booking_id' => $booking->id,
                        'extra_id' => $extra->id,
                        'name_snapshot' => $extra->name,
                        'price_snapshot' => $extra->price,
                        'duration_minutes_snapshot' => $extra->duration_minutes,
                    ]);
                }

                // Create Payment record
                $payment = Payment::create([
                    'id' => (string) Str::ulid(),
                    'booking_id' => $booking->id,
                    'provider' => $profile->payment_gateway_enabled ? 'MERCADO_PAGO' : 'MANUAL',
                    'external_reference' => $externalReference,
                    'amount' => $totalAmount,
                    'status' => 'PENDING',
                    'expires_at' => $expiresAt ? $expiresAt->format('Y-m-d H:i:s') : null,
                ]);

                return ['booking' => $booking, 'payment' => $payment];
            });

            // If gateway enabled, prepare preference checkout Url
            $checkoutUrl = null;
            if ($profile->payment_gateway_enabled) {
                $pref = \App\Services\PaymentService::createCheckoutPreference($result['booking'], $result['payment']);
                $checkoutUrl = $pref['checkout_url'] ?? null;
                $result['payment']->update([
                    'checkout_url' => $checkoutUrl,
                    'provider_preference_id' => $pref['preference_id'] ?? null,
                ]);
            } else {
                try {
                    \App\Services\EmailService::sendBookingEmail($result['booking'], 'CONFIRMED');
                    \App\Services\EmailService::sendQuoteNotificationEmails($result['booking']);
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error("[SMTP] Error sending confirmation email for manual booking: " . $e->getMessage());
                }
            }

            // Mark draft quote as recovered
            if ($sessionId = $request->input('sessionId')) {
                self::ensureAbandonedQuotesTableExists();
                \App\Models\AbandonedQuote::where('session_id', $sessionId)->update(['status' => 'RECOVERED']);
            }

            return response()->json([
                'booking' => [
                    'publicId' => $result['booking']->public_id,
                    'totalAmount' => $result['booking']->total_amount,
                ],
                'payment' => [
                    'checkoutUrl' => $checkoutUrl,
                ]
            ], 201);

        } catch (\Exception $e) {
            if ($e->getMessage() === 'LICENSE_PLATE_ALREADY_REGISTERED') {
                return response()->json(['error' => ['message' => 'Esta patente ya está asociada a otro cliente. Por favor contáctanos para completar la reserva.']], 409);
            }
            if ($e->getMessage() === 'NO_ACTIVE_BAYS') {
                return response()->json(['error' => ['message' => 'No hay bahías de trabajo configuradas actualmente.']], 409);
            }
            \Illuminate\Support\Facades\Log::error('[Booking] Store error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['error' => ['message' => 'Error al crear la reserva. Por favor intenta nuevamente.']], 500);
        }
    }

    /**
     * Show booking state and detail screen.
     */
    public function show($publicId, Request $request)
    {
        $cleanId = trim($publicId);

        $booking = Booking::where('public_id', $cleanId)
            ->orWhere('id', $cleanId)
            ->orWhere(DB::raw('LOWER(public_id)'), strtolower($cleanId))
            ->with(['customer', 'customerVehicle.vehicleType', 'extras', 'payments' => function($q) {
                $q->orderBy('created_at', 'desc');
            }])
            ->first();

        if (!$booking) {
            return response()->view('errors.404-reserva', ['publicId' => $cleanId], 404);
        }

        // Simulate payment approval — ONLY available in local environment for testing
        if (app()->environment('local') && $request->has('simulate_pay') && $booking->payment_status !== 'PAID') {
            $booking->update([
                'status' => 'CONFIRMED',
                'payment_status' => 'PAID',
                'confirmed_at' => now(),
            ]);
            $payment = $booking->payments->first();
            if ($payment) {
                $payment->update([
                    'status' => 'PAID',
                    'paid_at' => now(),
                ]);
            }
            return redirect()->route('booking.status', ['publicId' => $booking->public_id]);
        }

        $profile = BusinessProfile::firstOrCreate(['id' => 'default']);
        $onlinePaymentsActive = $profile->payment_gateway_enabled || $profile->show_prices;

        return view('reserva-estado', compact('booking', 'onlinePaymentsActive'));
    }

    /**
     * API Endpoint: Get day capacity statuses (free, pending, taken) for a month.
     */
    public function getMonthStatus(Request $request)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m',
            'serviceId' => 'nullable',
            'vehicleTypeId' => 'nullable',
            'extraIds' => 'nullable|array',
        ]);

        $month = $request->input('month');
        $serviceId = $request->input('serviceId');
        $vehicleTypeId = $request->input('vehicleTypeId');
        $extraIds = $request->input('extraIds', []);

        $year = date('Y', strtotime($month . '-01'));
        $monthNum = date('m', strtotime($month . '-01'));
        
        // Handle cal_days_in_month fallback if ext-calendar not installed
        if (function_exists('cal_days_in_month')) {
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $monthNum, $year);
        } else {
            $daysInMonth = (int)date('t', strtotime($month . '-01'));
        }

        $statuses = [];

        // Preload business hours
        $businessHours = BusinessHour::all()->keyBy('weekday');

        // Preload active bays
        $baysCount = WorkBay::where('is_active', true)->count();
        if ($baysCount === 0) {
            $baysCount = 1;
        }

        // Loop through each day of the month
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dateStr = sprintf('%s-%02d-%02d', $month, $day);
            $dayOfWeek = date('l', strtotime($dateStr));
            $weekday = strtoupper($dayOfWeek);

            // 1. Check if closed
            $bh = $businessHours->get($weekday);
            if (!$bh || $bh->is_closed || is_null($bh->open_minute_of_day)) {
                $statuses[$dateStr] = 'taken'; // Closed is 'taken' (red)
                continue;
            }

            // 2. Check if date is in the past
            $today = date('Y-m-d');
            if ($dateStr < $today) {
                $statuses[$dateStr] = 'taken';
                continue;
            }

            // 3. Check schedule blocks and bookings
            $startOfDay = $dateStr . ' 00:00:00';
            $endOfDay = $dateStr . ' 23:59:59';

            $fullDayBlock = ScheduleBlock::where('starts_at', '<=', $startOfDay)
                ->where('ends_at', '>=', $endOfDay)
                ->exists();

            if ($fullDayBlock) {
                $statuses[$dateStr] = 'taken';
                continue;
            }

            // Count active bookings
            $bookingsCount = Booking::where('start_at', '<', $endOfDay)
                ->where('end_at', '>', $startOfDay)
                ->where('status', '!=', 'CANCELLED')
                ->count();

            // If we have serviceId and vehicleTypeId, we can calculate slots count.
            if ($serviceId && $vehicleTypeId) {
                $subRequest = new Request([
                    'date' => $dateStr,
                    'serviceId' => $serviceId,
                    'vehicleTypeId' => $vehicleTypeId,
                    'extraIds' => $extraIds
                ]);
                
                $response = $this->getAvailability($subRequest);
                $data = json_decode($response->getContent(), true);
                
                if (isset($data['slots']) && count($data['slots']) > 0) {
                    $statuses[$dateStr] = $bookingsCount > 0 ? 'pending' : 'free';
                } else {
                    $statuses[$dateStr] = 'taken';
                }
            } else {
                // Approximate:
                if ($bookingsCount >= ($baysCount * 3)) {
                    $statuses[$dateStr] = 'taken';
                } elseif ($bookingsCount > 0) {
                    $statuses[$dateStr] = 'pending';
                } else {
                    $statuses[$dateStr] = 'free';
                }
            }
        }

        return response()->json($statuses);
    }

    /**
     * POST /api/payments/webhook
     * Process MercadoPago payment notifications
     */
    public function webhook(Request $request)
    {
        $paymentId = $request->input('data.id') ?? $request->input('id');
        $type = $request->input('type') ?? $request->input('topic');

        \Illuminate\Support\Facades\Log::info("[MercadoPago Webhook] Received: id={$paymentId}, type={$type}");

        // Verify webhook signature if a secret is configured
        $profile = \App\Models\BusinessProfile::firstOrCreate(['id' => 'default']);
        $webhookSecret = trim($profile->mercado_pago_webhook_secret ?? env('MERCADO_PAGO_WEBHOOK_SECRET', ''));

        if (!empty($webhookSecret)) {
            $xSignature = $request->header('x-signature', '');
            $xRequestId = $request->header('x-request-id', '');

            if (!$this->verifyWebhookSignature($xSignature, $xRequestId, $paymentId, $webhookSecret)) {
                \Illuminate\Support\Facades\Log::warning('[MercadoPago Webhook] Invalid signature rejected.', [
                    'ip' => $request->ip(),
                    'payload' => $request->all(),
                ]);
                return response()->json(['status' => 'unauthorized'], 401);
            }
        }

        if ($paymentId && ($type === 'payment' || $type === 'chargeback')) {
            $success = \App\Services\PaymentService::syncPayment((string)$paymentId);
            if ($success) {
                return response()->json(['status' => 'success'], 200);
            }
        }

        // Return 200 anyway so MP does not retry indefinitely for unhandled topics
        return response()->json(['status' => 'ignored'], 200);
    }

    /**
     * Verify MercadoPago webhook x-signature header using HMAC-SHA256.
     * @see https://www.mercadopago.com.co/developers/en/docs/your-integrations/notifications/webhooks#verifyingsignature
     */
    private function verifyWebhookSignature(string $xSignature, string $xRequestId, ?string $dataId, string $secret): bool
    {
        if (empty($xSignature)) {
            return false;
        }

        // Parse x-signature header: "ts=...,v1=..."
        $parts = [];
        foreach (explode(',', $xSignature) as $segment) {
            $kv = explode('=', trim($segment), 2);
            if (count($kv) === 2) {
                $parts[$kv[0]] = $kv[1];
            }
        }

        $ts = $parts['ts'] ?? '';
        $v1 = $parts['v1'] ?? '';

        if (empty($ts) || empty($v1)) {
            return false;
        }

        // Build the manifest string as specified by MercadoPago
        $manifest = "id:{$dataId};request-id:{$xRequestId};ts:{$ts};";
        $computedHash = hash_hmac('sha256', $manifest, $secret);

        return hash_equals($computedHash, $v1);
    }

    /**
     * Ensure abandoned_quotes table exists in database automatically.
     */
    public static function ensureAbandonedQuotesTableExists()
    {
        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('abandoned_quotes')) {
                \Illuminate\Support\Facades\Schema::create('abandoned_quotes', function (\Illuminate\Database\Schema\Blueprint $table) {
                    $table->ulid('id')->primary();
                    $table->string('session_id', 100)->index();
                    $table->string('customer_name')->nullable();
                    $table->string('customer_email')->nullable()->index();
                    $table->string('customer_phone')->nullable()->index();
                    $table->string('commune')->nullable();
                    $table->string('vehicle_type_name')->nullable();
                    $table->string('service_name')->nullable();
                    $table->json('extras')->nullable();
                    $table->integer('total_price')->default(0);
                    $table->integer('last_step_reached')->default(1);
                    $table->enum('status', ['DRAFT', 'RECOVERED', 'CANCELLED'])->default('DRAFT')->index();
                    $table->timestamp('last_activity_at')->useCurrent()->index();
                    $table->timestamps();
                });
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('[AbandonedQuote] Table check failed: ' . $e->getMessage());
        }
    }

    /**
     * API Endpoint: Auto-save or update draft lead (abandoned quote).
     */
    public function saveDraftLead(Request $request)
    {
        self::ensureAbandonedQuotesTableExists();

        $sessionId = $request->input('sessionId');
        if (!$sessionId) {
            return response()->json(['error' => 'Session ID is required'], 422);
        }

        $customerName = trim($request->input('customer.name', ''));
        $customerEmail = trim($request->input('customer.email', ''));
        $customerPhone = trim($request->input('customer.phone', ''));
        $commune = trim($request->input('customer.commune', ''));

        $vehicle = $request->input('vehicle');
        $service = $request->input('service');

        $existing = \App\Models\AbandonedQuote::where('session_id', $sessionId)->first();
        $status = ($existing && $existing->status === 'RECOVERED') ? 'RECOVERED' : 'DRAFT';

        $draft = \App\Models\AbandonedQuote::updateOrCreate(
            ['session_id' => $sessionId],
            [
                'customer_name' => $customerName ?: ($existing?->customer_name ?? null),
                'customer_email' => $customerEmail ?: ($existing?->customer_email ?? null),
                'customer_phone' => $customerPhone ?: ($existing?->customer_phone ?? null),
                'commune' => $commune ?: ($existing?->commune ?? null),
                'vehicle_type_name' => is_array($vehicle) ? ($vehicle['name'] ?? null) : ($existing?->vehicle_type_name ?? null),
                'service_name' => is_array($service) ? ($service['name'] ?? null) : ($existing?->service_name ?? null),
                'extras' => $request->input('extras', $existing?->extras ?? []),
                'total_price' => (int) $request->input('totalPrice', $existing?->total_price ?? 0),
                'last_step_reached' => (int) $request->input('step', $existing?->last_step_reached ?? 1),
                'status' => $status,
                'last_activity_at' => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'sessionId' => $sessionId,
            'draftId' => $draft->id,
        ]);
    }
}
