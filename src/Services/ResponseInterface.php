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
    public function repairResponse();

    /**
     * @return mixed
     */
    public function setErrors();

    /**
     * @return mixed
     */
    public function response();
}