<?php

include "../vendor/autoload.php";

use TopUpHandler\TopUpHandler;

$balance = new TopUpHandler();

try{
    echo '<pre>' . print_r($balance->getBalance(37250123123), 1) . '</pre>';
    //echo '<pre>' . print_r($balance->addBalance(90000), 1) . '</pre>';
} catch (Exception $e) {
    echo '<pre>'.print_r($e->getMessage(), 1).'</pre>';
    echo '<pre>'.print_r($e->getFile(), 1).'</pre>';
    echo '<pre>'.print_r($e->getLine(), 1).'</pre>';
}