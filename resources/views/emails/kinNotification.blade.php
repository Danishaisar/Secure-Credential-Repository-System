<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Update Notification</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f4f4f4;
            line-height: 1.6;
        }
        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
            margin: 40px auto;
            max-width: 600px;
        }
        .header {
            font-size: 26px;
            color: #2a5298; /* Dark blue for a more formal and professional look */
            margin-bottom: 30px;
            border-bottom: 2px solid #e8e8e8;
            padding-bottom: 10px;
        }
        .content {
            font-size: 16px;
            margin-bottom: 20px;
            line-height: 1.8;
        }
        .highlight {
            color: #2a5298;
            font-weight: bold;
        }
        .footer {
            font-size: 14px;
            color: #777;
            text-align: center;
            border-top: 1px solid #e8e8e8;
            padding-top: 10px;
            margin-top: 20px;
        }
        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <p class="header">Update Confirmation</p>
        <p class="content">Dear <span class="highlight">{{ $kin_name }}</span>,</p>
        <p class="content">We are pleased to inform you that your role as <span class="highlight">{{ $relation }}</span> in our records has been successfully updated. Should you need to review or further update your information, please do not hesitate to contact us.</p>
        <div class="footer">
            <p>Thank you for your attention to this matter.</p>
            <p>Secure Credential Repository System</p>
        </div>
    </div>
</body>
</html>
