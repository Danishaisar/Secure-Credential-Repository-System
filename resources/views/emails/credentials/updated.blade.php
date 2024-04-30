<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 0; }
        .content { background-color: #ffffff; padding: 20px; margin: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
        .footer { padding-top: 10px; font-size: 12px; text-align: center; color: #666; }
        h1 { color: #0056b3; }
    </style>
</head>
<body>
    <div class="content">
        <h1>Notification of Credential Update</h1>
        <p>Dear Valued Close Person,</p>
        <p>We are writing to inform you that the credential titled "<strong>{{ $credential->name }}</strong>" associated with <strong>{{ $user->name }}</strong> has recently been updated. This notification serves to keep you informed of changes and ensure transparency in the management of sensitive information.</p>
        <p>No action is required on your part. This is a purely informational message to ensure you are aware of changes occurring within the account.</p>
    </div>
    <div class="footer">
        Thank you for your attention to this matter.<br>
        If you have any questions, please feel free to reach out to our support team.
    </div>
</body>
</html>
