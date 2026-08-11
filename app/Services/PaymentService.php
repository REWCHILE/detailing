<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\BusinessProfile;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentService
{
    /**
     * Resolves the Mercado Pago credential config based on default settings or database business profile.
     */
    public static function resolveConfig(BusinessProfile $profile)
    {
        if (!$profile->payment_gateway_enabled) {
            return null;
        }

        $mode = $profile->payment_gateway_mode ?? 'TEST';
        
        $genericPublicKey = trim(env('MERCADO_PAGO_PUBLIC_KEY', ''));
        $genericAccessToken = trim(env('MERCADO_PAGO_ACCESS_TOKEN', ''));

        if ($mode === 'TEST') {
            $publicKey = trim($profile->mercado_pago_public_key_test ?? '') ?: trim(env('MERCADO_PAGO_PUBLIC_KEY_TEST', '')) ?: $genericPublicKey;
            $accessToken = trim($profile->mercado_pago_access_token_test ?? '') ?: trim(env('MERCADO_PAGO_ACCESS_TOKEN_TEST', '')) ?: $genericAccessToken;
        } else {
            $publicKey = trim($profile->mercado_pago_public_key_production ?? '') ?: trim(env('MERCADO_PAGO_PUBLIC_KEY_PRODUCTION', '')) ?: $genericPublicKey;
            $accessToken = trim($profile->mercado_pago_access_token_production ?? '') ?: trim(env('MERCADO_PAGO_ACCESS_TOKEN_PRODUCTION', '')) ?: $genericAccessToken;
        }

        if (empty($accessToken)) {
            Log::error("[MercadoPago] Missing access token for " . ($mode === 'TEST' ? 'TEST' : 'PRODUCTION') . " mode.");
            return null;
        }

        return [
            'mode' => $mode,
            'publicKey' => $publicKey ?: null,
            'accessToken' => $accessToken,
        ];
    }

    /**
     * Creates a payment checkout preference in Mercado Pago.
     */
    public static function createCheckoutPreference(Booking $booking, Payment $payment)
    {
        $profile = BusinessProfile::firstOrCreate(['id' => 'default']);
        $config = self::resolveConfig($profile);

        if (!$config) {
            // Local simulation URL fallback if MercadoPago is enabled but credentials are not set
            $simulationUrl = route('booking.status', ['publicId' => $booking->public_id]) . '?simulate_pay=1';
            Log::warning("[MercadoPago] Credentials not set. Falling back to payment simulation checkout URL: " . $simulationUrl);
            return [
                'checkout_url' => $simulationUrl,
                'preference_id' => 'sim_' . Str::random(12),
            ];
        }

        $appUrl = rtrim(env('APP_URL', url('/')), '/');
        $notificationUrl = $appUrl . '/api/payments/webhook';
        $reservationUrl = $appUrl . '/reserva/' . $booking->public_id;

        $payload = [
            'external_reference' => $payment->external_reference,
            'notification_url' => $notificationUrl,
            'statement_descriptor' => 'HIGH DETAILING',
            'auto_return' => 'approved',
            'back_urls' => [
                'success' => $reservationUrl,
                'pending' => $reservationUrl,
                'failure' => $reservationUrl,
            ],
            'payer' => [
                'name' => $booking->customer->first_name,
                'surname' => $booking->customer->last_name,
                'email' => $booking->customer->email ?: 'cliente@highcontrastdetailing.cl',
            ],
            'items' => [
                [
                    'id' => $booking->public_id,
                    'title' => $booking->service_name_snapshot,
                    'quantity' => 1,
                    'unit_price' => (int) $payment->amount,
                    'currency_id' => 'CLP',
                ]
            ]
        ];

        try {
            $response = Http::withToken($config['accessToken'])
                ->post('https://api.mercadopago.com/v1/checkout/preferences', $payload);

            if ($response->failed()) {
                Log::error("[MercadoPago] Preference creation failed: " . $response->body());
                throw new \Exception("MercadoPago preference error: " . $response->status());
            }

            $data = $response->json();

            // Under test mode or production mode, init_point or sandbox_init_point is used
            $checkoutUrl = $config['mode'] === 'TEST' 
                ? ($data['sandbox_init_point'] ?? $data['init_point'] ?? null)
                : ($data['init_point'] ?? $data['sandbox_init_point'] ?? null);

            return [
                'checkout_url' => $checkoutUrl,
                'preference_id' => $data['id'] ?? null,
            ];

        } catch (\Exception $e) {
            Log::error("[MercadoPago] Exception while creating preference: " . $e->getMessage());
            // Safe fallback simulation URL so the user doesn't get a hard crash if MP API is blocked/down
            $simulationUrl = route('booking.status', ['publicId' => $booking->public_id]) . '?simulate_pay=1';
            return [
                'checkout_url' => $simulationUrl,
                'preference_id' => 'sim_exc_' . Str::random(12),
            ];
        }
    }

    /**
     * Synchronizes a single payment from Mercado Pago webhook notification.
     */
    public static function syncPayment(string $paymentId)
    {
        $profile = BusinessProfile::firstOrCreate(['id' => 'default']);
        
        // Find token candidates (try active configuration mode first, then try secondary mode)
        $tokens = [];
        $genericAccessToken = trim(env('MERCADO_PAGO_ACCESS_TOKEN', ''));
        
        // Active mode
        $activeMode = $profile->payment_gateway_mode ?? 'TEST';
        if ($activeMode === 'TEST') {
            $tokens[] = trim($profile->mercado_pago_access_token_test ?? '') ?: trim(env('MERCADO_PAGO_ACCESS_TOKEN_TEST', '')) ?: $genericAccessToken;
            $tokens[] = trim($profile->mercado_pago_access_token_production ?? '') ?: trim(env('MERCADO_PAGO_ACCESS_TOKEN_PRODUCTION', '')) ?: $genericAccessToken;
        } else {
            $tokens[] = trim($profile->mercado_pago_access_token_production ?? '') ?: trim(env('MERCADO_PAGO_ACCESS_TOKEN_PRODUCTION', '')) ?: $genericAccessToken;
            $tokens[] = trim($profile->mercado_pago_access_token_test ?? '') ?: trim(env('MERCADO_PAGO_ACCESS_TOKEN_TEST', '')) ?: $genericAccessToken;
        }

        $tokens = array_filter(array_unique($tokens));
        
        if (empty($tokens)) {
            Log::error("[MercadoPago] Webhook received but no access tokens are configured.");
            return false;
        }

        $mpPaymentData = null;
        
        // Try to fetch payment data from MP API using configured tokens
        foreach ($tokens as $token) {
            try {
                $response = Http::withToken($token)
                    ->get("https://api.mercadopago.com/v1/payments/{$paymentId}");
                
                if ($response->successful()) {
                    $mpPaymentData = $response->json();
                    break;
                }
            } catch (\Exception $e) {
                Log::warning("[MercadoPago] Error querying token candidates: " . $e->getMessage());
            }
        }

        if (!$mpPaymentData) {
            Log::error("[MercadoPago] Could not verify payment {$paymentId} in MercadoPago.");
            return false;
        }

        $externalReference = $mpPaymentData['external_reference'] ?? null;
        
        // Find local payment record
        $payment = null;
        if ($externalReference) {
            $payment = Payment::where('external_reference', $externalReference)->first();
        }
        
        if (!$payment) {
            $payment = Payment::where('provider_payment_id', $paymentId)->first();
        }

        if (!$payment) {
            Log::error("[MercadoPago] Local payment record not found for MP reference: " . ($externalReference ?: $paymentId));
            return false;
        }

        $booking = $payment->booking;
        if (!$booking) {
            Log::error("[MercadoPago] Booking not found for payment: " . $payment->id);
            return false;
        }

        // Map status
        $mpStatus = $mpPaymentData['status'] ?? 'pending';
        $mpStatusDetail = $mpPaymentData['status_detail'] ?? '';
        
        $paymentStatus = self::mapStatus($mpStatus);
        $isPaid = ($paymentStatus === 'PAID');
        $isRefunded = ($paymentStatus === 'REFUNDED');
        $isFailed = ($paymentStatus === 'FAILED');
        $isExpired = ($paymentStatus === 'EXPIRED');

        // Map booking status
        $previousBookingStatus = $booking->status?->value;
        
        $bookingStatus = $booking->status?->value;
        if ($isPaid) {
            $bookingStatus = 'CONFIRMED';
        } elseif ($isExpired) {
            $bookingStatus = 'EXPIRED';
        } elseif ($isRefunded) {
            $bookingStatus = 'CANCELLED';
        }

        // Update payment
        $payment->update([
            'provider_payment_id' => $paymentId,
            'status' => $paymentStatus,
            'raw_status' => $mpStatusDetail ?: $mpStatus,
            'paid_at' => $isPaid && !empty($mpPaymentData['date_approved']) ? \Carbon\Carbon::parse($mpPaymentData['date_approved']) : $payment->paid_at,
            'failure_code' => $isFailed ? $mpStatus : null,
            'failure_message' => $isFailed ? $mpStatusDetail : null,
            'webhook_payload' => $mpPaymentData,
        ]);

        // Update booking
        $booking->update([
            'payment_status' => $paymentStatus,
            'status' => $bookingStatus,
            'confirmed_at' => $isPaid ? now() : $booking->confirmed_at,
            'cancelled_at' => $isRefunded ? now() : $booking->cancelled_at,
        ]);

        Log::info("[MercadoPago] Payment {$paymentId} updated local booking {$booking->id}. Status transition: {$previousBookingStatus} -> {$bookingStatus}");

        // Trigger transactional emails
        if ($previousBookingStatus !== 'CONFIRMED' && $bookingStatus === 'CONFIRMED') {
            try {
                EmailService::sendBookingEmail($booking, 'CONFIRMED');
            } catch (\Exception $e) {
                Log::error("[SMTP] Error sending confirmation email: " . $e->getMessage());
            }
        } elseif ($previousBookingStatus !== 'CANCELLED' && $bookingStatus === 'CANCELLED') {
            try {
                EmailService::sendBookingEmail($booking, 'CANCELLED');
            } catch (\Exception $e) {
                Log::error("[SMTP] Error sending cancellation email: " . $e->getMessage());
            }
        }

        return true;
    }

    /**
     * Map Mercado Pago payment status string to detailing system PaymentStatus values
     */
    private static function mapStatus(string $status): string
    {
        switch ($status) {
            case 'approved':
                return 'PAID';
            case 'rejected':
            case 'cancelled':
                return 'FAILED';
            case 'refunded':
            case 'charged_back':
                return 'REFUNDED';
            case 'expired':
                return 'EXPIRED';
            case 'in_process':
            case 'in_mediation':
                return 'PENDING'; // Wait for final resolution
            default:
                return 'PENDING';
        }
    }
}
