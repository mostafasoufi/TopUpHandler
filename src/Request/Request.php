<?php

namespace TopUpHandler\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Exception;
use TopUpHandler\Configuration;

class Request
{
    public $config;
    public $client;

    /**
     * Request constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;

        $this->client = new Client([
            'base_uri' => $this->config['api']['url'],
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
            'auth' => $this->config['api']['credential'],
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