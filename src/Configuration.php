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
                    'message' => 'Hello,<br />Here are the problem.<br />Number: %number%<br />Response: %response%<br />Status Code: %statusCode%', // Message with variables.
                    'recipients' => ['devops@example.com', 'support@example.com']
                ],
                'sms' => [
                    'enabled' => true,
                    'message' => 'Hello,\n Here are the problem.\n Number: %number% \n Response: %response% \n Status Code: %',
                ]
            ]
        ];
    }

    /**
     * @return Configuration|instance
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
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