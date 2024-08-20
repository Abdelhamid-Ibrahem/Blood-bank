<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use GuzzleHttp\Client;

class FirebaseNotification extends Notification
{
    use Queueable;

    private $title;
    private $body;
    private $tokens; // مصفوفة تحتوي على رموز الأجهزة المستقبلة للإشعار

    public function __construct($title, $body, $tokens)
    {
        $this->title = $title;
        $this->body = $body;
        $this->tokens = $tokens;
    }

    public function via($notifiable)
    {
        return ['firebase'];
    }

    public function toFirebase($notifiable)
    {
        $data = [
            'notification' => [
                'title' => $this->title,
                'body' => $this->body,
            ],
            'registration_ids' => $this->tokens,
        ];

        $client = new Client();
        $response = $client->post(' https://fcm.googleapis.com/v1/projects/blood-bank-f2076/messages:send', [
            'headers' => [
                'Authorization' =>  'Bearer ya29.cCt1bTVxT-mIjvG4Yjnulf:APA91bFysYyh6rSe1cseylFiRkVqpmMdAL2guArKp9yDNEJDwPAcBdIm_xWQGhAgo-ux_EEzmcGBGYG2mKb6h3VMkg7lxj5rRWLJLMENx53it_RloB5nlIs1efJeBoZGM-THZDitBXF6', // استبدل YOUR_SERVER_KEY بمفتاح الخادم الخاص بك
                'Content-Type'  => 'application/json',
            ],
            'json' => $data,
        ]);

        return $response->getBody()->getContents();
        }
}
