<?php

namespace TopUpHandler\Services;

use SimpleXMLElement;
use Exception;

class BalanceResponse extends ResponseAbstract implements ResponseInterface
{
    private $response;
    private $error;

    /**
     * Balance constructor.
     * @param $response
     * @throws Exception
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
        foreach ($this->response as $item) {

        }
    }

    /**
     * @return mixed|void
     */
    public function setErrors()
    {
        if (isset($this->response['type']) and $this->response['type'] == 'ERROR') {
            $this->error = $this->response['text'];
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