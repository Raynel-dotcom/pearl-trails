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
    'email'    => env('SITE_EMAIL'),
    'phone'    => env('SITE_PHONE'),
    'whatsapp' => env('SITE_WHATSAPP'),
    'address'  => env('SITE_ADDRESS'),
    'hours'    => env('SITE_HOURS'),
];
