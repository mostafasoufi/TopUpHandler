<?php

namespace TopUpHandler\Response;

use Exception;

class ErrorHandling
{
    /**
     * All errors for current method and can be update.
     * @var array Error messages.
     */
    public $messages = [
        'Card not found' => array('The number is not exist.', ''),
        'Syntax error' => array('The parameters is missing.', ''),
        'Не атрымалася ініцыялізаваць пар' => array('Unexpected error.', 'request'),
    ];

    /**
     * @var Response message.
     */
    public $responseMessage;

    /**
     * ErrorHandling constructor.
     * @param string $responseMessage
     * @throws Exception
     */
    public function __construct($responseMessage)
    {
        $this->responseMessage = $responseMessage;

        $this->validation();
    }

    /**
     * Check response validation.
     * @return mixed|void
     * @throws Exception
     */
    public function validation()
    {
        if (isset($this->responseMessage['type']) and $this->responseMessage['type'] == 'ERROR') {
            throw new Exception($this->responseMessage['text']);
        }

        if (isset($this->responseMessage['result']) and $this->responseMessage['result'] != 'Ok') {
            throw new Exception($this->responseMessage['result']);
        }
    }

    /**
     * Get better error messages.
     * @return string
     */
    public function getErrorMessage()
    {
        if (empty($this->messages[$this->responseMessage][0])) {
            return 'Undefined error.';
        }

        return $this->messages[$this->responseMessage][0];
    }

    public function hasAction()
    {
        return false;
    }

    /**
     * @param $type
     */
    public function notification($type)
    {

    }
}