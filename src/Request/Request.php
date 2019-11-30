<?php

namespace TopUpHandler\Request;

use GuzzleHttp\Exception\GuzzleException;
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
     * @param int $number
     * @return BalanceResponse
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
     * @param float $amount
     * @return ChargeResponse
     * @throws GuzzleException
     */
    public function addBalance(int $number, string $currency, float $amount)
    {
        // Get balance.
        $balance = $this->getBalance($number);

        // Check the card is blocked or not.
        if ($balance->isBlocked())
            throw new Exception('The card is blocked and can\'t charge.');

        // Check currency
        if ($currency != $balance->getCurrency())
            throw new Exception('The currency is not valid.');

        // Check the negative balance.
        if ($balance->getbalance() <= -5)
            throw new Exception('The balance is not valid.');

        // Add enough money to some card that are negative.
        if ($balance->getbalance() < -0.01 and $balance->getbalance() >= -4.99)
            $amount += abs($balance->getbalance());

        // Make request.
        $response = $this->makeRequest([
            'action' => 'addBalance',
            'number' => $number,
            'currency' => $currency,
            'amount' => $amount
        ]);

        // Get charge response.
        return new ChargeResponse($response);
    }
}