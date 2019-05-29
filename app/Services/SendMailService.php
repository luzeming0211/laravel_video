<?php
namespace App\Services;

use Illuminate\Support\Facades\Mail;

class SendMailService{

    public static function send($code, $email,$subject)
    {
        $emailData = [
            'content' => $code,
            'subject' => $subject,//邮件主题
            'addr' => $email,//邮件接收地址
        ];
        self::sendText($emailData);
    }
    public  static function sendText($emailData){
      Mail::raw($emailData['content'],
                function ($message)use ($emailData){
                    $message->subject($emailData['subject']);
                    $message->to($emailData['addr']);
                });
    }
    public  static function sendHtml($viewPage,$viewData,$emailData){
        Mail::send($viewPage,$viewData,
                function ($message) use ($emailData){
                    $message->subject($emailData['subject']);
                    $message->to($emailData['addr']);
                });
    }
}