<?php

namespace TopUpHandler\Services;

use GuzzleHttp\Exception\GuzzleException;
use SimpleXMLElement;

class Request extends RequestAbstract
{
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

        return $this->parseResponse($response);
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

        return $this->parseResponse($response);
    }
}