<?php

namespace TopUpHandler\Response;

use SimpleXMLElement;
use Exception;

class BalanceResponse extends ResponseAbstract implements ResponseInterface
{
    /**
     * All errors for current method and can be update.
     * @var array Error messages.
     */
    public $errorMessages = [
        'Card not found' => 'The number is not exist.',
        'Syntax error' => 'The parameters is missing.',
        'Не атрымалася ініцыялізаваць пар' => 'Unexpected error.',
    ];

    /**
     * Balance constructor.
     * @param $response
     * @throws Exception
     */
    public function __construct($response)
    {
        $this->response = $this->parseResponse($response);

        $this->validation();
    }

    /**
     * Check response validation.
     * @return mixed|void
     * @throws Exception
     */
    public function validation()
    {
        if (isset($this->response['type']) and $this->response['type'] == 'ERROR') {
            throw new Exception($this->getErrorMessage($this->response['text']));
        }
    }

    /**
     * Get response.
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
}