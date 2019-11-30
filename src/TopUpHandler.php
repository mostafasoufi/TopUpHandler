<?php

namespace TopUpHandler;

use TopUpHandler\Request\Request;
use Exception;

class TopUpHandler
{
    /**
     * @var Request object.
     */
    private $request;

    /**
     * @var Config variable.
     */
    private $config;

    /**
     * TopUpHandler constructor.
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        if($config && is_array($config)) {
            $this->config = $config;
        } else {
            $this->config = new Config();
        }

        $this->request = new Request($this->config);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        if (!method_exists(Request::class, $name)) {
            throw new Exception('Method is not available.');
        }

        return call_user_func_array(array($this->request, $name), $arguments);
    }
}