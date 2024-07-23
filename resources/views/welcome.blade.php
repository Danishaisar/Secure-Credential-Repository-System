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
        /* Existing styles ... */

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            background-image: url('{{ asset('images/website_background2.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
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
            background-color: rgba(0, 0, 0, 0.5); /* Black background with 50% opacity */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1); /* Soft shadow for depth */
            color: #fff; /* Text color to white for better visibility */
        }

        .feature-box h3 {
            font-size: 1.5rem;
            color:#fff;
            margin-top: 0;
        }

        .feature-box p {
            font-size: 1rem;
            color: #999999;
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

        .feature-box:hover {
            transform: translateY(-5px); /* Feature box hover effect */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

         /* Transition for smooth hover effects */
         .btn-primary, .btn-secondary, .feature-box {
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
        }

        .action-buttons-container {
            display: flex; /* Use flexbox to center children */
            flex-direction: column; /* Change to column direction */
            align-items: center; /* Center align items */
            padding-top: 20px;
            margin-top: 20px; /* Or any other value for spacing from the feature boxes */
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

        .kin-link-container {
            margin-top: 15px;
            text-align: center;
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
            </div>
            <div class="hero-image">
                <img src="{{ asset('images/scrs_logo2.png') }}" alt="Secure Credential Logo" class="rounded-lg shadow-lg">
            </div>
        </div>

        <div class="feature-box-container">
            <!-- Feature box with Alpine.js for interactivity -->
            <div class="feature-box" x-data="{ open: false }">
                <div @click="open = !open" class="flex items-center justify-center mb-4 cursor-pointer">
                    <img src="{{ asset('images/icon6.png') }}" alt="Secure Credential" class="w-16 h-16 mr-2">
                    <i class="fas fa-rocket text-purple-500 text-3xl mr-2"></i>
                    <h3 class="font-bold text-xl">Secure Credential</h3>
                </div>
                <p x-show="open" x-collapse class="transition-all duration-500" style="display: none;">
                    Learn more about our secure credential management system and how it simplifies your digital life.
                </p>
                <p x-show="!open">
                    Ensure your close kin can manage your digital assets securely. Submit a death certificate to transfer access.
                </p>
                <div class="kin-link-container">
                    <a href="{{ route('kin.deathCertificate') }}" class="close-kin-link">Are you a close kin to somebody? Submit Death Certificate</a>
                </div>
            </div>

            <div class="feature-box" x-data="{ open: false }">
                <div @click="open = !open" class="flex items-center justify-center mb-4 cursor-pointer">
                    <img src="{{ asset('images/icon4.png') }}" alt="Multifactor Authentication" class="w-16 h-16 mr-2">
                    <i class="fas fa-rocket text-purple-500 text-3xl mr-2"></i>
                    <h3 class="font-bold text-xl">Multifactor Authentication</h3>
                </div>
                <p x-show="open" x-collapse class="transition-all duration-500" style="display: none;">
                    Learn more about our seamless deployment process that helps you deliver applications with ease and efficiency.
                </p>
                <p x-show="!open">
                    Ensure top-tier security with multiple layers of authentication, safeguarding your data from unauthorized access.
                </p>
            </div>

            <div class="feature-box" x-data="{ open: false }">
                <div @click="open = !open" class="flex items-center justify-center mb-4 cursor-pointer">
                    <img src="{{ asset('images/icon5.png') }}" alt="Safely Encrypted" class="w-16 h-16 mr-2">
                    <i class="fas fa-rocket text-purple-500 text-3xl mr-2"></i>
                    <h3 class="font-bold text-xl">Safely Encrypted</h3>
                </div>
                <p x-show="open" x-collapse class="transition-all duration-500" style="display: none;">
                    Learn more about our seamless deployment process that helps you deliver applications with ease and efficiency.
                </p>
                <p x-show="!open">
                    Rest easy knowing your credentials are protected with robust encryption, keeping them safe from prying eyes.
                </p>
            </div>
        </div>

        <div class="action-buttons-container">
            <div class="action-buttons">
                <a href="{{ route('login') }}" class="btn-primary">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-secondary ml-2">Register</a>
                @endif
            </div>
        </div>
    </div>
</div>

</body>
</html>
