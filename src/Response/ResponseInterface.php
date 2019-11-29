<?php

namespace TopUpHandler\Response;

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
    public function validation();

    /**
     * @return mixed
     */
    public function response();
}