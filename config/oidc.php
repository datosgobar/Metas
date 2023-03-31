<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Open ID Connect - Mi argentina
    |--------------------------------------------------------------------------
    |
    */

    'url' => env('OIDC_URL', 'https://auth.miargentina.gob.ar'),
    'client_id' => env('OIDC_CLIENT_ID', 'client_id'),
    'client_secret' => env('OIDC_CLIENT_SECRET', 'client_secret'),

];