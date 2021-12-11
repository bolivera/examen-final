<?php

return [

    'enabled' => [
        'INTEG',
    ],
    'izypay' => [
        'username' => env('MP_USERNAME'),
        'public' => env('MP_PUBLIC'),
        'secret' => env('MP_SECRET'),
        'DefaultEndpoint' => 'https://static.micuentaweb.pe',
        'api' => 'https://api.micuentaweb.pe/api-payment/'
    ],

];
