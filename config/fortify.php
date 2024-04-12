<?php

use Laravel\Fortify\Features;

return [

    'guard' => 'web',

    'passwords' => 'users',

    'username' => 'email',

    'email' => 'email',

    'lowercase_usernames' => true,

    'home' => '/dashboard',

    'prefix' => '',

    'domain' => null,

    'middleware' => ['web'],

    'limiters' => [
        'login' => 'login',
        'two-factor' => 'two-factor',
    ],

    'views' => true,

    'features' => [
        Features::registration(),
        Features::resetPasswords(),
        // Uncomment the following line if you want to require email verification
        // Features::emailVerification(),
        Features::updateProfileInformation(),
        Features::updatePasswords(),
        Features::twoFactorAuthentication([
            'confirm' => true, // This ensures that two-factor authentication is confirmed during registration or setup.
            'confirmPassword' => true, // This requires password confirmation when enabling 2FA.
            // 'window' => 0, // The window option is commented out; adjust if needed to define the number of seconds a 2FA code remains valid.
        ]),
    ],

];
