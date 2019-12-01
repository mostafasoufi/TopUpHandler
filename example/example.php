<?php

include "../vendor/autoload.php";

use TopUpHandler\TopUpHandler;

$top = new TopUpHandler();

try {
    // Get balance.
    $balance = $top->getBalance(37250123123);

    // Get the blocked status.
    echo '<pre>' . print_r($balance->isBlocked(), 1) . '</pre>';

    // Get the response.
    echo '<pre>' . print_r($balance->response(), 1) . '</pre>';

    // Charge the number.
    $charge = $top->addBalance(3725123123, 'USD', 1000);

    // Get the response.
    echo '<pre>' . print_r($charge->response(), 1) . '</pre>';

} catch (Exception $e) {
    echo $e->getMessage();
}