<?php

return [

    'first' => [
        'first_url' => env('FIRST_SMS_PROVIDER_URL', 'https://example.com'),
        'first_key' => env('FIRST_SMS_PROVIDER_KEY'),
        'first_secret' => env('FIRST_SMS_PROVIDER_SECRET')
    ],

    'second' => [
        'second_url' => env('SECOND_SMS_PROVIDER_URL', 'https://fb.com'),
        'second_key' => env('SECOND_SMS_PROVIDER_KEY'),
        'second_secret' => env('SECOND_SMS_PROVIDER_SECRET')
    ]
];
