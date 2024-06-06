<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Death Certificate Verified</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content p {
            line-height: 1.6;
            color: #333333;
        }
        .footer {
            margin-top: 20px;
            padding: 10px 20px;
            text-align: center;
            font-size: 14px;
            color: #777777;
            border-top: 1px solid #dddddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Death Certificate Verified</h1>
        </div>
        <div class="content">
            <p>Dear Close Kin,</p>
            <p>The death certificate for <strong>{{ $deathCertificate->user_name }}</strong> has been verified successfully.</p>
            <p>Best regards,</p>
            <p>Secure Credential Repository System Team</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Secure Credential Repository System. All rights reserved.
        </div>
    </div>
</body>
</html>
