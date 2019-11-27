<?php

namespace TopUpHandler\Services;

use SimpleXMLElement;

abstract class ResponseAbstract
{
    /**
     * @param $response
     * @return SimpleXMLElement
     */
    protected function parseResponse($response)
    {
        return new SimpleXMLElement($response->getBody()->getContents());
    }
}