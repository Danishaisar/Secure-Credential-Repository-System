<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Credentials</title>
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
        .button {
            display: block;
            width: fit-content;
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            margin: 20px 0;
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
        <h1>Access to Credentials</h1>
        <p>You have been granted temporary access to view credentials. Please click the button below to view the information securely.</p>
        <a href="{{ $link }}" class="button">Access Credentials</a>
        <p>This link will expire in 24 hours.</p>
        <div class="footer">
            <p>If you have any questions or did not expect to receive this information, please contact our support team immediately at support@example.com.</p>
        </div>
    </div>
</body>
</html>
