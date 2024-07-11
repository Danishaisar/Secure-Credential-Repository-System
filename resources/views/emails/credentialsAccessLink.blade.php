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
        .credential {
            background: #e7e7e7;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .credential:not(:last-child) {
            margin-bottom: 15px;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            text-align: center;
        }
        .video-container {
            margin-top: 20px;
            text-align: center;
        }
        .video-container video {
            width: 100%;
            max-width: 400px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Access Credentials for {{ $userName }}</h1>
        <p>You, as a close kin, have been granted temporary access to view credentials for {{ $userName }} who has passed away. Please click the button below to securely view the information:</p>
        <button style="background-color: #4CAF50; color: white; padding: 10px 20px; text-align: center; border: none; border-radius: 5px; text-decoration: none; display: inline-block; margin: 20px 0;">
            <a href="{{ $link }}" style="color: white; text-decoration: none;">Access Credentials</a>
        </button>
        <p>This link will expire in 24 hours.</p>

        <div class="footer">
            <p>If you have any questions or did not expect to receive this information, please contact our support team immediately at <a href="mailto:support@example.com">scrs@support.com</a>.</p>
        </div>
    </div>
</body>
</html>
