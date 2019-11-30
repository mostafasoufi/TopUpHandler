<?php

namespace TopUpHandler;

use TopUpHandler\Request\Request;
use Exception;

class TopUpHandler
{
    private $request;

    public function __construct(array $config = array())
    {
        /*if($config && is_array($config)) {
            $this->config = $config;
        } else {
            $this->config = new Config();
        }*/

        $this->request = new Request();
    }

    public function __call($name, $arguments)
    {
        if (!method_exists(Request::class, $name)) {
            throw new Exception('Method is not available.');
        }

        return call_user_func_array(array($this->request, $name), $arguments);
    }
}