<?php

namespace TopUpHandler\Notification;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SMS implements NotificationInterface
{
    /**
     * SMS constructor.
     */
    public function __construct()
    {
    }

    /**
     * Send SMS.
     * @param $number
     * @param $message
     * @return string
     * @throws GuzzleException
     */
    public static function send($number, $message)
    {
        $client = new Client([
            'base_uri' => 'https://sms.example.com',
            'timeout' => 5,
            'exceptions' => false,
        ]);

        $response = $client->request('GET', null, [
            'query' => ['to' => $number, 'text' => $message],
        ]);

        return $response->getBody()->getContents();
    }
}