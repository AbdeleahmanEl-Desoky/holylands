<?php
namespace App\Services\FCM;

use App\Models\Device;
use App\Models\User;

class FCMService {

    public function sendNotification($FcmToken ,$title,$body ) {

            $url = 'https://fcm.googleapis.com/fcm/send';

            $serverKey ='AAAAqpz14ks:APA91bGu_OyAI73DVFg26b89fmt3J00GK6cwWNwx5FvAthADzv6MonXYrhwf2JTvEkvxUhSS3BX3-fuFToy5C89lhxftQcyYeqqlXpJFL-g_mbJdt3HxhTdZNwH2aZLku0prkZBAKTmZ';

            $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
               "title" => $title,
               "body" => $body,
            ]
            ];
            $encodedData = json_encode($data);

            $headers = [
               'Authorization:key=' . $serverKey,
               'Content-Type: application/json',
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
            }
            // Close connection
            curl_close($ch);
            // FCM response
            return;




    }
}


