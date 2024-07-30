<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Secure Credential</title>
    <script src="//unpkg.com/alpinejs" defer></script>

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
            background-image: url('{{ asset('images/website_background2.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #ffffff;
        }

        .overlay-bg {
            background-color: rgba(0, 0, 0, 0.7);
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
            margin-bottom: 1rem;
        }

        .hero-section p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .action-buttons a {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 2rem;
            text-decoration: none;
            color: #ffffff;
            background-color: #6D28D9;
            transition: background-color 0.3s ease;
            margin-right: 10px;
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
            background-color: rgba(0, 0, 0, 0.5);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .feature-box h3 {
            font-size: 1.5rem;
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .feature-box p {
            font-size: 1rem;
            color: #cccccc;
        }

        .kin-link-container {
            margin-top: 15px;
            text-align: center;
        }

        .close-kin-link {
            color: #ffffff;
            text-decoration: none;
            font-size: 1rem;
            margin-top: 10px;
        }

        .close-kin-link:hover {
            text-decoration: underline;
        }

        .action-buttons-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 40px;
        }
    </style>
</head>
<body class="antialiased">

<div class="overlay-bg">
    <div class="container mx-auto">
        <div class="hero-section">
            <div>
                <h1><strong>Secure Credential Repository System</strong></h1>
                <p>Simplify your life with our Secure Credential Repository System. Manage, organize, and transfer your credentials effortlessly. Dive in and register now for seamless security!</p>
                <div class="action-buttons">
                    <a href="{{ route('login') }}" class="btn-primary">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-secondary">Register</a>
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
                    <img src="{{ asset('images/icon6.png') }}" alt="Secure Credential" class="w-16 h-16 mr-2">
                    <h3 class="font-bold text-xl">Secure Credential</h3>
                </div>
                <p>Ensure your close kin can manage your digital assets securely. Submit a death certificate to transfer access.</p>
                <div class="kin-link-container">
                    <a href="{{ route('kin.deathCertificate') }}" class="close-kin-link">Are you a close kin to somebody? Submit Death Certificate</a>
                </div>
            </div>

            <div class="feature-box">
                <div class="flex items-center justify-center mb-4">
                    <img src="{{ asset('images/icon4.png') }}" alt="Multifactor Authentication" class="w-16 h-16 mr-2">
                    <h3 class="font-bold text-xl">Multifactor Authentication</h3>
                </div>
                <p>Ensure top-tier security with multiple layers of authentication, safeguarding your data from unauthorized access.</p>
            </div>

            <div class="feature-box">
                <div class="flex items-center justify-center mb-4">
                    <img src="{{ asset('images/icon5.png') }}" alt="Safely Encrypted" class="w-16 h-16 mr-2">
                    <h3 class="font-bold text-xl">Safely Encrypted</h3>
                </div>
                <p>Rest easy knowing your credentials are protected with robust encryption, keeping them safe from prying eyes.</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>