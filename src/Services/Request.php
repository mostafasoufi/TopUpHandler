<?php

namespace TopUpHandler\Services;

use GuzzleHttp\Exception\GuzzleException;
use SimpleXMLElement;

class Request extends RequestAbstract
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $number
     * @return SimpleXMLElement
     * @throws GuzzleException
     */
    public function getBalance($number)
    {
        $response = $this->makeRequest([
            'action' => 'getBalance',
            'number' => $number
        ]);

        $balance = new BalanceResponse($response);
        return $balance->response();
    }

    /**
     * @param $number
     * @param $currency
     * @param $balance
     * @return SimpleXMLElement
     * @throws GuzzleException
     */
    public function addBalance($number, $currency, $balance)
    {
        $response = $this->makeRequest([
            'action' => 'getBalance',
            'number' => $number,
            'currency' => $currency,
            'amount' => $balance
        ]);

        $charge = new ChargeResponse($response);
        return $charge->response();
    }
}