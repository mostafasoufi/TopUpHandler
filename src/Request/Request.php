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
     * Get balance method.
     * @param $number
     * @return SimpleXMLElement
     * @throws GuzzleException
     */
    public function getBalance(int $number)
    {
        // Make request.
        $response = $this->makeRequest([
            'action' => 'getBalance',
            'number' => $number
        ]);

        // Get balance response.
        return new BalanceResponse($response);
    }

    /**
     * Add balance method.
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

        // Make request.
        $response = $this->makeRequest([
            'action' => 'addBalance',
            'number' => $number,
            'currency' => $currency,
            'amount' => $balance
        ]);

        // Get charge response.
        return new ChargeResponse($response);
    }
}