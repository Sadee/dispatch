<?php


namespace App;


use \Mail\MailTrigger;


/**
 * Class Mails
 * @package App
 */
class Notification
{

    /**
     * @param $subject
     * @param $message
     */
    public static function sendNotification($subject, $message)
    {
        $details = [
            'title' => 'Notification!',
            'subject' => $subject,
            'view' => "emails.notification",
            'params' => ['message' => $message]
        ];
        Mail::to(env('MAIL_TO_ADDRESS'))->send(new MailTrigger($details));
    }
}