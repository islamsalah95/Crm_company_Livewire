<?php
return [
    'client_id' => env('client_id'),
    'client_secret' => env('client_secret'),
    'base_url' => 'https://api.zoom.us/v2/',
    'redirect_uri' => 'http://127.0.0.1:8000/zoom/show',
    'token_url' => 'https://zoom.us/oauth/token',
    'api_url' => 'https://api.zoom.us/v2/',
    'authorize_url' => 'https://zoom.us/oauth/authorize?client_id='.env('client_id').'&response_type=code&redirect_uri=http://127.0.0.1:8000/zoom/show',
];

?>
