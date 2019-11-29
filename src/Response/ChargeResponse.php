<?php

namespace TopUpHandler\Response;

use SimpleXMLElement;
use Exception;

class ChargeResponse extends ResponseAbstract implements ResponseInterface
{
    /**
     * @var array Error messages.
     */
    public $errorMessages = [
        'Card not found' => 'The number is not exist.',
        'Syntax error' => 'The parameters is missing.',
        'Не атрымалася ініцыялізаваць пар' => 'Unexpected error.',
    ];

    /**
     * Balance constructor.
     * @param $response
     * @throws Exception
     */
    public function __construct($response)
    {
        $this->response = $this->parseResponse($response);

        $this->validation();
    }

    /**
     * @return mixed|void
     * @throws Exception
     */
    public function validation()
    {
        if (isset($this->response['type']) and $this->response['type'] == 'ERROR') {
            throw new Exception($this->getErrorMessage($this->response['text']));
        }

        if ($this->response['result'] != 'Ok') {
            throw new Exception($this->response['result']);
        }
    }

    /**
     * @return SimpleXMLElement
     * @throws Exception
     */
    public function response()
    {
        return $this->response;
    }
}