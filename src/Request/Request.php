<?php

namespace TopUpHandler\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Exception;

class Request
{
    public $config;
    public $client;
    private $auth;
    const BASE_URL = 'http://localhost:3001';

    /**
     * Request constructor.
     * @param $config
     */
    public function __construct($config)
    {
        // Set config.
        $this->config = $config; // TODO

        // Set authentication.
        $this->auth = ['username', 'password'];

        $this->client = new Client([
            'base_uri' => self::BASE_URL,
            'timeout' => 5,
            'exceptions' => false,
        ]);
    }

    /**
     * Make client request.
     * @param $params
     * @param string $type
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     */
    public function makeRequest($params, $type = 'GET')
    {
        $response = $this->client->request($type, null, [
            'query' => $params,
            'auth' => $this->auth,
        ]);

        if ($response->getStatusCode() != 200) {
            // Send Notification for some status codes.
            if ($response->getStatusCode() == 404 or $response->getStatusCode() == 500) {
                // TODO
            }

            throw new Exception(sprintf('%s Error - System error.', $response->getStatusCode()));
        }

        return $response->getBody()->getContents();
    }
}