<?php

namespace TopUpHandler\Request;

use GuzzleHttp\Exception\GuzzleException;
use SimpleXMLElement;
use TopUpHandler\Response\BalanceResponse;
use TopUpHandler\Response\ChargeResponse;
use Exception;

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

        return new BalanceResponse($response);
    }

    /**
     * @param int $number
     * @param string $currency
     * @param float $balance
     * @return ChargeResponse
     * @throws GuzzleException
     */
    public function addBalance(int $number, string $currency, float $balance)
    {
        // Check the card is blocked or not.
        if ($this->getBalance($number)->isBlocked()) {
            throw new Exception('The card is blocked and can\'t charge.');
        }

        $response = $this->makeRequest([
            'action' => 'addBalance',
            'number' => $number,
            'currency' => $currency,
            'amount' => $balance
        ]);

        return new ChargeResponse($response);
    }
}