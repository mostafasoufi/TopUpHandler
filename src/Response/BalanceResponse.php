<?php

namespace TopUpHandler\Response;

use SimpleXMLElement;
use Exception;

class BalanceResponse extends ResponseAbstract implements ResponseInterface
{
    /**
     * Balance constructor.
     * @param $response
     * @throws Exception
     */
    public function __construct($response)
    {
        parent::__construct();

        // Parse response.
        $this->response = $this->parseResponse($response);

        // Initial error handling.
        new ErrorHandling($this->response);
    }

    /**
     * Get all object from response.
     * @return mixed|SimpleXMLElement
     */
    public function response()
    {
        return $this->response['card'];
    }

    /**
     * Check the response is blocked or not.
     * @return bool
     */
    public function isBlocked()
    {
        return $this->response['card']['blocked'] == 'true' ? true : false;
    }

    /**
     * Get balance.
     * @return SimpleXMLElement
     */
    public function getBalance()
    {
        return $this->response['card']['balance'];
    }

    /**
     * Get currency.
     * @return SimpleXMLElement
     */
    public function getCurrency()
    {
        return $this->response['card']['curr'];
    }
}