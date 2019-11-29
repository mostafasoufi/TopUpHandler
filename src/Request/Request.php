<?php

namespace TopUpHandler\Request;

use GuzzleHttp\Exception\GuzzleException;
use SimpleXMLElement;
use TopUpHandler\Response\BalanceResponse;
use TopUpHandler\Response\ChargeResponse;

class Request extends RequestAbstract
{
    /**
     * Request constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $number
     * @return SimpleXMLElement
     * @throws GuzzleException
     */
    public function getBalance(int $number)
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
    public function addBalance(int $number, string $currency, float $balance)
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