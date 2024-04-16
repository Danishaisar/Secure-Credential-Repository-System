<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Credentials Access</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background: #f0f4f8;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    color: #333;
    overflow: auto; /* For smaller screens where content might be taller than the viewport */
}


        .container {
            box-sizing: border-box; /* Includes padding and border in the element's total width and height */
            width: 90%;
            max-width: 650px;
            margin: 5vh auto; /* Adds vertical margin to container */
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        h1 {
            font-size: 2.2em; /* Larger font size for title */
            color: #4a77d4;
            margin-bottom: 20px;
            text-align: center; /* Center-align the title */
        }

        p {
            text-align: center; /* Center-align the subtitle */
            margin-bottom: 30px;
        }

        .card {
            background: linear-gradient(to right, #fafafa, #e9eff3);
            border-left: 5px solid #4a77d4;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .card-body {
            font-size: 1.2em;
            line-height: 1.6;
        }

        .card-title {
            margin-bottom: 5px;
            color: #555;
        }

        .card-text {
            background: #fff;
            padding: 10px;
            border-radius: 4px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.06);
            word-wrap: break-word; /* Prevents long strings from overflowing */
        }

        .footer {
            text-align: center;
            padding-top: 20px;
            font-size: 14px;
            color: #666;
            margin-top: 20px;
            border-top: 1px solid #e9eff3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Secure Access to Credentials</h1>
        <p>These credentials have been shared securely. Please handle this information with care.</p>
        
        @foreach ($credentials as $credential)
        <div class="card">
            <div class="card-header">Service: {{ $credential->name }}</div>
            <div class="card-body">
                <h5 class="card-title">Username: {{ $credential->username }}</h5>
                <p class="card-text">Password: {{ $credential->password }}</p>
            </div>
        </div>
        @endforeach
        <div class="footer">
            Please contact support@example.com if you have any issues or questions.
        </div>
    </div>
</body>
</html>
