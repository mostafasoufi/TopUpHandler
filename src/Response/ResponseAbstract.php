<?php

namespace TopUpHandler\Response;

use SimpleXMLElement;
use DOMDocument;
use Exception;

abstract class ResponseAbstract
{
    /**
     * @var Response variable.
     */
    public $response;

    /**
     * @var Error handling object.
     */
    public $errorHandling;

    /**
     * ResponseAbstract constructor.
     */
    public function __construct()
    {

    }

    /**
     * Parse response method.
     * @param $response
     * @return SimpleXMLElement
     * @throws Exception
     */
    protected function parseResponse($response)
    {
        if ($error = $this->xmlHasError($response)) {
            throw new Exception($error['message']);
        }

        return $this->toArray(new SimpleXMLElement($response));
    }

    /**
     * Convert object to array.
     * @param $object
     * @return mixed
     */
    private function toArray($object)
    {
        return json_decode(json_encode($object), true);
    }

    /**
     * Check the xml is valid or not.
     * @param $source
     * @return array
     */
    private function xmlHasError($source)
    {
        if (!$source) {
            return array('message' => 'The response is empty.');
        }

        libxml_use_internal_errors(true);

        $doc = new DOMDocument();
        $doc->loadXML($source);
        $error = libxml_get_last_error();

        return $error ? (array)$error : false;
    }
}