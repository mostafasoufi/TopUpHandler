<?php

include "../vendor/autoload.php";

use TopUpHandler\TopUpHandler;

$config = array(
    'api' => [
        'url' => 'http://localhost:3001',
        'credential' => ['admin', 'admin']
    ],
    'notifications' => [
        'email' => [
            'enabled' => true,
            'message' => 'Hello, here are the problem. Line: %line%, Message: %message%',
        ],
        'sms' => [
            'enabled' => false,
            'message' => 'Hello, here are the problem. Line: %line%, Message: %message%',
        ]
    ]
);

$top = new TopUpHandler($config);

try {
    $balance = $top->getBalance(37250123123);
    echo '<pre>'.print_r($balance->isBlocked(), 1).'</pre>';
    echo '<pre>'.print_r($balance->response(), 1).'</pre>';

    $charge = $top->addBalance(3725123123, 'USD', 1000);
    echo '<pre>' . print_r($charge->response(), 1) . '</pre>';

} catch (Exception $e) {
    echo '<pre>' . print_r($e->getMessage(), 1) . '</pre>';
    echo '<pre>' . print_r($e->getFile(), 1) . '</pre>';
    echo '<pre>' . print_r($e->getLine(), 1) . '</pre>';
}