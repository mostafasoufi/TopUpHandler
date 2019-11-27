<?php

namespace TopUpHandler\Services;

use SimpleXMLElement;
use Exception;

class ChargeResponse extends ResponseAbstract implements ResponseInterface
{
    private $response;
    private $error;

    /**
     * Balance constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $this->response = $this->parseResponse($response);

        $this->repairResponse();
        $this->setErrors();
    }

    /**
     *
     */
    public function repairResponse()
    {

    }

    /**
     * @return mixed|void
     */
    public function setErrors()
    {
        if ($this->response->results->type == 'ERROR') {
            $this->error = $this->response->results->text;
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