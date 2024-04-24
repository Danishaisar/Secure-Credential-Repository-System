<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Secure Credential</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/scrs_logo.png') }}" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css'])

    <!-- Additional styles specific to this page -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-image: url('{{ asset('images/website_background2.png') }}');
        }

        .overlay-bg {
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            min-height: 100%;
            padding: 2rem;
        }

        .hero-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
            color: #ffffff;
        }

        .hero-section h1 {
            font-size: 3rem;
        }

        .hero-section p {
            font-size: 1.25rem;
        }

        .action-buttons a {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 2rem;
            text-decoration: none;
            color: #ffffff;
            background-color: #6D28D9;
            transition: background-color 0.3s ease;
        }

        .action-buttons a:hover {
            background-color: #7C3AED;
        }

        .feature-box-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .feature-box {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .feature-box h3 {
            font-size: 1.5rem;
            color: #333333;
            margin-top: 0;
        }

        .feature-box p {
            font-size: 1rem;
            color: #666666;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-center {
            justify-content: center;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .mr-2 {
            margin-right: 0.5rem;
        }

        .text-xl {
            font-size: 1.25rem;
        }

        .text-3xl {
            font-size: 1.875rem;
        }

        .text-purple-500 {
            color: #6D28D9;
        }

        .font-bold {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #6D28D9;
            color: #ffffff;
        }

        .btn-secondary {
            background-color: #7C3AED;
            color: #ffffff;
        }

        .btn-primary,
        .btn-secondary {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 2rem;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            background-color: #7C3AED;
        }
    </style>
</head>
<body class="antialiased">

<div class="overlay-bg">
    <div class="container mx-auto">
        <div class="hero-section">
            <div>
            <h1>Welcome to <strong>Secure Credential</strong></h1>

                <p>Experience simplicity and security with Secure Credential Repository System! Easily manage, organize, and transfer your credentials. Simplify your security, simplify your life.</p>
                <div class="action-buttons mt-4">
    <a href="{{ route('login') }}" class="btn-primary">Log in</a>
    @if (Route::has('register'))
        <a href="{{ route('register') }}" class="btn-secondary ml-2">Register</a>
    @endif
</div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('images/scrs_logo2.png') }}" alt="Secure Credential Logo" class="rounded-lg shadow-lg">
            </div>
        </div>

        <div class="feature-box-container">
    <div class="feature-box">
        <div class="flex items-center justify-center mb-4">
            <i class="fas fa-rocket text-purple-500 text-3xl mr-2"></i>
            <h3 class="font-bold text-xl">Push to Deploy</h3>
        </div>
        <p>Effortlessly deploy your applications with just a push. Streamline your development process and get your code into production faster.</p>
    </div>

    <div class="feature-box">
        <div class="flex items-center justify-center mb-4">
            <i class="fas fa-shield-alt text-purple-500 text-3xl mr-2"></i>
            <h3 class="font-bold text-xl">Multifactor Authentication</h3>
        </div>
        <p>Enhance the security of your account with multifactor authentication. Protect your sensitive information from unauthorized access.</p>
    </div>

    <div class="feature-box">
        <div class="flex items-center justify-center mb-4">
            <i class="fas fa-lock text-purple-500 text-3xl mr-2"></i>
            <h3 class="font-bold text-xl">Safely Encrypted</h3>
        </div>
        <p>Your data is safely encrypted to ensure confidentiality and integrity. Rest assured that your information remains protected at all times.</p>
    </div>
</div>
    </div>
</div>

</body>
</html>
