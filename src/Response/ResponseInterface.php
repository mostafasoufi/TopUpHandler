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
    public function response();

    /**
     * @return mixed
     */
    public function needRequestAgain();
}