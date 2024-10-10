<?php

namespace App\Http\Controllers;

use App\Models\UserLesson;


class AttendanceController extends Controller
{

    public function show()
    {
        $lesson_id = request('lesson_id');

        $users_lesson = UserLesson::with(['user.level','horse'])
            ->where(['coach_id' => auth('sanctum')->id(), 'lesson_id' => $lesson_id])
            ->get();

        return response()->json([
            'status' => true,
            'message' => "success",
            'data' => $users_lesson
        ]);
    }

    public function attendance_confirmation($lesson_id)
    {
        $users = request('users');


        foreach ($users as $user_id => $user) {

            UserLesson::where(['user_id' => $user_id, 'lesson_id' => $lesson_id])
                ->update([
                    'status' => $user['status'],
                    'horse_id' => $user['horse_id'],
                ]);
        }

        return response()->json([
            'status' => true,
            'message' => "تم تأكيد الحضور",
            'data' => null
        ]);
    }

}
