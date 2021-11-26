<?php

return [
    /*
    * bwallet will require you to request username and key
    * these will be used for making a request to bwallet
    */
    'phone'     => env('PHONE'),
    'password'  => env('PASSWORD'),
    'pin'       => env('PIN'),
    'ip'        => env('IP'),
    'key'       => env('KEY'),

    /*
    * bwallet Base URL
    */
    'base_url' => env('BASE_URL', 'https://mitra.b-wallets.com/api/v1'),
];