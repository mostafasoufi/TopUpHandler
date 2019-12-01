<?php

include "../vendor/autoload.php";

use TopUpHandler\TopUpHandler;

$config = array(
    'api' => [
        //'url' => 'https://legacyapi.example.com', // API address, default is http://localhost:3001
        'credential' => ['admin', 'waGQeCLNjZ7'] // Username and Password, default is admin 123456
    ],
    'notifications' => [
        'email' => [
            'enabled' => false, // Status
            'message' => 'Hello,<br />Now problem happened, here are the information of problem.<br />Mobile number: %number%<br />Response: %response%<br />Status Code: %statusCode%', // Message with variables.
            'recipients' => ['devops@example.com', 'support@example.com'] // An array for getting email, first key for to and second key for CC.
        ],
        'sms' => [
            'enabled' => false,
            'message' => 'Hello,\n here are the problem.\n Number: %number% \n Response: %response% \n Status Code: %',
        ]
    ]
);

$top = new TopUpHandler($config);

try {
    $balance = $top->getBalance(37250123123);
    echo '<pre>' . print_r($balance->isBlocked(), 1) . '</pre>';
    echo '<pre>' . print_r($balance->response(), 1) . '</pre>';

    $charge = $top->addBalance(3725123123, 'USD', 1000);
    echo '<pre>' . print_r($charge->response(), 1) . '</pre>';

} catch (Exception $e) {
    echo '<pre>' . print_r($e->getMessage(), 1) . '</pre>';
    echo '<pre>' . print_r($e->getFile(), 1) . '</pre>';
    echo '<pre>' . print_r($e->getLine(), 1) . '</pre>';
}