<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Extra;
use App\Models\CustomerVehicle;
use App\Models\BusinessProfile;
use App\Models\BusinessHour;
use App\Models\WorkBay;
use App\Models\ScheduleBlock;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display the main admin dashboard statistics and list.
     */
    public function index()
    {
        $todayStart = Carbon::today('America/Santiago')->startOfDay()->timezone('UTC');
        $todayEnd = Carbon::today('America/Santiago')->endOfDay()->timezone('UTC');
        
        // Stats
        $todayCount = Booking::whereBetween('start_at', [$todayStart, $todayEnd])
            ->where('status', '!=', 'CANCELLED')
            ->count();
        
        $pendingCount = Booking::whereIn('status', ['PENDING', 'CONFIRMED', 'IN_PROGRESS'])->count();
        
        $completedCount = Booking::where('status', 'COMPLETED')->count();
        
        $totalRevenue = Booking::where('payment_status', 'PAID')->sum('total_amount');

        // Recent bookings (last 8)
        $recentBookings = Booking::with(['customer', 'customerVehicle'])
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        return view('admin.dashboard', compact(
            'todayCount',
            'pendingCount',
            'completedCount',
            'totalRevenue',
            'recentBookings'
        ));
    }

    /**
     * Display the calendar view of appointments.
     */
    public function calendario()
    {
        // Fetch active bays and recent bookings for calendar rendering
        $bays = WorkBay::where('is_active', true)->orderBy('display_order')->get();
        $services = Service::where('is_active', true)->with('extras')->orderBy('display_order')->get();
        $vehicleTypes = VehicleType::where('is_active', true)->orderBy('display_order')->get();
        return view('admin.calendario', compact('bays', 'services', 'vehicleTypes'));
    }

    /**
     * API: Get events in calendar JSON format.
     */
    public function getCalendarioEvents(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');

        $query = Booking::with(['customer', 'customerVehicle.vehicleType', 'bay'])
            ->where('status', '!=', 'CANCELLED');

        if ($start) {
            $query->where('start_at', '>=', $start);
        }
        if ($end) {
            $query->where('end_at', '<=', $end);
        }

        $bookings = $query->get();

        $events = $bookings->map(function($booking) {
            return [
                'id' => $booking->id,
                'title' => ($booking->customer->first_name ?? '') . ' - ' . ($booking->service_name_snapshot ?? ''),
                'start' => $booking->start_at->toIso8601String(),
                'end' => $booking->end_at->toIso8601String(),
                'resourceId' => $booking->bay_id,
                'color' => $booking->status?->value === 'CONFIRMED' ? '#22C55E' : ($booking->status?->value === 'IN_PROGRESS' ? '#3B82F6' : '#F59E0B'),
                'extendedProps' => [
                    'publicId' => $booking->public_id,
                    'customerName' => ($booking->customer->first_name ?? '') . ' ' . ($booking->customer->last_name ?? ''),
                    'phone' => $booking->customer->phone ?? '',
                    'vehicle' => ($booking->customerVehicle->license_plate ?? '') . ' (' . ($booking->vehicle_type_name_snapshot ?? '') . ')',
                    'service' => $booking->service_name_snapshot,
                    'amount' => '$' . number_format($booking->total_amount, 0, ',', '.'),
                    'status' => $booking->status?->value,
                    'paymentStatus' => $booking->payment_status?->value,
                ]
            ];
        });

        // Add blocks as full-day or timed blocks
        $blocksQuery = ScheduleBlock::query();
        if ($start) {
            $blocksQuery->where('starts_at', '>=', $start);
        }
        if ($end) {
            $blocksQuery->where('ends_at', '<=', $end);
        }
        $blocks = $blocksQuery->get();

        $blockEvents = $blocks->map(function($block) {
            return [
                'id' => 'block_' . $block->id,
                'title' => '🔒 ' . $block->title,
                'start' => Carbon::parse($block->starts_at)->toIso8601String(),
                'end' => Carbon::parse($block->ends_at)->toIso8601String(),
                'allDay' => (bool)$block->all_day,
                'overlap' => false,
                'color' => '#EF4444',
            ];
        });

        return response()->json(array_merge($events->toArray(), $blockEvents->toArray()));
    }

    /**
     * POST /api/admin/schedule-blocks
     * Create a manual schedule block.
     */
    public function storeScheduleBlock(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'starts_at' => 'required|date_format:Y-m-d H:i:s',
            'ends_at' => 'required|date_format:Y-m-d H:i:s|after:starts_at',
            'block_type' => 'required|string',
        ]);

        $block = ScheduleBlock::create([
            'id' => (string) \Illuminate\Support\Str::ulid(),
            'title' => $request->input('title'),
            'starts_at' => $request->input('starts_at'),
            'ends_at' => $request->input('ends_at'),
            'block_type' => $request->input('block_type'),
            'created_by_id' => auth()->id(),
        ]);

        return response()->json($block, 201);
    }

    public function deleteScheduleBlock($id)
    {
        $block = ScheduleBlock::findOrFail($id);
        $block->delete();
        return response()->json(['message' => 'Bloqueo eliminado correctamente']);
    }

    /**
     * API: Create a new booking directly from the admin panel calendar.
     */
    public function storeBooking(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'vehicleTypeId' => 'required',
            'licensePlate' => 'required|string',
            'serviceId' => 'required',
            'extraIds' => 'nullable|array',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
            'bayId' => 'nullable|string',
            'notes' => 'nullable|string',
            'payment_status' => 'required|in:PENDING,PAID',
        ]);

        $serviceId = $request->input('serviceId');
        $vehicleTypeId = $request->input('vehicleTypeId');
        $extraIds = $request->input('extraIds', []);

        $service = Service::findOrFail($serviceId);
        $vehicleType = VehicleType::findOrFail($vehicleTypeId);
        $extras = Extra::whereIn('id', $extraIds)->get();

        $durationMinutes = $service->duration_minutes + $extras->sum('duration_minutes');
        
        $startAt = new \DateTime($request->input('date') . ' ' . $request->input('time') . ':00');
        $endAt = clone $startAt;
        $endAt->modify('+' . $durationMinutes . ' minutes');

        // Check if there is an active bay
        $activeBays = WorkBay::where('is_active', true)->orderBy('display_order')->get();
        if ($activeBays->isEmpty()) {
            return response()->json(['error' => ['message' => 'No hay bahías de trabajo activas configuradas.']], 422);
        }

        $selectedBayId = $request->input('bayId');
        if (!$selectedBayId || $selectedBayId === 'auto') {
            // Find a conflict-free bay
            $selectedBayId = null;
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

            if (!$selectedBayId) {
                return response()->json(['error' => ['message' => 'No hay bahías disponibles para el horario y duración seleccionados.']], 422);
            }
        } else {
            // Check conflict for specific bay selected by admin
            $conflict = Booking::where('bay_id', $selectedBayId)
                ->where('start_at', '<', $endAt->format('Y-m-d H:i:s'))
                ->where('end_at', '>', $startAt->format('Y-m-d H:i:s'))
                ->where('status', '!=', 'CANCELLED')
                ->first();
            if ($conflict) {
                return response()->json(['error' => ['message' => 'La bahía seleccionada ya está ocupada en este horario.']], 422);
            }
        }

        $publicId = 'hc_' . \Illuminate\Support\Str::lower(\Illuminate\Support\Str::random(12));
        
        $subtotal = $service->getPriceForVehicleType($vehicleType->id);
        $extrasTotal = $extras->sum('price');
        $totalAmount = $subtotal + $extrasTotal;

        $customerEmail = strtolower(trim($request->input('email')));
        $customerPhone = trim($request->input('phone'));
        $normalizedPlate = strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $request->input('licensePlate')));

        try {
            DB::transaction(function () use ($request, $service, $vehicleType, $extras, $startAt, $endAt, $publicId, $subtotal, $extrasTotal, $totalAmount, $customerEmail, $customerPhone, $normalizedPlate, $selectedBayId) {
                // Find or create customer
                $customer = Customer::where('email', $customerEmail)
                    ->orWhere('phone', $customerPhone)
                    ->first();

                $customerData = [
                    'first_name' => $request->input('firstName'),
                    'last_name' => $request->input('lastName'),
                    'email' => $customerEmail,
                    'phone' => $customerPhone,
                ];

                if (!$customer) {
                    $customer = Customer::create(array_merge($customerData, ['id' => (string) \Illuminate\Support\Str::ulid()]));
                } else {
                    $customer->update($customerData);
                }

                // Check plate conflict
                $existingVehicle = CustomerVehicle::where('license_plate_normalized', $normalizedPlate)->first();
                if ($existingVehicle && $existingVehicle->customer_id !== $customer->id) {
                    throw new \Exception('La patente ya está registrada para otro cliente.');
                }

                $vehicleData = [
                    'vehicle_type_id' => $vehicleType->id,
                    'license_plate' => $request->input('licensePlate'),
                    'license_plate_normalized' => $normalizedPlate,
                ];

                if (!$existingVehicle) {
                    $vehicle = CustomerVehicle::create(array_merge($vehicleData, [
                        'id' => (string) \Illuminate\Support\Str::ulid(),
                        'customer_id' => $customer->id,
                    ]));
                } else {
                    $existingVehicle->update($vehicleData);
                    $vehicle = $existingVehicle;
                }

                // Create Booking
                $booking = Booking::create([
                    'id' => (string) \Illuminate\Support\Str::ulid(),
                    'public_id' => $publicId,
                    'customer_id' => $customer->id,
                    'customer_vehicle_id' => $vehicle->id,
                    'service_id' => $service->id,
                    'bay_id' => $selectedBayId,
                    'start_at' => $startAt->format('Y-m-d H:i:s'),
                    'end_at' => $endAt->format('Y-m-d H:i:s'),
                    'status' => 'CONFIRMED',
                    'payment_status' => $request->input('payment_status'),
                    'channel' => 'ADMIN',
                    'notes' => $request->input('notes'),
                    'service_name_snapshot' => $service->name,
                    'service_base_price_snapshot' => $service->base_price,
                    'vehicle_type_name_snapshot' => $vehicleType->name,
                    'vehicle_multiplier_snapshot' => $vehicleType->price_multiplier,
                    'duration_minutes' => $service->duration_minutes + $extras->sum('duration_minutes'),
                    'subtotal_amount' => $subtotal,
                    'extras_amount' => $extrasTotal,
                    'total_amount' => $totalAmount,
                    'currency' => 'CLP',
                ]);

                // Create booking extras mapping
                foreach ($extras as $extra) {
                    \App\Models\BookingExtra::create([
                        'id' => (string) \Illuminate\Support\Str::ulid(),
                        'booking_id' => $booking->id,
                        'extra_id' => $extra->id,
                        'name_snapshot' => $extra->name,
                        'price_snapshot' => $extra->price,
                        'duration_minutes_snapshot' => $extra->duration_minutes,
                    ]);
                }
            });

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => ['message' => $e->getMessage()]], 422);
        }
    }

    /**
     * GET /admin/citas
     * Display a list of all bookings/appointments.
     */
    public function citasIndex(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $query = Booking::with(['customer', 'customerVehicle'])
            ->orderBy('start_at', 'desc');

        if ($search) {
            $escapedSearch = str_replace(['%', '_'], ['\%', '\_'], $search);
            $query->where(function($qBuilder) use ($escapedSearch) {
                $qBuilder->whereHas('customer', function($q) use ($escapedSearch) {
                    $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$escapedSearch}%"])
                      ->orWhere('first_name', 'like', "%{$escapedSearch}%")
                      ->orWhere('last_name', 'like', "%{$escapedSearch}%")
                      ->orWhere('email', 'like', "%{$escapedSearch}%")
                      ->orWhere('phone', 'like', "%{$escapedSearch}%");
                })->orWhereHas('customerVehicle', function($q) use ($escapedSearch) {
                    $q->where('license_plate', 'like', "%{$escapedSearch}%");
                })->orWhere('public_id', 'like', "%{$escapedSearch}%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $bookings = $query->paginate(20);

        return view('admin.citas', compact('bookings', 'search', 'status'));
    }

    /**
     * PUT /api/admin/bookings/{id}/status
     * Update the status and payment status of a booking.
     */
    public function updateBookingStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'payment_status' => 'required|string',
            'send_email' => 'boolean'
        ]);

        try {
            $booking = Booking::with('customer', 'customerVehicle')->findOrFail($id);
            
            $oldStatus = $booking->status->value;
            $newStatus = $request->input('status');
            
            $booking->status = \App\Enums\BookingStatus::from($newStatus);
            $booking->payment_status = \App\Enums\PaymentStatus::from($request->input('payment_status'));
            
            // Set timestamp based on status
            if ($newStatus === 'CONFIRMED' && $oldStatus !== 'CONFIRMED') {
                $booking->confirmed_at = now();
            } elseif ($newStatus === 'COMPLETED' && $oldStatus !== 'COMPLETED') {
                $booking->completed_at = now();
            } elseif ($newStatus === 'CANCELLED' && $oldStatus !== 'CANCELLED') {
                $booking->cancelled_at = now();
            }
            
            $booking->save();

            // Handle optional email sending
            if ($request->boolean('send_email')) {
                if ($newStatus === 'CONFIRMED') {
                    \App\Services\EmailService::sendBookingEmail($booking, 'CONFIRMED');
                } elseif ($newStatus === 'CANCELLED') {
                    \App\Services\EmailService::sendBookingEmail($booking, 'CANCELLED');
                }
            }

            return response()->json(['success' => true, 'message' => 'Estado actualizado correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al actualizar: ' . $e->getMessage()], 500);
        }
    }

    /**
     * DELETE /api/admin/bookings/{id}
     * Delete a booking permanently.
     */
    public function deleteBooking($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->delete();
            return response()->json(['success' => true, 'message' => 'Cita eliminada permanentemente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al eliminar: ' . $e->getMessage()], 500);
        }
    }

    /**
     * GET /admin/clientes
     * Display a list of all clients/customers.
     */
    public function clientesIndex(Request $request)
    {
        $search = $request->input('search');
        
        $query = Customer::withCount('bookings')
            ->orderBy('bookings_count', 'desc');

        if ($search) {
            $escapedSearch = str_replace(['%', '_'], ['\%', '\_'], $search);
            $query->where('first_name', 'like', "%{$escapedSearch}%")
                  ->orWhere('last_name', 'like', "%{$escapedSearch}%")
                  ->orWhere('email', 'like', "%{$escapedSearch}%")
                  ->orWhere('phone', 'like', "%{$escapedSearch}%");
        }

        $customers = $query->paginate(20);

        return view('admin.clientes', compact('customers', 'search'));
    }

    /**
     * GET /admin/leads
     * Display live quotation leads and abandoned quotes with instant WhatsApp actions.
     */
    public function leadsIndex(Request $request)
    {
        \App\Http\Controllers\BookingController::ensureAbandonedQuotesTableExists();

        $filter = $request->input('filter', 'all'); // all, with_phone, draft, recovered, contacted
        $search = $request->input('search');

        $query = \App\Models\AbandonedQuote::query();

        // Search
        if ($search) {
            $escapedSearch = str_replace(['%', '_'], ['\%', '\_'], $search);
            $query->where(function($q) use ($escapedSearch) {
                $q->where('customer_name', 'like', "%{$escapedSearch}%")
                  ->orWhere('customer_phone', 'like', "%{$escapedSearch}%")
                  ->orWhere('customer_email', 'like', "%{$escapedSearch}%")
                  ->orWhere('service_name', 'like', "%{$escapedSearch}%")
                  ->orWhere('commune', 'like', "%{$escapedSearch}%");
            });
        }

        // Filter
        if ($filter === 'with_phone') {
            $query->whereNotNull('customer_phone')->where('customer_phone', '!=', '');
        } elseif ($filter === 'draft') {
            $query->where('status', 'DRAFT');
        } elseif ($filter === 'recovered') {
            $query->where('status', 'RECOVERED');
        } elseif ($filter === 'contacted') {
            $query->where('status', 'CONTACTED');
        }

        $leads = $query->orderByDesc('last_activity_at')->paginate(25)->withQueryString();

        // Key stats
        $totalLeads = \App\Models\AbandonedQuote::count();
        $totalWithPhone = \App\Models\AbandonedQuote::whereNotNull('customer_phone')->where('customer_phone', '!=', '')->count();
        $totalDraftValue = \App\Models\AbandonedQuote::where('status', 'DRAFT')->sum('total_price');
        $activeTodayCount = \App\Models\AbandonedQuote::where('last_activity_at', '>=', now()->startOfDay())->count();
        $recoveredCount = \App\Models\AbandonedQuote::where('status', 'RECOVERED')->count();
        $contactedCount = \App\Models\AbandonedQuote::where('status', 'CONTACTED')->count();

        return view('admin.leads', compact(
            'leads',
            'filter',
            'search',
            'totalLeads',
            'totalWithPhone',
            'totalDraftValue',
            'activeTodayCount',
            'recoveredCount',
            'contactedCount'
        ));
    }

    /**
     * POST /api/admin/leads/{id}/status
     * Update lead status (DRAFT, CONTACTED, RECOVERED, CANCELLED).
     */
    public function updateLeadStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $lead = \App\Models\AbandonedQuote::findOrFail($id);
        $lead->update(['status' => $request->input('status')]);

        return response()->json(['success' => true, 'message' => 'Estado del lead actualizado.']);
    }

    /**
     * DELETE /api/admin/leads/{id}
     * Delete an abandoned quote or lead.
     */
    public function deleteLead($id)
    {
        $lead = \App\Models\AbandonedQuote::findOrFail($id);
        $lead->delete();

        return response()->json(['success' => true, 'message' => 'Lead eliminado correctamente.']);
    }
}
