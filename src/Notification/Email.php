<?php

namespace TopUpHandler\Notification;

class Email implements NotificationInterface
{
    /**
     * Email constructor.
     */
    public function __construct()
    {
    }

    /**
     * Send email.
     * @param $recipients
     * @param $subject
     * @param $message
     */
    public static function send($recipients, $subject, $message)
    {
        // Additional headers
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = sprintf('Cc: %s', $recipients['cc']);

        // Mail it
        mail($recipients['to'], $subject, $message, implode("\r\n", $headers));
    }
}