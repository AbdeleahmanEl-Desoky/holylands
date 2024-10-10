<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\UserLesson;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Services\FCM\FCMService;


class LessonsController extends Controller
{


    public function index()
    {
        $lessons = Lesson::query();
        $lessons = $lessons->with(['level', 'coach'])->where('status', '1');

        if (auth()->user()->hasRole('Coach')) {
            $lessons = $lessons->where('coach_id', auth('sanctum')->id());
        } else {
            
            $lessons_count = UserLesson::where('user_id',auth('sanctum')->user()->id)->where('status',1)->count();
            $user = User::where('id',auth('sanctum')->user()->id)->first();
            
            if($user->lesson_count > $lessons_count){
            
                $lessons = $lessons->where(['level_id' => auth('sanctum')->user()->level_id, 'coach_id' => auth('sanctum')->user()->coach_id]);
            }else{
                
                $lessons = $lessons->where('level_id','not found');
            }
        }

        $lessons = $lessons->where('date', '>=', Carbon::now());

        $validator = Validator::make(request()->input(), [
            'name' => 'nullable|string|max:255',
            'level_id' => 'nullable|numeric|exists:levels,id',
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }

        if (request('name')) {
            $lessons = $lessons->where('name', 'LIKE', '%' . request('name') . '%');
        }

        if (request('level_id')) {
            $lessons = $lessons->where('level_id', request('level_id'));
        }

        $lessons = $lessons->orderBy('created_at', "DESC")->paginate(10)

                ->map(function($lessons){
                    if(auth()->user()->hasRole('Student')){
                        $UserLesson = UserLesson::where('lesson_id',$lessons->id)->where('user_id',auth('sanctum')->user()->id)->where('status',1)->first();
                        
                        if($UserLesson){
                            $lessons->is_attendance = true;
                        }else{
                            $lessons->is_attendance = false;
                        }
                    }
                    return $lessons;        
                });


        $levels = [
            ['id' => 1, 'name' => 'مبتدئ'],
            ['id' => 2, 'name' => 'متوسط'],
            ['id' => 3, 'name' => 'متقدم'],
            ['id' => 4, 'name' => 'خبير'],
        ];

        return response()->json([
            'status' => true,
            'message' => "success",
            'data' => [
                'lessons' => $lessons,
                'levels' => $levels,
            ]
        ]);
    }

    public function show($lesson_id)
    {
        if (auth()->user()->hasRole('Student')) {
            $lesson = Lesson::with('level', 'coach')->where(['id' => $lesson_id, 'status' => 1, 'coach_id' => auth('sanctum')->user()->coach_id])->get()
                       ->map(function($lesson){
                    if(auth()->user()->hasRole('Student')){
                        $UserLesson = UserLesson::where('lesson_id',$lesson->id)->where('user_id',auth('sanctum')->user()->id)->where('status',1)->first();
                        
                        if($UserLesson){
                            $lesson->is_attendance = true;
                        }else{
                            $lesson->is_attendance = false;
                        }
                    }
                    return $lesson;        
                });
                
            $lesson = $lesson->first();
        } else {
            $lesson = Lesson::with('level', 'coach')->where(['id' => $lesson_id, 'status' => 1, 'coach_id' => auth('sanctum')->id()])->first();

        }
        if (!$lesson) {
            return response()->json(['message' => 'Not found ', 'status' => false, 'data' => null]);
        }

        return response()->json([
            'status' => true,
            'message' => "success",
            'data' => $lesson
        ]);
    }

    public function lesson_day()
    {
        $from = \Carbon\Carbon::now()->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');
        $lessons = [];
        $levels = [
            ['id' => 1, 'name' => 'مبتدئ'],
            ['id' => 2, 'name' => 'متوسط'],
            ['id' => 3, 'name' => 'متقدم'],
            ['id' => 4, 'name' => 'خبير'],
        ];

        if (auth()->user()->hasRole('Student')) {
            $lessons = auth('sanctum')
                ->user()
                //->lessons()
                ->with('coach', 'level')
                ->whereBetween('date', [$from . " 00:00:00", $to . " 23:59:59"])
                ->orderBy('date', "DESC")
                ->get();
        } elseif (auth()->user()->hasRole('Coach')) {
            $lessons = auth('sanctum')
                ->user()
                ->coach_users_lessons()
                ->with('coach')
                ->whereBetween('date', [$from . " 00:00:00", $to . " 23:59:59"])
                ->limit(2)
                ->orderBy('date', "DESC")
                ->get();
        }

        return response()->json([
            'status' => true,
            'message' => "success",
            'data' => [
                'lessons' => $lessons,
                'levels' => $levels,
            ]
        ]);
    }

    public function booking($lesson_id)
    {
        $lesson = Lesson::where(['id' => $lesson_id, 'coach_id' => auth('sanctum')->user()->coach_id])->first();

        if (!$lesson) {
            return response()->json(['message' => 'عذرا , الدرس غير موجود حاليا', 'status' => false, 'data' => null]);
        }

        if (!in_array($lesson->id, auth('sanctum')->user()->lessons()->pluck('lesson_id')->toArray())) {

            $users_lesson_count = UserLesson::query()->whereIn('lesson_id', [$lesson_id])->count();
            $user_lesson_count = auth('sanctum')->user()->lesson_count;
            $all_lessons_user = auth('sanctum')->user()->lessons()->pluck('lesson_id')->toArray();

            if ($users_lesson_count >= $lesson->number_students) {
                return response()->json(['message' => 'عذرا , عدد الطلاب مكتمل', 'status' => false, 'data' => null]);
            }

            if (count($all_lessons_user) >= $user_lesson_count) {
                return response()->json(['message' => 'عذرا , لقد تجاوزت العدد المسموح من الحصص ', 'status' => false, 'data' => null]);
            }

            
            $users = User::where('id',auth('sanctum')->id())->first();
            $FcmTokens = User::where('id',auth('sanctum')->user()->coach_id)->pluck('fcm_token');
            $title = 'تم حجز درس جديد من';
            $body = $title . ' '.'الطالب' .' '. $users->name;


            $fcm = new FCMService();
            $fcm->sendNotification($FcmTokens,$title,$body);

            Notification::create([
                'title' => $title,
                'description' => $body,
                'user_id' => auth('sanctum')->user()->coach_id,
            ]);

            $booking = UserLesson::create([
                'lesson_id' => $lesson->id,
                'level_id' => $lesson->level_id,
                'user_id' => auth('sanctum')->id(),
                'coach_id' => $lesson->coach_id,
                'number_hours' => $lesson->number_hours,
                'time_end' => Carbon::now()->addHours(3)->toDateTimeString(),
            ]);
        } else {
            return response()->json(['message' => 'عذرا , لقد حجزت الدرس من قبل', 'status' => false, 'data' => null]);
        }

        return response()->json([
            'status' => true,
            'message' => "success",
            'data' => $booking
        ]);
    }

    public function booking_cancel($lesson_id)
    {
        $lesson = Lesson::where(['id' => $lesson_id, 'coach_id' => auth('sanctum')->user()->coach_id])->first();

        if (!$lesson) {
            return response()->json(['message' => 'عذرا , الدرس غير موجود حاليا', 'status' => false, 'data' => null]);
        }

        $users_lesson = UserLesson::query()->where(['user_id' => auth('sanctum')->id(), 'lesson_id' => $lesson_id])->first();

        if ($users_lesson->time_end <= Carbon::now()) {
            return response()->json(['status' => false, 'message' => "عذرا , لا يمكن الغاء الحجز بعد 180 دقيقة من حجزها", 'data' => null]);
        }

        if (in_array($lesson->id, auth('sanctum')->user()->lessons()->pluck('lesson_id')->toArray())) {
            $booking = UserLesson::where(['user_id' => auth('sanctum')->id(), 'lesson_id' => $lesson_id,])->first();
            $booking->delete();
            
            
                        
            $users = User::where('id',auth('sanctum')->id())->first();
            $FcmTokens = User::where('id',auth('sanctum')->user()->coach_id)->pluck('fcm_token');
            $title = 'تم الغاء حجز درس من';
            $body = $title . ' '.'الطالب' .' '. $users->name;


            $fcm = new FCMService();
            $fcm->sendNotification($FcmTokens,$title,$body);

            Notification::create([
                'title' => $title,
                'description' => $body,
                'user_id' => auth('sanctum')->user()->coach_id,
            ]);

            
            
            
            
            
            
            
        } else {
            return response()->json(['message' => 'عذرا , أنت غير مسجل في الدرس ', 'status' => false, 'data' => null]);
        }

        return response()->json([
            'status' => true,
            'message' => "success",
            'data' => null
        ]);
    }


}
