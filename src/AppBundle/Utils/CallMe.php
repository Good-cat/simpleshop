<?php
namespace AppBundle\Utils;

class CallMe {
    public function send(\Swift_Mailer $mailer, $name, $phone, $message = ""){
        $message = \Swift_Message::newInstance()
            ->setSubject('Заказ обратного звонка от' . $name . $phone)
            ->setFrom('carwest@tut.by')
            ->setTo('carwest@tut.by')
            ->setBody($phone . $message)
        ;
        $mailer->send($message);
    }
}