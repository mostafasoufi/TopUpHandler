<?php

include "../vendor/autoload.php";

use TopUpHandler\TopUpHandler;

$top = new TopUpHandler();

try {
    $balance = $top->getBalance(37250123123);
    echo '<pre>'.print_r($balance->isBlocked(), 1).'</pre>';
    echo '<pre>'.print_r($balance->response(), 1).'</pre>';

    $charge = $top->addBalance(3725123123, 'EUR', 1000);
    echo '<pre>' . print_r($charge->response(), 1) . '</pre>';

} catch (Exception $e) {
    echo '<pre>' . print_r($e->getMessage(), 1) . '</pre>';
    echo '<pre>' . print_r($e->getFile(), 1) . '</pre>';
    echo '<pre>' . print_r($e->getLine(), 1) . '</pre>';
}