<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Site Contact & Organization Details
    |--------------------------------------------------------------------------
    |
    | Values are loaded strictly from the environment. Lines are hidden on the
    | contact page if their corresponding environment variable is empty.
    |
    */
    'email'    => env('SITE_EMAIL') ?: 'natukundaraynel@gmail.com',
    'phone'    => env('SITE_PHONE') ?: '+256 772 068 901',
    'whatsapp' => env('SITE_WHATSAPP') ?: '256772068901',
    'address'  => env('SITE_ADDRESS') ?: 'Kampala, Uganda',
    'hours'    => env('SITE_HOURS') ?: 'Monday – Saturday: 8:00 AM – 6:00 PM EAT',
];
