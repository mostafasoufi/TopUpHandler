<?php

namespace TopUpHandler\Response;

use Exception;

class ErrorHandling
{
    /**
     * All errors for current method and can be update.
     * @var array Error messages.
     */
    private $messages = [
        'Card not found' => array('The number is not exist.', ''), // 'API Message' => array('Production Message', 'Action, example: request or etc.')
        'Syntax error' => array('The parameters is missing.', ''),
        'Не атрымалася ініцыялізаваць пар' => array('Unexpected error.', 'request'),
        'не ўдалося дадаць грошы на карту' => array('Unexpected error.', 'request'),
    ];

    /**
     * @var Response message.
     */
    public $responseMessage;

    /**
     * @var Current error variable.
     */
    private $error;

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
    private function validation()
    {
        if (isset($this->responseMessage['type']) and $this->responseMessage['type'] == 'ERROR') {
            $this->error = $this->responseMessage['text'];
        }

        if (isset($this->responseMessage['result']) and $this->responseMessage['result'] != 'Ok') {
            $this->error = $this->responseMessage['result'];
        }

        if ($this->getError() and !$this->hasRequestAction()) {
            throw new Exception($this->getErrorMessage());
        }
    }

    /*
     * Get better error messages.
     * @return string
     */
    private function getErrorMessage()
    {
        if (empty($this->messages[$this->error][0])) {
            return 'Undefined error.';
        }

        return $this->messages[$this->error][0];
    }

    /**
     * @return bool
     */
    public function getAction()
    {
        return isset($this->messages[$this->error][1]) ? $this->messages[$this->error][1] : false;
    }

    /**
     * @return bool
     */
    public function getError()
    {
        return $this->error ? true : false;
    }

    /**
     * @return bool Check the action is request.
     */
    public function hasRequestAction()
    {
        if ($this->getAction() == 'request') {
            return true;
        }
    }
}