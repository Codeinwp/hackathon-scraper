<?php
class Send_Email {

    private $email = '';

    /**
     * Class constructor
     */
    public function __construct() {
       $this->email = 'rodica@themeisle.com';
    }

    public function sendEmail() {
        $subject = 'Demo is not valid anymore';
        $message = 'This demo is not using our team anymore';
        $headers = 'From: friends@themeisle.com' . "\r\n" .
            'Reply-To: friends@themeisle.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail( $this->email, $subject, $message, $headers );
    }
}