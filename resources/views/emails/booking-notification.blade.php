<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }}</title>
  <style>
    /* Reset */
    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
    img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }

    body {
      background-color: #080808;
      color: #E5E5E5;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      margin: 0;
      padding: 0;
      width: 100%;
      -webkit-font-smoothing: antialiased;
    }

    .email-wrapper {
      width: 100%;
      padding: 40px 16px;
    }

    .email-container {
      max-width: 580px;
      margin: 0 auto;
      background-color: #111111;
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid #1F1F1F;
      box-shadow: 0 20px 60px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.03);
    }

    /* Header */
    .email-header {
      background: linear-gradient(135deg, #E8508A 0%, #C73A6E 50%, #A82D5A 100%);
      padding: 32px 24px 28px;
      text-align: center;
      position: relative;
    }

    .logo-pill {
      display: inline-block;
      background: rgba(255,255,255,0.15);
      border-radius: 14px;
      padding: 10px 16px;
      margin-bottom: 14px;
      border: 1px solid rgba(255,255,255,0.2);
    }

    .logo-pill img {
      max-height: 42px;
      width: auto;
      display: block;
      border-radius: 8px;
    }

    .email-header h1 {
      margin: 0;
      color: #FFFFFF;
      font-size: 22px;
      font-weight: 700;
      letter-spacing: -0.5px;
    }

    .email-header .subtitle {
      margin: 6px 0 0;
      color: rgba(255,255,255,0.75);
      font-size: 13px;
      font-weight: 400;
    }

    /* Accent line below header */
    .accent-line {
      height: 3px;
      background: linear-gradient(90deg, #E8508A, #F59E0B, #22C55E, #3B82F6);
    }

    /* Body */
    .email-body {
      padding: 36px 28px;
    }

    /* Badge */
    .status-badge {
      display: inline-block;
      background-color: rgba(255, 255, 255, 0.04);
      border: 1.5px solid {{ $badgeColor }};
      color: {{ $badgeColor }};
      padding: 7px 18px;
      border-radius: 100px;
      font-weight: 700;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .email-body .greeting {
      margin: 24px 0 8px;
      color: #F5F5F5;
      font-size: 17px;
      line-height: 1.5;
    }

    .email-body .message {
      margin: 0 0 28px;
      color: #AAAAAA;
      font-size: 15px;
      line-height: 1.7;
    }

    /* Summary Card */
    .summary-card {
      background-color: #0D0D0D;
      border: 1px solid #1F1F1F;
      border-radius: 12px;
      overflow: hidden;
      margin-bottom: 28px;
    }

    .summary-title {
      font-size: 11px;
      font-weight: 700;
      color: #777777;
      text-transform: uppercase;
      letter-spacing: 1.2px;
      padding: 16px 20px 12px;
      border-bottom: 1px solid #1A1A1A;
      margin: 0;
    }

    .summary-body {
      padding: 4px 0;
    }

    .detail-item {
      display: table;
      width: 100%;
      padding: 12px 20px;
      border-bottom: 1px solid #141414;
    }

    .detail-item:last-child {
      border-bottom: none;
    }

    .detail-icon {
      display: table-cell;
      width: 36px;
      vertical-align: top;
      padding-top: 2px;
    }

    .detail-icon svg {
      fill: none;
      stroke: #E8508A;
      stroke-width: 1.5;
      width: 18px;
      height: 18px;
    }

    .detail-content {
      display: table-cell;
      vertical-align: top;
    }

    .detail-label {
      display: block;
      font-size: 10px;
      text-transform: uppercase;
      color: #666666;
      font-weight: 700;
      letter-spacing: 0.8px;
      margin-bottom: 3px;
    }

    .detail-value {
      font-size: 14px;
      color: #E5E5E5;
      font-weight: 500;
      line-height: 1.4;
    }

    .detail-value.highlight {
      color: #E8508A;
      font-weight: 600;
    }

    .detail-value.total {
      font-size: 20px;
      font-weight: 800;
      color: #FFFFFF;
      letter-spacing: -0.5px;
    }

    /* Extras */
    .extras-container {
      padding: 14px 20px 16px;
      border-bottom: 1px solid #141414;
    }

    .extra-tag {
      display: inline-block;
      background: rgba(232, 80, 138, 0.08);
      border: 1px solid rgba(232, 80, 138, 0.2);
      color: #E8508A;
      font-size: 11px;
      font-weight: 600;
      padding: 4px 10px;
      border-radius: 6px;
      margin-right: 6px;
      margin-top: 6px;
    }

    /* Notes */
    .notes-box {
      margin: 0 20px 16px;
      padding: 14px 16px;
      background: rgba(255,255,255,0.02);
      border-left: 3px solid #333333;
      border-radius: 0 8px 8px 0;
    }

    .notes-box .detail-label {
      margin-bottom: 6px;
    }

    .notes-text {
      color: #888888;
      font-size: 13px;
      font-style: italic;
      line-height: 1.5;
      margin: 0;
    }

    /* CTA Button */
    .cta-container {
      text-align: center;
      padding: 4px 0 8px;
    }

    .btn-cta {
      display: inline-block;
      background: linear-gradient(135deg, #E8508A 0%, #C73A6E 100%);
      color: #FFFFFF !important;
      text-decoration: none;
      padding: 14px 36px;
      border-radius: 10px;
      font-weight: 700;
      font-size: 14px;
      letter-spacing: 0.3px;
      box-shadow: 0 8px 24px rgba(232, 80, 138, 0.3), 0 2px 6px rgba(0,0,0,0.3);
      transition: all 0.2s;
    }

    /* Footer */
    .email-footer {
      background-color: #080808;
      border-top: 1px solid #1A1A1A;
      padding: 28px 24px;
      text-align: center;
    }

    .email-footer p {
      margin: 4px 0;
      color: #666666;
      font-size: 12px;
      line-height: 1.6;
    }

    .email-footer .brand-name {
      color: #999999;
      font-weight: 700;
      font-size: 13px;
    }

    .footer-divider {
      width: 40px;
      height: 1px;
      background: #2A2A2A;
      margin: 14px auto;
      border: 0;
    }

    .email-footer .copyright {
      color: #444444;
      font-size: 11px;
      margin-top: 12px;
    }

    .whatsapp-link {
      display: inline-block;
      color: #25D366 !important;
      text-decoration: none;
      font-weight: 600;
    }

    /* Responsive */
    @media only screen and (max-width: 600px) {
      .email-wrapper { padding: 16px 8px; }
      .email-body { padding: 24px 18px; }
      .detail-item { padding: 10px 16px; }
      .btn-cta { padding: 12px 28px; font-size: 13px; }
    }
  </style>
</head>
<body>
  <div class="email-wrapper">
    <div class="email-container">

      {{-- HEADER --}}
      <div class="email-header">
        @if(!empty($logoUrl))
          <div style="margin-bottom: 14px;">
            <div class="logo-pill">
              <img src="{{ $logoUrl }}" alt="{{ $businessName }}">
            </div>
          </div>
          <h1 style="font-size: 18px; font-weight: 600; opacity: 0.95;">{{ $businessName }}</h1>
        @else
          <h1>{{ $businessName }}</h1>
        @endif
      </div>

      {{-- Accent Line --}}
      <div class="accent-line"></div>

      {{-- BODY --}}
      <div class="email-body">
        <div style="text-align: center; margin-bottom: 4px;">
          <span class="status-badge">{{ $badgeText }}</span>
        </div>

        <p class="greeting">Hola <strong style="color: #FFFFFF;">{{ $customerName }}</strong>,</p>
        <p class="message">{{ $messageText }}</p>

        {{-- Summary Card --}}
        <div class="summary-card">
          <h2 class="summary-title">Resumen de la Cita</h2>

          <div class="summary-body">
            {{-- Service --}}
            <div class="detail-item">
              <div class="detail-icon">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
              </div>
              <div class="detail-content">
                <span class="detail-label">Servicio</span>
                <span class="detail-value">{{ $serviceName }}</span>
              </div>
            </div>

            {{-- Extras --}}
            @if(!empty($extras) && count($extras) > 0)
              <div class="extras-container">
                <span class="detail-label" style="margin-bottom: 4px;">Servicios Adicionales</span>
                <div>
                  @foreach($extras as $extra)
                    <span class="extra-tag">{{ $extra }}</span>
                  @endforeach
                </div>
              </div>
            @endif

            {{-- Vehicle --}}
            <div class="detail-item">
              <div class="detail-icon">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M5 17h2m10 0h2M3 11l2-6h14l2 6M3 11v6h18v-6M3 11h18"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/></svg>
              </div>
              <div class="detail-content">
                <span class="detail-label">Vehículo</span>
                <span class="detail-value">{{ $vehicleDetails }} — Patente: <strong style="color: #FFFFFF;">{{ strtoupper($licensePlate) }}</strong></span>
              </div>
            </div>

            {{-- Date --}}
            <div class="detail-item">
              <div class="detail-icon">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              </div>
              <div class="detail-content">
                <span class="detail-label">Fecha y Hora</span>
                <span class="detail-value highlight">{{ $dateTimeStr }}</span>
              </div>
            </div>

            {{-- Total --}}
            <div class="detail-item" style="background: rgba(232, 80, 138, 0.03); border-bottom: none;">
              <div class="detail-icon">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
              </div>
              <div class="detail-content">
                <span class="detail-label">Total del Servicio</span>
                <span class="detail-value total">{{ $totalAmount }}</span>
              </div>
            </div>
          </div>

          {{-- Notes --}}
          @if(!empty($notes))
            <div class="notes-box">
              <span class="detail-label">Notas del Cliente</span>
              <p class="notes-text">"{{ $notes }}"</p>
            </div>
          @endif
        </div>

        {{-- CTA --}}
        <div class="cta-container">
          <a href="{{ $bookingLink }}" class="btn-cta" target="_blank">
            Ver Detalles de tu Reserva &rarr;
          </a>
        </div>
      </div>

      {{-- FOOTER --}}
      <div class="email-footer">
        <p class="brand-name">{{ $businessName }}</p>
        <p>{{ $businessAddress }}</p>
        <p>
          Tel: {{ $businessPhone }}
          @if($businessWhatsApp)
            &nbsp;|&nbsp;
            <a href="https://wa.me/{{ $businessWhatsApp }}" class="whatsapp-link">WhatsApp: +{{ $businessWhatsApp }}</a>
          @endif
        </p>
        <hr class="footer-divider">
        <p class="copyright">&copy; {{ date('Y') }} {{ $businessName }}. Todos los derechos reservados.</p>
      </div>

    </div>
  </div>
</body>
</html>
