<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f0e6f6; /* Soft purple background */
            color: #453246; /* Deep purple text */
            margin: 0;
            padding: 0;
        }
        .content {
            background-color: #ffffff;
            padding: 40px;
            margin: 30px auto;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid #c0b2c4; /* Subtle border */
        }
        .footer {
            padding-top: 20px;
            font-size: 14px;
            text-align: center;
            color: #9a8ca3; /* Soft purple text */
            font-family: 'Merriweather', serif;
        }
        h1 {
            color: #62456b; /* Rich purple header */
            font-family: 'Merriweather', serif;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        p {
            line-height: 1.8;
            color: #453246; /* Maintaining a uniform text color */
        }
        .highlight {
            color: #8a679e; /* Highlight color */
            font-weight: 700;
        }
        .section {
            margin-top: 20px;
        }
        .section-title {
            font-weight: 700;
            color: #62456b;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .luxury {
            background-image: url('https://example.com/path/to/your/subtle-pattern.png'); /* Optional: a subtle pattern */
            padding: 20px;
            border-left: 5px solid #8a679e; /* Highlighted border for sections */
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>Update Notification</h1>
        <p>Dear Valued Client,</p>
        <div class="section luxury">
            <div class="section-title">Credential</div>
            <p>The "<strong class="highlight">{{ $credential->name }}</strong>" has been updated successfully.</p>
        </div>
        <div class="section luxury">
            <div class="section-title">Associated User</div>
            <p><strong class="highlight">{{ $user->name }}</strong></p>
        </div>
        <p>This is an informational notification only and no action is required on your part.</p>
    </div>
    <div class="footer">
        Thank you for choosing us.<br>
        If you have any questions, feel free to contact our support team.
    </div>
</body>
</html>
