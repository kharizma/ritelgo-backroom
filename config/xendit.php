<?php

return [
    'key_auth' => base64_encode(env('SECRET_KEY_XENDIT') . ':'),
    'callback_url' => env('CALLBACK_URL'),
    'token_verify' => env('TOKEN_VERIFY_XENDIT'),
];