<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Código de Verificação</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .code-container {
            background: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin: 20px 0;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 5px;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            color: #666;
            font-size: 12px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Capital Master</h1>
        <p>Verificação de Email</p>
    </div>

    <h2>Olá!</h2>
    <p>Você está quase lá! Use o código abaixo para verificar seu email e continuar com o cadastro:</p>

    <div class="code-container">
        <p>Seu código de verificação é:</p>
        <div class="code">{{ $code }}</div>
        <p><small>Este código expira em 10 minutos</small></p>
    </div>

    <p>Se você não solicitou este código, pode ignorar este email.</p>

    <div class="footer">
        <p>© {{ date('Y') }} Capital Master. Todos os direitos reservados.</p>
    </div>
</body>
</html>
