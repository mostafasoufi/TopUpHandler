<?php

namespace TopUpHandler\Test;

use PHPUnit\Framework\TestCase;
use TopUpHandler\Configuration;
use TopUpHandler\TopUpHandler;

class TopUpHandlerTest extends TestCase
{
    /**
     * Instance main class test.
     */
    public function testInstanceMainClass()
    {
        $instance = new TopUpHandler();
        $this->assertInstanceOf(TopUpHandler::class, $instance);
    }

    /**
     * Instance configuration class test.
     */
    public function testInstanceConfigurationClass()
    {
        $instance = new Configuration();
        $this->assertInstanceOf(Configuration::class, $instance);
    }
}