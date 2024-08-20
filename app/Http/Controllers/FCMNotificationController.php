<?php

namespace App\Http\Controllers;

use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Http;

class FCMNotificationController extends Controller
{
    public function sendNotification($deviceToken, $title, $body)
    {
        $credentialsPath = storage_path('\app\blood-bank-f2076-e71538fc47d4.json');
        $projectId = 'blood-bank-f2076';


        $accessToken = $this->getAccessToken($credentialsPath);


        $message = [
            'message' => [
                'token' =>$deviceToken,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
                'data' => [
                    'customKey1' => 'customValue1',
                    'customKey2' => 'customValue2',
                ],
            ],
        ];


        $response = Http::withToken($accessToken)
            ->post("https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send", $message);


        if ($response->successful()) {
            return response()->json(['status' => 'success', 'message' => 'Notification sent successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => $response->body()]);
        }
    }


    private function getAccessToken($credentialsPath)
    {
        $client = new GoogleClient();
        $client->setAuthConfig($credentialsPath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->useApplicationDefaultCredentials();

        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithAssertion();
        }

        return $client->getAccessToken()['access_token'];
        }
}
