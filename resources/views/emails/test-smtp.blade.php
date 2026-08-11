<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Prueba de Configuración SMTP</title>
  <style>
    body {
      background-color: #0A0A0A;
      color: #F5F5F5;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #111111;
      border: 1px solid #2A2A2A;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .header {
      background: linear-gradient(135deg, #E8508A 0%, #C73A6E 100%);
      padding: 30px 20px;
      text-align: center;
    }
    .header h1 {
      margin: 0;
      color: #FFFFFF;
      font-size: 24px;
      font-weight: 700;
      letter-spacing: -0.5px;
    }
    .content {
      padding: 40px 30px;
      line-height: 1.6;
    }
    .content p {
      margin: 0 0 20px 0;
      color: #999999;
      font-size: 16px;
    }
    .success-badge {
      display: inline-block;
      background-color: rgba(34, 197, 94, 0.1);
      border: 1px solid #22C55E;
      color: #22C55E;
      padding: 6px 16px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 14px;
      margin-bottom: 25px;
    }
    .footer {
      background-color: #0A0A0A;
      border-top: 1px solid #2A2A2A;
      padding: 20px;
      text-align: center;
      font-size: 12px;
      color: #666666;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>{{ $businessName }}</h1>
    </div>
    <div class="content">
      <div style="text-align: center;">
        <span class="success-badge">SMTP Configurado Exitosamente</span>
      </div>
      <p>Hola,</p>
      <p>Este es un correo electrónico de prueba enviado desde tu panel de administración en <strong>{{ $businessName }}</strong>.</p>
      <p>Si has recibido este mensaje, significa que las credenciales de tu servidor SMTP son correctas y el sistema está listo para enviar notificaciones de citas y pagos de manera automática.</p>
      <p>No es necesario responder a este correo.</p>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} {{ $businessName }}. Todos los derechos reservados.
    </div>
  </div>
</body>
</html>
