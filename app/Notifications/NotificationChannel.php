<?php

namespace App\Notifications;

use Illuminate\Notifications\Channels\DatabaseChannel;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;
use NotificationChannels\Fcm\Resources\Notification as NotificationResource;

abstract class NotificationChannel extends Notification
{
    public $notifiable;

    public function via($notifiable)
    {
        $this->notifiable = $notifiable;

        return [
            DatabaseChannel::class,
            FcmChannel::class,
        ];
    }

    public function toFcm($notifiable): FcmMessage
    {
        $this->notifiable = $notifiable;

        return (new FcmMessage(notification: new FcmNotification(
            title: $this->getTitle('test'),
            body: $this->getBody('test'),
            image: $this->getImage('test'),
        )))
            ->notification($this->getNotification())
            ->data($this->getFcmData())
            ->custom([
                'android' => [
                    'notification' => [
                        'color' => '#0A0A0A',
                        'channel_id' => 'test', // ex: project name
                        'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                        'image' => $this->getImage(),
                    ],
                    'fcm_options' => [
                        'analytics_label' => 'android-'.$this->getCode(),
                    ],
                ],
                'apns' => [
                    'fcm_options' => [
                        'analytics_label' => 'ios-'.$this->getCode(),
                        'image' => $this->getImage(),
                    ],
                ],
            ]);
    }

    public function getNotification(): ?NotificationResource
    {
        return NotificationResource::create()
            ->title($this->getTitle())
            ->image($this->getImage())
            ->body($this->getBody());
    }

    public function toDatabase($notifiable)
    {
        $this->notifiable = $notifiable;
        $this->locale($notifiable->locale);

        return [
            'title' => $this->getTitle(),
            'body' => $this->getBody(),
            'code' => $this->getCode(),
            'data' => $this->getData() ?: null,
            'sender_name' => $this->getSenderName(),
            'sender_image' => $this->getImage(),
        ];
    }
    public function toBroadcast($notifiable)
    {

        return new BroadcastMessage([
            'title' => $this->getTitle(),
            'body' => $this->getBody(),
            'code' => $this->getCode(),
            'data' => $this->getData() ?: null,
            'sender_name' => $this->getSenderName(),
            'sender_image' => $this->getImage(),

        ]) ;


    }

    abstract public function getCode(): string;

    abstract public function getTitle(): string;

    abstract public function getBody(): string;

    public function getAttributes(): array
    {
        return [];
    }

    abstract public function getData(): array;

    public function getImage(): ?string
    {
       // return asset('img/exmaple.svg'); //push notification image
    }

    public function getSenderName(): ?string
    {
        return ''; // application name
    }

    public function getFcmData(): array
    {
        $data = $this->getData();

        return [
            'code' => $this->getCode(),
            'data' => $data ? json_encode($data) : null,
        ];
    }
}
