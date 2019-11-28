<?php

include "../vendor/autoload.php";

use TopUpHandler\TopUpHandler;

$balance = new TopUpHandler();

try{
    $balance = $balance->getBalance(37250123123);
    echo '<pre>'.print_r($balance, 1).'</pre>';

} catch (Exception $e) {
    echo '<pre>'.print_r($e->getMessage(), 1).'</pre>';
    echo '<pre>'.print_r($e->getFile(), 1).'</pre>';
    echo '<pre>'.print_r($e->getLine(), 1).'</pre>';
}