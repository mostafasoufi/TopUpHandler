<?php

namespace TopUpHandler\Services;

use SimpleXMLElement;
use Exception;

class BalanceResponse extends ResponseAbstract implements ResponseInterface
{
    /**
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

        $this->setError();
    }

    /**
     * @return mixed|void
     */
    public function setError()
    {
        if (isset($this->response['type']) and $this->response['type'] == 'ERROR') {
            $this->error = $this->getErrorMessage($this->response['text']);
        }
    }

    /**
     * @return SimpleXMLElement
     * @throws Exception
     */
    public function response()
    {
        if ($this->error) {
            throw new Exception($this->error);
        }

        return $this->response;
    }
}