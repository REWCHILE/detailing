<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\BusinessProfile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class EmailService
{
    /**
     * Configures a dynamic Laravel mailer instance based on database or custom SMTP settings.
     */
    private static function getMailer(BusinessProfile $profile, ?array $customConfig = null)
    {
        $host = '';
        $port = 587;
        $user = '';
        $password = '';
        $secure = false;

        if ($customConfig) {
            $host = $customConfig['host'] ?? '';
            $port = $customConfig['port'] ?? 587;
            $user = $customConfig['user'] ?? '';
            $password = $customConfig['password'] ?? '';
            $secure = $customConfig['secure'] ?? false;
        } else {
            if (!$profile->smtp_enabled) {
                return null;
            }
            $host = $profile->smtp_host;
            $port = $profile->smtp_port ?? 587;
            $user = $profile->smtp_user;
            $password = $profile->smtp_password;
            $secure = (bool) $profile->smtp_secure;
        }

        if (empty($host) || empty($user)) {
            Log::warning("[SMTP] Missing host or user for dynamic SMTP configuration.");
            return null;
        }

        $encryption = null;
        if ($secure) {
            $encryption = ($port == 465) ? 'ssl' : 'tls';
        }

        $config = [
            'transport' => 'smtp',
            'host' => $host,
            'port' => (int) $port,
            'encryption' => $encryption,
            'username' => $user,
            'password' => $password,
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ];

        // Register custom mailer configuration in runtime
        config(['mail.mailers.dynamic_smtp' => $config]);

        return Mail::mailer('dynamic_smtp');
    }

    /**
     * Resolves a booking and sends the appropriate notification email to the customer.
     */
    public static function sendBookingEmail(Booking $booking, string $templateType)
    {
        try {
            $profile = BusinessProfile::firstOrCreate(['id' => 'default']);
            
            if (!$profile->smtp_enabled) {
                Log::info("[SMTP] Email notifications are disabled in BusinessProfile.");
                return false;
            }

            $customerEmail = $booking->customer->email;
            if (!$customerEmail) {
                Log::warning("[SMTP] Customer {$booking->customer->first_name} does not have an email registered.");
                return false;
            }

            $mailer = self::getMailer($profile);
            if (!$mailer) {
                Log::warning("[SMTP] Could not initialize dynamic SMTP mailer.");
                return false;
            }

            $fromName = $profile->smtp_from_name ?: $profile->business_name;
            $fromEmail = $profile->smtp_from_email ?: $profile->smtp_user ?: env('MAIL_FROM_ADDRESS');

            $formattedDate = ucfirst(Carbon::parse($booking->start_at)->locale('es')->translatedFormat('l, d \d\e F \d\e Y, H:i \h\r\s'));
            $formattedTotal = '$' . number_format($booking->total_amount, 0, ',', '.');

            $appUrl = rtrim(env('APP_URL', url('/')), '/');
            $bookingLink = "{$appUrl}/reserva/{$booking->public_id}";

            $template = \App\Models\EmailTemplate::where('key', $templateType)->first();

            if ($template) {
                $subject = $template->subject;
                $title = $template->title;
                $messageText = $template->body_text;
                $badgeText = $template->badge_text;
                $badgeColor = $template->badge_color;
            } else {
                // Fallback to hardcoded defaults
                switch ($templateType) {
                    case 'CONFIRMED':
                        $subject = "Reserva Confirmada: {servicio_nombre}";
                        $title = "¡Tu cita ha sido confirmada!";
                        $messageText = "Nos complace informarte que tu reserva ha sido programada con éxito. A continuación encontrarás todos los detalles del servicio.";
                        $badgeText = "Confirmada";
                        $badgeColor = "#22C55E";
                        break;
                    case 'CANCELLED':
                        $subject = "Reserva Cancelada: {servicio_nombre}";
                        $title = "Tu cita ha sido cancelada";
                        $messageText = "Lamentamos informarte que tu reserva ha sido cancelada.\n\nMotivo: {motivo_cancelacion}";
                        $badgeText = "Cancelada";
                        $badgeColor = "#EF4444";
                        break;
                    case 'RESCHEDULED':
                        $subject = "Reserva Reagendada: {servicio_nombre}";
                        $title = "Tu cita ha sido reagendada";
                        $messageText = "Te informamos que tu cita ha sido reprogramada a un nuevo horario. Por favor revisa los nuevos detalles a continuación.";
                        $badgeText = "Reagendada";
                        $badgeColor = "#F59E0B";
                        break;
                    default:
                        $subject = "Notificación de Cita";
                        $title = "Actualización de tu reserva";
                        $messageText = "";
                        $badgeText = "Info";
                        $badgeColor = "#3B82F6";
                        break;
                }
            }

            $vehicleDetails = trim(($booking->customerVehicle->make ?? '') . ' ' . ($booking->customerVehicle->model ?? '')) ?: $booking->vehicle_type_name_snapshot;

            // Perform dynamic placeholder replacement
            $replacements = [
                '{cliente_nombre}' => "{$booking->customer->first_name} {$booking->customer->last_name}",
                '{servicio_nombre}' => $booking->service_name_snapshot,
                '{fecha_hora}' => $formattedDate,
                '{vehiculo_detalle}' => "{$vehicleDetails} ({$booking->vehicle_type_name_snapshot})",
                '{patente}' => strtoupper($booking->customerVehicle->license_plate ?? ''),
                '{monto_total}' => $formattedTotal,
                '{link_reserva}' => $bookingLink,
                '{notas}' => $booking->notes ?? '',
                '{motivo_cancelacion}' => $booking->cancellation_reason ?? '',
            ];

            foreach ($replacements as $placeholder => $val) {
                $subject = str_replace($placeholder, $val, $subject);
                $title = str_replace($placeholder, $val, $title);
                $messageText = str_replace($placeholder, $val, $messageText);
            }

            $extras = $booking->extras->map(function ($e) {
                return $e->name_snapshot ?? $e->extra->name ?? '';
            })->filter()->toArray();

            $data = [
                'logoUrl' => $profile->logo ? asset($profile->logo) : asset('assets/logos/main-logo.png'),
                'businessName' => $profile->business_name,
                'businessPhone' => $profile->phone,
                'businessWhatsApp' => $profile->whatsapp,
                'businessAddress' => trim("{$profile->address_line1} " . ($profile->address_line2 ?? '') . ", {$profile->city}"),
                'title' => $title,
                'messageText' => $messageText,
                'badgeText' => $badgeText,
                'badgeColor' => $badgeColor,
                'customerName' => "{$booking->customer->first_name} {$booking->customer->last_name}",
                'serviceName' => $booking->service_name_snapshot,
                'vehicleDetails' => "{$vehicleDetails} ({$booking->vehicle_type_name_snapshot})",
                'licensePlate' => $booking->customerVehicle->license_plate ?? '',
                'dateTimeStr' => $formattedDate,
                'totalAmount' => $formattedTotal,
                'extras' => $extras,
                'bookingLink' => $bookingLink,
                'notes' => $booking->notes,
            ];

            $mailer->send('emails.booking-notification', $data, function ($message) use ($customerEmail, $fromEmail, $fromName, $profile, $subject) {
                $message->to($customerEmail)
                        ->subject("{$profile->business_name} - {$subject}")
                        ->from($fromEmail, $fromName);
            });

            Log::info("[SMTP] Email sent successfully to {$customerEmail} (Type: {$templateType})");

            // Send custom admin notification
            $adminSubject = $subject;
            $adminTitle = $title;
            $adminMessageText = $messageText;

            if ($templateType === 'CONFIRMED') {
                $adminSubject = "NUEVA CITA: {$booking->customer->first_name} - " . $booking->service_name_snapshot;
                $adminTitle = "¡Enhorabuena, tienes una nueva reserva!";
                $adminMessageText = "El cliente {$booking->customer->first_name} {$booking->customer->last_name} acaba de realizar una nueva reserva. A continuación tienes todos los detalles para que puedas prepararte.";
            } elseif ($templateType === 'CANCELLED') {
                $adminSubject = "CITA CANCELADA: {$booking->customer->first_name} - " . $booking->service_name_snapshot;
                $adminTitle = "Una reserva ha sido cancelada";
                $adminMessageText = "El cliente {$booking->customer->first_name} {$booking->customer->last_name} ha cancelado su reserva. Motivo: " . ($booking->cancellation_reason ?? 'No especificado');
            }

            $adminData = $data;
            $adminData['title'] = $adminTitle;
            $adminData['messageText'] = $adminMessageText;

            $mailer->send('emails.booking-notification', $adminData, function ($message) use ($fromEmail, $profile, $adminSubject, $fromName) {
                $message->to($fromEmail)
                        ->subject("{$profile->business_name} - {$adminSubject}")
                        ->from($fromEmail, $fromName);
            });
            Log::info("[SMTP] Admin email sent successfully to {$fromEmail} (Type: {$templateType})");

            return true;

        } catch (\Exception $e) {
            Log::error("[SMTP] Error sending booking email for ID {$booking->id}: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Sends dynamic quotation notification emails to both customer and admin.
     */
    public static function sendQuoteNotificationEmails(Booking $booking)
    {
        try {
            $profile = BusinessProfile::firstOrCreate(['id' => 'default']);
            $mailer = self::getMailer($profile);
            if (!$mailer) {
                Log::info("[SMTP] Mailer not initialized or SMTP disabled.");
                return false;
            }

            $fromName = $profile->smtp_from_name ?: $profile->business_name;
            $fromEmail = $profile->smtp_from_email ?: $profile->smtp_user ?: env('MAIL_FROM_ADDRESS');
            $adminEmail = $profile->email ?: $fromEmail;

            $customerEmail = $booking->customer->email;
            $customerName = "{$booking->customer->first_name} {$booking->customer->last_name}";
            $formattedTotal = '$' . number_format($booking->total_amount, 0, ',', '.');
            $extras = $booking->extras->map(function ($e) {
                return $e->name_snapshot ?? $e->extra->name ?? '';
            })->filter()->toArray();

            $baseData = [
                'logoUrl' => $profile->logo ? asset($profile->logo) : asset('assets/logos/main-logo.png'),
                'businessName' => $profile->business_name,
                'businessPhone' => $profile->phone,
                'businessWhatsApp' => $profile->whatsapp,
                'businessAddress' => trim("{$profile->address_line1} " . ($profile->address_line2 ?? '') . ", {$profile->city}"),
                'serviceName' => $booking->service_name_snapshot,
                'vehicleType' => $booking->vehicle_type_name_snapshot,
                'extrasList' => $extras,
                'customerPhone' => $booking->customer->phone,
                'customerCommune' => $booking->customer->city ?? 'No especificada',
                'estimatedPrice' => $formattedTotal,
            ];

            // 1. Send Email to Customer (if email provided)
            if (!empty($customerEmail)) {
                $customerData = array_merge($baseData, [
                    'title' => '¡Hemos recibido tu solicitud de cotización!',
                    'customerName' => $booking->customer->first_name,
                    'messageText' => "Hemos recibido correctamente tu solicitud de cotización para {$booking->service_name_snapshot}. Nuestro equipo revisará los datos de tu vehículo y te contactará a la brevedad para coordinar la atención.",
                ]);

                $mailer->send('emails.quote-notification', $customerData, function ($message) use ($customerEmail, $fromEmail, $fromName, $profile) {
                    $message->to($customerEmail)
                            ->subject("{$profile->business_name} - Cotización Recibida: {$customerData['serviceName']}")
                            ->from($fromEmail, $fromName);
                });
                Log::info("[SMTP] Quote confirmation sent to customer {$customerEmail}");
            }

            // 2. Send Email to Admin
            $adminData = array_merge($baseData, [
                'title' => 'NUEVO CLIENTE PROSPECTO (COTIZACIÓN)',
                'customerName' => "Administrador (Nuevo lead: {$customerName})",
                'messageText' => "Un nuevo cliente ha realizado una cotización en el sitio web. Ponte en contacto a través de WhatsApp o teléfono para cerrar la venta.",
            ]);

            $mailer->send('emails.quote-notification', $adminData, function ($message) use ($adminEmail, $fromEmail, $fromName, $profile, $customerName) {
                $message->to($adminEmail)
                        ->subject("NUEVA COTIZACIÓN LEAD: {$customerName} - {$profile->business_name}")
                        ->from($fromEmail, $fromName);
            });
            Log::info("[SMTP] Admin notification sent to {$adminEmail}");

            return true;

        } catch (\Exception $e) {
            Log::error("[SMTP] Error sending quote notification emails: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Verifies SMTP settings and sends a test email to the specified target.
     */
    public static function sendTestEmail(string $toEmail, array $config)
    {
        $profile = BusinessProfile::firstOrCreate(['id' => 'default']);
        
        // Resolve secret sentinel (placeholder password)
        if (($config['password'] ?? '') === '____STORED_SECRET____') {
            $config['password'] = $profile->smtp_password;
        }

        $mailer = self::getMailer($profile, $config);
        if (!$mailer) {
            throw new \Exception("No se pudo inicializar el transportador SMTP con la configuración proporcionada.");
        }

        $fromName = $config['fromName'] ?? $profile->business_name;
        $fromEmail = $config['fromEmail'] ?? $config['user'] ?? env('MAIL_FROM_ADDRESS');

        $data = [
            'businessName' => $fromName,
        ];

        $mailer->send('emails.test-smtp', $data, function ($message) use ($toEmail, $fromEmail, $fromName) {
            $message->to($toEmail)
                    ->subject("Prueba de Configuración SMTP - Detailing Center")
                    ->from($fromEmail, $fromName);
        });

        Log::info("[SMTP] Test email successfully sent to {$toEmail}");
        return true;
    }
}
