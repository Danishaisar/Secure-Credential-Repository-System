<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Secure Credential Repository System</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: #121212;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('path_to_your_background_image'); /* Add your background image path here */
            background-size: cover;
            background-repeat: no-repeat;
        }
        .welcome-container {
            width: 100%;
            max-width: 450px;
            margin: auto;
            padding: 2rem;
            box-sizing: border-box;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            color: #ffffff;
            padding: 2rem;
            margin-top: 2rem;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .title {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .subtitle {
            font-weight: 300;
            margin-bottom: 2rem;
        }
        input[type='text'],
        input[type='password'] {
            width: 100%;
            padding: 1rem;
            margin: 0.5rem 0;
            border-radius: 0.5rem;
            border: none;
            background: rgba(255, 255, 255, 0.7);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            box-sizing: border-box;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 1rem;
            margin-top: 1rem;
            border-radius: 0.5rem;
            background: linear-gradient(90deg, #a855f7 0%, #667eea 100%);
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background: linear-gradient(90deg, #667eea 0%, #a855f7 100%);
        }
        .links > a {
            color: #ffffff;
            text-decoration: none;
            margin: 0.5rem;
            display: inline-block;
        }
        .auth-links {
            text-align: center;
            padding-top: 1rem;
        }
        .auth-links a {
            color: #a855f7;
            text-decoration: none;
            margin: 0 5px;
            font-weight: 500;
            transition: color 0.2s ease-in-out;
        }
        .auth-links a:hover {
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <!-- The title can be an image or text -->
        <h1 class="title">Welcome to the website</h1>
        <p class="subtitle">Your secure and reliable credential repository system.</p>
        <div class="card">
            <!-- Authentication form here -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="text" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="btn">Login</button>
            </form>
            <div class="auth-links">
                <a href="{{ url('/password/reset') }}">Forgot Password?</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
