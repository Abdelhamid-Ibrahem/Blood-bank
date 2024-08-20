<?php

namespace App\Notifications;

class TestNotification extends NotificationChannel
{
    public function __construct(
    ) {
    }

    public function getData(): array
    {
        return [];
    }

    public function getCode(): string
    {
        return 'test_notification';
    }

    public function getTitle(): string
    {
        return 'Test Notification Title';
    }

    public function getBody(): string
    {
        return 'Test Notification Body';
    }



}
