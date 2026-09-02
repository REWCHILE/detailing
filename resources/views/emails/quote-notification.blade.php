<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Solicitud de Cotización' }}</title>
  <style>
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
      background-color: #080808;
    }

    .email-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #111111;
      border-radius: 20px;
      overflow: hidden;
      border: 1px solid #222222;
      box-shadow: 0 20px 60px rgba(0,0,0,0.7);
    }

    .email-header {
      background: linear-gradient(135deg, #E60049 0%, #B8003A 100%);
      padding: 36px 28px;
      text-align: center;
    }

    .logo-box {
      display: inline-block;
      background: rgba(0,0,0,0.25);
      border-radius: 14px;
      padding: 10px 18px;
      margin-bottom: 16px;
      border: 1px solid rgba(255,255,255,0.2);
    }

    .logo-box img {
      max-height: 48px;
      width: auto;
      display: block;
    }

    .email-header h1 {
      margin: 0;
      color: #FFFFFF;
      font-size: 24px;
      font-weight: 800;
      letter-spacing: -0.5px;
      text-transform: uppercase;
    }

    .email-header .subtitle {
      margin: 8px 0 0;
      color: rgba(255,255,255,0.85);
      font-size: 13px;
      font-weight: 500;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    .accent-bar {
      height: 4px;
      background: linear-gradient(90deg, #E60049, #FF2A6D, #E60049);
    }

    .email-body {
      padding: 36px 30px;
    }

    .greeting {
      margin: 0 0 12px;
      color: #FFFFFF;
      font-size: 18px;
      font-weight: 700;
    }

    .intro-text {
      margin: 0 0 28px;
      color: #AAAAAA;
      font-size: 15px;
      line-height: 1.6;
    }

    .details-card {
      background-color: #161616;
      border: 1px solid #262626;
      border-radius: 16px;
      overflow: hidden;
      margin-bottom: 28px;
    }

    .card-header {
      background-color: #1D1D1D;
      padding: 14px 20px;
      border-bottom: 1px solid #262626;
      color: #E60049;
      font-size: 11px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 1.5px;
    }

    .detail-row {
      display: table;
      width: 100%;
      padding: 14px 20px;
      border-bottom: 1px solid #1C1C1C;
      box-sizing: border-box;
    }

    .detail-row:last-child {
      border-bottom: none;
    }

    .detail-label {
      display: table-cell;
      color: #888888;
      font-size: 13px;
      width: 38%;
      vertical-align: top;
    }

    .detail-value {
      display: table-cell;
      color: #FFFFFF;
      font-size: 14px;
      font-weight: 600;
      text-align: right;
      vertical-align: top;
    }

    .highlight-value {
      color: #E60049;
      font-weight: 700;
    }

    .btn-container {
      text-align: center;
      margin: 32px 0 16px;
    }

    .btn-primary {
      display: inline-block;
      background: linear-gradient(135deg, #E60049 0%, #C4003E 100%);
      color: #FFFFFF !important;
      text-decoration: none;
      font-size: 14px;
      font-weight: 700;
      padding: 14px 32px;
      border-radius: 50px;
      text-transform: uppercase;
      letter-spacing: 1px;
      box-shadow: 0 8px 25px rgba(230,0,73,0.35);
    }

    .email-footer {
      background-color: #0B0B0B;
      padding: 24px 30px;
      border-top: 1px solid #1C1C1C;
      text-align: center;
      color: #666666;
      font-size: 12px;
    }

    .email-footer a {
      color: #E60049;
      text-decoration: none;
      font-weight: 700;
    }
  </style>
</head>
<body>
  <div class="email-wrapper">
    <div class="email-container">
      
      <!-- Header with Logo -->
      <div class="email-header">
        <div class="logo-box">
          <img src="{{ $logoUrl }}" alt="{{ $businessName }}">
        </div>
        <h1>{{ $businessName }}</h1>
        <div class="subtitle">Centro de Detailing Automotriz Premium</div>
      </div>

      <div class="accent-bar"></div>

      <!-- Email Body -->
      <div class="email-body">
        <div class="greeting">¡Hola, {{ $customerName }}! 👋</div>
        
        <p class="intro-text">
          {{ $messageText }}
        </p>

        <!-- Service Summary Card -->
        <div class="details-card">
          <div class="card-header">Resumen de la Cotización Solicitada</div>

          <div class="detail-row">
            <div class="detail-label">Servicio Elegido:</div>
            <div class="detail-value highlight-value">{{ $serviceName }}</div>
          </div>

          <div class="detail-row">
            <div class="detail-label">Tipo de Vehículo:</div>
            <div class="detail-value">{{ $vehicleType }}</div>
          </div>

          @if(!empty($extrasList) && count($extrasList) > 0)
          <div class="detail-row">
            <div class="detail-label">Tratamientos Extras:</div>
            <div class="detail-value">{{ implode(', ', $extrasList) }}</div>
          </div>
          @endif

          <div class="detail-row">
            <div class="detail-label">Teléfono / WhatsApp:</div>
            <div class="detail-value">{{ $customerPhone }}</div>
          </div>

          @if(!empty($customerCommune))
          <div class="detail-row">
            <div class="detail-label">Comuna:</div>
            <div class="detail-value">{{ $customerCommune }}</div>
          </div>
          @endif

          <div class="detail-row">
            <div class="detail-label">Precio Estimado:</div>
            <div class="detail-value highlight-value">{{ $estimatedPrice }}</div>
          </div>
        </div>

        <div class="btn-container">
          <a href="https://wa.me/{{ preg_replace('/\D/', '', $businessWhatsApp ?? '56951024782') }}" class="btn-primary" target="_blank">
            Hablar por WhatsApp
          </a>
        </div>
      </div>

      <!-- Footer -->
      <div class="email-footer">
        <p style="margin: 0 0 8px;">{{ $businessName }} • {{ $businessAddress }}</p>
        <p style="margin: 0;">Powered by <a href="https://rew.cl" target="_blank">REW.CL</a></p>
      </div>

    </div>
  </div>
</body>
</html>
