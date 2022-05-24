<?php

return [

    /*
     *
     * Fawry section
     *
     *
     * */

    /*
    |--------------------------------------------------------------------------
    | Debug option
    |--------------------------------------------------------------------------
    | Accept boolean value , and toggle between the production endpoint and sandbox
    */

    'debug' => env('FAWRY_DEBUG', true),

    /*
    |--------------------------------------------------------------------------
    | uri links option
    |--------------------------------------------------------------------------
    | Set testing uri and pr uri for pay by fawry session checkout
    */

    'testing_uri' => env('FAWRY_TESTING_URI'),
    'pr_uri' => env('FAWRY_PR_URI'),

    /*
    |--------------------------------------------------------------------------
    | Fawry Keys
    |--------------------------------------------------------------------------
    |
    | The Fawry publishable key and secret key give you access to Fawry's
    | API.
    */

    'merchant_code' => env('FAWRY_MERCHANT_CODE'),

    'security_key' => env('FAWRY_SECURITY_KEY'),


];
