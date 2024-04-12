<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MFA Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
        }
        h1 {
            color: #444;
        }
        .code {
            background: #e7e7e7;
            border-radius: 4px;
            padding: 10px;
            text-align: center;
            font-size: 24px;
            letter-spacing: 3px;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your MFA Code</h1>
        <p>Hello,</p>
        <p>Please use the following code to complete your login process. This code is required to ensure that access to your account is secure.</p>
        <div class="code">
            {{ $code }}
        </div>
        <p>This code will expire in 10 minutes.</p>
        <div class="footer">
            <p>If you did not request this code, please ignore this email or contact our support team immediately at support@example.com.</p>
        </div>
    </div>
</body>
</html>
