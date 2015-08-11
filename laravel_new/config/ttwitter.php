<?php

// You can find the keys here : https://apps.twitter.com/

return [
    'debug' => true,
    'API_URL' => 'api.twitter.com',
    'UPLOAD_URL' => 'upload.twitter.com',
    'API_VERSION' => '1.1',
    'AUTHENTICATE_URL' => 'https://api.twitter.com/oauth/authenticate',
    'AUTHORIZE_URL' => 'https://api.twitter.com/oauth/authorize',
    'ACCESS_TOKEN_URL' => 'https://api.twitter.com/oauth/access_token',
    'REQUEST_TOKEN_URL' => 'https://api.twitter.com/oauth/request_token',
    'USE_SSL' => true,
    'CONSUMER_KEY' => env('TWITTER_CONSUMER_KEY', 'K4OhivROmNVBvHmRt0M73DfUI'),
    'CONSUMER_SECRET' => env('TWITTER_CONSUMER_SECRET', 'z30imW9fQeNwobdRUOrNDl59M3CTxVTIIipaV8g8iX5rrCc9MV'),
    'ACCESS_TOKEN' => env('TWITTER_ACCESS_TOKEN', '1650864428-hhbBSZ0ZMAUhWWdkdzhtidGJZcal3qXqnd7Mrf2'),
    'ACCESS_TOKEN_SECRET' => env('TWITTER_ACCESS_TOKEN_SECRET', 'mpqS9LnzxWZSzrWVObcyYbdjOmhHkVHAFu988Mygbw1KM'),
];
