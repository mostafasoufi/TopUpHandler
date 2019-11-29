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
     * @param $response
     * @return SimpleXMLElement
     * @throws Exception
     */
    protected function parseResponse($response)
    {
        if ($error = $this->hasError($response)) {
            throw new Exception($error['message']);
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
     * @return array
     */
    private function hasError($source)
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

    /**
     * @param $string
     * @return string
     */
    public function getErrorMessage($string)
    {
        if (empty($this->errorMessages[$string])) {
            return 'Undefined error.';
        }

        return $this->errorMessages[$string];
    }
}