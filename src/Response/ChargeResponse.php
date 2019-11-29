<?php

namespace TopUpHandler\Response;

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
     * @throws Exception
     */
    public function setError()
    {
        if (isset($this->response['type']) and $this->response['type'] == 'ERROR') {
            throw new Exception($this->getErrorMessage($this->response['text']));
        }
    }

    /**
     * @return SimpleXMLElement
     * @throws Exception
     */
    public function response()
    {
        return $this->response;
    }
}