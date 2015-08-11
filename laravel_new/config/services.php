<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

//    'twitter' => [
//    'client_id' => 'mKVed7GWb9MxNItfSVTsZdW47',
//    'client_secret' => 'QQWUCBQpyw8GCk5655MVs5uoIRYLIGDHXDgxdKUCe870FjfSfd',
//    'redirect' => 'http://nameless-lake-2987.herokuapp.com/login/twitter',
//    ],

    'twitter' => [
    'client_id' => 'K4OhivROmNVBvHmRt0M73DfUI',
    'client_secret' => 'z30imW9fQeNwobdRUOrNDl59M3CTxVTIIipaV8g8iX5rrCc9MV',
    'redirect' => 'http://nameless-lake-2987.herokuapp.com/login/twitter',
    ],

    'facebook' => [
    'client_id' => '792281457545632',
    'client_secret' => '66a2751fc0da076b2ad5f49f51110551',
    'redirect' => 'http://nameless-lake-2987.herokuapp.com/login/facebook',
    ],


    'mailgun' => [
        'domain' => 'sandboxa77eaf2e32454f90a90352c8a25a640d.mailgun.org',
        'secret' => 'key-ba1a585ec1664d87e69650e26476307f',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => '',
        'secret' => '',
    ],

];
