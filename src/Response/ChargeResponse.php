<?php

namespace TopUpHandler\Response;

use SimpleXMLElement;
use Exception;

class ChargeResponse extends ResponseAbstract implements ResponseInterface
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
        $this->errorHandling = new ErrorHandling($this->response);
    }

    /**
     * Get response.
     * @return SimpleXMLElement
     * @throws Exception
     */
    public function response()
    {
        return $this->response;
    }

    /**
     * Check if the request needs to send again or not.
     * @return mixed
     */
    public function needRequestAgain()
    {
        return $this->errorHandling->hasRequestAction();
    }
}