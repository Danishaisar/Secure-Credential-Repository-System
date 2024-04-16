<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Secure Credential</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Figtree', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: #a855f7;
        }

        .welcome-container {
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.8); /* White with transparency */
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            width: 80%;
            max-width: 600px;
        }

        .welcome-container:hover {
            background-color: rgba(255, 255, 255, 0.95);
        }

        .title {
            color: #5d55fa; /* Darker purple */
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .links > a {
            color: #5d55fa; /* Darker purple */
            padding: 10px 20px;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin: 0 10px;
            transition: color 0.3s ease-in-out;
        }

        .links > a:hover, .links > a:focus {
            color: #ffffff;
            background-color: #9f7aea; /* Medium purple */
        }

        /* Authentication Links Styles */
        .auth-links {
            position: absolute;
            top: 16px;
            right: 16px;
        }

        .auth-links > a {
            color: #ffffff;
            font-weight: 600;
            margin-left: 20px;
            text-decoration: none;
        }

        .auth-links > a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="antialiased">
<div class="welcome-container">
    <div class="title">
        Secure Credential Repository System
    </div>
    
    <div class="links">
        @auth
            <a href="{{ url('/dashboard') }}">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
      <!--  <a href="{{ url('/about') }}">About</a>
        <a href="{{ url('/services') }}">Services</a>
        <a href="{{ url('/contact') }}">Contact</a> -->
    </div>
</div>
</body>
</html>
