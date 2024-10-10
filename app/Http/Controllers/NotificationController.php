<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Carbon;
use App\Services\FCM\FCMService;


class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', auth('sanctum')->id())->orderBy('created_at', 'DESC')->paginate(10);


        return response()->json([
            'status' => true,
            'message' => "success",
            'data' => $notifications
        ]);

    }
}
