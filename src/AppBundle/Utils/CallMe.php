<?php
namespace AppBundle\Utils;

class CallMe {
    public function send(\Swift_Mailer $mailer, $name, $phone, $message = ""){
        $message = \Swift_Message::newInstance()
            ->setSubject($name)
            ->setFrom('carwest@tut.by')
            ->setTo('carwest@tut.by')
            ->setBody($phone . $message)
        ;
        $mailer->send($message);
    }
}