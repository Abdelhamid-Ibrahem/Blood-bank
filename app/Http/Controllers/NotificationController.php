<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\FirebaseNotification;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function sendFirebaseNotification(Request $request)
    {
        $tokens = [ 'device_token_1','device_token_2'];
        $title = 'abdelhamid ';
        $body = 'abdelhamid';

        Notification::route('firebase', 'Firebase')
            ->notify(new FirebaseNotification($title, $body, $tokens));

        return response()->json(['message' => 'Notification sent successfully!']);

    }
}
