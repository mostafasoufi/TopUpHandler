<?php

namespace TopUpHandler;

class Configuration
{
    /**
     * @var array
     */
    static $configArray;

    /**
     * @var instance
     */
    private static $instance;

    public function __construct()
    {
        self::$configArray = [
            'api' => [
                'url' => 'http://localhost:3001',
                'credential' => ['admin', 'admin']
            ],
            'notifications' => [
                'email' => [
                    'enabled' => true,
                    'message' => 'Hello, here are the problem. Line: %line%, Message: %message%',
                ],
                'sms' => [
                    'enabled' => true,
                    'message' => 'Hello, here are the problem. Line: %line%, Message: %message%',
                ]
            ]
        ];
    }

    /**
     * @return Configuration|instance
     */
    public static function getInstance()
    {
        if ( is_null( self::$instance ) )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get all configurations.
     * @return array
     */
    public static function getAll()
    {
        return self::$configArray;
    }
}