<?php

namespace TopUpHandler\Services;

use SimpleXMLElement;
use Exception;

class ChargeResponse extends ResponseAbstract implements ResponseInterface
{
    /**
     * @var array Error messages.
     */
    public $errorMessages = [
        
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