<?php

namespace TopUpHandler;

use GuzzleHttp\Exception\GuzzleException;
use TopUpHandler\Request\Request;
use Exception;
use TopUpHandler\Response\BalanceResponse;
use TopUpHandler\Response\ChargeResponse;

class TopUpHandler
{
    /**
     * @var Request object.
     */
    private $request;

    /**
     * @var Config variable.
     */
    private $config;

    /**
     * TopUpHandler constructor.
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        // Sync configurations
        $this->syncConfiguration($config);

        // Initial request.
        $this->request = new Request($this->config);
    }

    /**
     * Sync configuration.
     * @param $config
     */
    private function syncConfiguration($config)
    {
        // Instance the configuration.
        Configuration::getInstance();

        // Sync default and custom configuration.
        $this->config = array_replace_recursive($config, Configuration::getAll(), $config);
    }

    /**
     * Get balance method.
     * @param $number
     * @return BalanceResponse
     * @throws Exception
     * @throws GuzzleException
     */
    public function getBalance(int $number)
    {
        // Make request.
        $response = $this->request->makeRequest([
            'action' => 'getBalance',
            'number' => $number
        ]);

        // Get balance response.
        $response = new BalanceResponse($response);

        // Check if the request needs run again.
        if ($response->needRequestAgain()) {
            $this->getBalance($number);
        }

        return $response;
    }

    /**
     * Add balance method.
     * @param $number
     * @param $currency
     * @param $amount
     * @return ChargeResponse
     * @throws Exception
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
        if ($balance->getBalance() <= -5)
            throw new Exception('The balance is not valid.');

        // Add enough money to some card that are negative.
        if ($balance->getBalance() < -0.01 and $balance->getBalance() >= -4.99)
            $amount += abs($balance->getBalance());

        // Make request.
        $response = $this->request->makeRequest([
            'action' => 'addBalance',
            'number' => $number,
            'currency' => $currency,
            'amount' => $amount
        ]);

        // Get charge response.
        $response = new ChargeResponse($response);

        // Check if the request needs run again.
        if ($response->needRequestAgain()) {
            $this->getBalance($number);
        }

        return $response;
    }
}