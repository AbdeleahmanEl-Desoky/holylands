<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\UserLesson;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function index()
    {
        $from = Carbon::now()->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');
        $lessons_total = null;
        $lessons_total_hours = null;
        $lessons_day = null;
        $count_students_coach = null;
        $lessons = [];


        if (auth()->user()->hasRole('Student')) {
            $lessons_total = auth('sanctum')->user()->lessons()->count();
            $lessons_total_hours = auth('sanctum')->user()->lessons->sum('number_hours');
            $lessons = auth('sanctum')
                ->user()
                ->lessons()
                ->with('coach')
                ->whereBetween('date', [$from . " 00:00:00", $to . " 23:59:59"])
                ->limit(2)
                ->orderBy('date', "DESC")
                ->get()
                ->map(function($lessons){
                    $UserLesson = UserLesson::where('lesson_id',$lessons->pivot->lesson_id)->where('user_id',$lessons->pivot->user_id)->where('status',1)->first();
                    
                    if($UserLesson){
                        $lessons->is_attendance = true;
                    }else{
                        $lessons->is_attendance = false;
                    }
                    return $lessons;        
                });
                
        } elseif (auth()->user()->hasRole('Coach')) {

            $users_lesson = UserLesson::query();
            $lessons_coach = Lesson::query();
            $lessons_total = $lessons_coach->where('coach_id', auth('sanctum')->id())->count();
            $count_students_coach = $users_lesson->where('coach_id', auth('sanctum')->id())->count();
            $lessons_total_hours = (int)$lessons_coach->where('coach_id', auth('sanctum')->id())->sum('number_hours');
            $lessons_day = $users_lesson->with('lesson')->where('coach_id', auth('sanctum')->id())
                ->whereHas('lesson', function ($q) {
                    $from = Carbon::now()->format('Y-m-d');
                    $to = Carbon::now()->format('Y-m-d');
                    $q->whereBetween('date', [$from . " 00:00:00", $to . " 23:59:59"]);
                })->count();

            $lessons = auth('sanctum')
                ->user()
                ->coach_users_lessons()
                ->with('coach')
                ->whereBetween('date', [$from . " 00:00:00", $to . " 23:59:59"])
                ->limit(2)
                ->orderBy('date', "DESC")
                ->get();
        }

        $hours = $lessons_total_hours / 60;
        $lessons_total_hours = number_format($hours,2);

        $slider = [[
            'id' => 1,
            'title' => 'تعلم فنون ركوب الخيل',
            'description' => 'من اهم فنون الحياة هو تعلم ركوب الخيل وكيفة التعامل مع الخيل الاصيل'
        ]];

        $lessons_total = isset($lessons_total) ? $lessons_total : 0;
        $lessons_total_hours = isset($lessons_total_hours) ? $lessons_total_hours : 0;
        $lessons_day = isset($lessons_day) ? $lessons_day : 0;
        $count_students_coach = isset($count_students_coach) ? $count_students_coach : 0;


        return response()->json([
            "message" => "success",
            "status" => true,
            "data" => [
                'slider' => $slider,
                'lessons_total' => $lessons_total,
                'lessons_total_hours' => (int)$lessons_total_hours,
                'lessons_day' => $lessons_day,
                'count_students_coach' =>  $count_students_coach,
                'lessons' => $lessons,
            ]
        ]);
    }

    public function CheckVersion()
    {

        $version = [[
            'version' => '1.0.1',
            'update_today' => '26-02-2023',
            'update_last' => '24-02-2023',
        ]];

        return response()->json([
            "message" => "success",
            "status" => true,
            "data" => $version
        ]);

    }

    public function updateToken()
    {
        auth('sanctum')->user()->update(['fcm_token' => request('token')]);
        return auth('sanctum')->user();
    }

}
