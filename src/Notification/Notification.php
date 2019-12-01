<?php

namespace TopUpHandler\Notification;

class Notification
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var string
     */
    public $number;

    /**
     * @var string
     */
    public $response;

    /**
     * Notification constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Initial notifications.
     */
    public function init()
    {
        if ($this->config['email']['enabled']) {
            $this->sendEmail();
        }

        if ($this->config['sms']['enabled']) {
            $this->sendSMS();
        }
    }

    /**
     * Get converted message with variables.
     * @param $message
     * @return mixed
     */
    private function getConvertedMessage($message)
    {
        $template_vars = array(
            '%number%' => $this->number,
            '%response%' => $this->response->getBody()->getContents(),
            '%statusCode%' => $this->response->getStatusCode(),
        );

        return str_replace(array_keys($template_vars), array_values($template_vars), $message);
    }

    /**
     * Send email.
     */
    public function sendEmail()
    {
        $recipients = array(
            'to' => $this->config['email']['recipients'][0],
            'cc' => $this->config['email']['recipients'][1],
        );

        $subject = sprintf('New Issue for %s', $this->number);
        Email::send($recipients, $subject, $this->getConvertedMessage($this->config['email']['message']));
    }

    /**
     * Send SMS.
     */
    public function sendSMS()
    {
        SMS::send($this->number, $this->getConvertedMessage($this->config['sms']['message']));
    }
}