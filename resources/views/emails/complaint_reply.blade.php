<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Reply</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #4a90e2;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #f1f1f1;
            color: #888;
            padding: 10px;
            text-align: center;
        }
        .ticket-number {
            font-weight: bold;
            color: #4a90e2;
        }
        .reply {
            margin: 20px 0;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 4px solid #4a90e2;
        }
        .signature {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Complaint Reply</h1>
        </div>
        <div class="content">
            <p>Dear Customer,</p>
            <p>Thank you for your patience. Here is the reply to your complaint (Ticket Number: <span class="ticket-number">{{ $ticketNumber }}</span>):</p>
            <div class="reply">
                <p>{{ $reply }}</p>
            </div>
            <p class="signature">Best regards,</p>
            <p class="signature">SCRS</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Secure Credential Repository System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
