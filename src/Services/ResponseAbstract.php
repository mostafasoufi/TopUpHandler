<?php

namespace TopUpHandler\Services;

use SimpleXMLElement;
use DOMDocument;
use Exception;
use LibXMLError;

abstract class ResponseAbstract
{
    /**
     * @param $response
     * @return SimpleXMLElement
     * @throws Exception
     */
    protected function parseResponse($response)
    {
        if ($error = $this->hasError($response)) {
            throw new Exception($error->message);
        }

        return $this->toArray(new SimpleXMLElement($response));
    }

    /**
     * @param $object
     * @return mixed
     */
    private function toArray($object)
    {
        return json_decode(json_encode($object), true);
    }

    /**
     * @param $source
     * @return LibXMLError
     */
    private function hasError($source)
    {
        libxml_use_internal_errors(true);

        $doc = new DOMDocument();
        $doc->loadXML($source);

        return libxml_get_last_error();
    }
}