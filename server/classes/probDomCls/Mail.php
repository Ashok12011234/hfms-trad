<?php
class Mail
{
    private static String $headers = "From: assignmentoneoop@gmail.com";
    private String $to;
    private String $subject;
    private String $body;

    public function __construct(String $to, String $subject, String $body)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
    }

    public function send(): bool
    {
        if (mail($this->to, $this->subject, $this->body, self::$headers)) {
            return true;
            //echo "Email successfully sent to $this->to...";
        } else {
            return false;
            //echo "Email sending failed...";
        }
        
        //return MailSender::sendMail("clinet", $this->to, $this->subject, $this->body);
    }

    public static function isValidEmailAddress(String $emailAddress): bool
    {
        return filter_var($emailAddress, FILTER_VALIDATE_EMAIL);
    }
}

/*
------------SAMPLE CODE-------------
$to = "assignmentoneoop@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi";
$mail = new Mail($to, $subject, $body);
$mail->send();
------------------------------------
*/
