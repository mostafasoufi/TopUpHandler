<?php

namespace TopUpHandler\Services;

interface ResponseInterface
{
    /**
     * ResponseInterface constructor.
     * @param $response
     */
    public function __construct($response);

    /**
     * @return mixed
     */
    public function setError();

    /**
     * @return mixed
     */
    public function response();
}