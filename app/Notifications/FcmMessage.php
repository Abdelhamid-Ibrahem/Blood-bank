<?php

namespace App\Notifications;

class FcmMessage
{
    private $notification;
    private $data;

    public function __construct(FcmNotification $notification, array $data = [])
    {
        $this->notification = $notification;
        $this->data = $data;
    }

    public function getNotification()
    {
        return [
            'title' => $this->notification->getTitle(),
            'body' => $this->notification->getBody(),
        ];
    }

    public function getFcmData()
    {
        return $this->data;
    }

    public function toArray()
    {
        return [
            'notification' => $this->getNotification(),
            'data' => $this->getFcmData(),
        ];
    }
}
