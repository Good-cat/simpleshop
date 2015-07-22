<?php
namespace AppBundle\Utils;

class CallMe {
    public function send(\Swift_Mailer $mailer, $name, $phone, $message = ""){
        $message = \Swift_Message::newInstance()
            ->setSubject('Заказ обратного звонка от ' . $name . ', номер телефона: ' . $phone)
            ->setFrom('carwest@tut.by')
            ->setTo('carwest@tut.by')
            ->setBody('Имя: ' . $name . ' Телефон: ' . $phone . ' Сообщение: ' . $message);

        if ($mailer->send($message)) {
            return true;
        } else {
            return false;
        }
    }
}