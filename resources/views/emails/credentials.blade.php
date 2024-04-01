<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Credentials</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>User Credentials for {{ $user->name }}</h1>
        <p>Dear Close Kin,</p>
        <p>This email is sent to you in accordance with the wishes of {{ $user->name }} to ensure you have access to important account credentials in the event of their inability to manage their digital presence.</p>
        <p><strong>Please handle this information with utmost confidentiality and secure practices.</strong></p>
        
        @foreach($credentials as $credential)
        <div class="credential">
            <p><strong>Service:</strong> {{ $credential->name }}</p>
            <p><strong>Username:</strong> {{ $credential->username }}</p>
            <p>To securely manage or update the password for this service, please follow the instructions provided to you or visit the service directly to request access.</p>
        </div>
        @endforeach

        <div class="footer">
            <p>If you have any questions or did not expect to receive this information, please contact our support team immediately at support@example.com.</p>
        </div>
    </div>
</body>
</html>
