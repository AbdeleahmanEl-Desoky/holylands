<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use App\Models\Lesson;
use App\Models\UserHorse;
use App\Models\UserLesson;
use DateTime;
use Carbon\Carbon;

use Illuminate\Http\Request;

class HorsesController extends Controller
{

public function index(Request $request)
{

$lessonBookNow = Lesson::query()
    ->where('id', $request->lesson_id)
    ->first();

if (!$lessonBookNow) {
    // Handle case where lesson is not found
}

$lessonDate = Carbon::parse($lessonBookNow->date);
$modifiedDate = $lessonDate->copy()->addMinutes($lessonBookNow->number_hours);
$modifiedDateTo = $lessonDate->copy()->addMinutes(- $lessonBookNow->number_hours);

// Fetch lessons that fall within the given date range
 $lessons = Lesson::query()
    ->whereBetween('date', [$lessonDate, $modifiedDate])
    ->orWhereBetween('date',[$modifiedDateTo , $lessonDate ])
    ->pluck('id') ;





// Fetch horses that are already assigned to lessons within the date range
$assignedHorseIds = UserHorse::query()
    ->whereIn('lesson_id', $lessons)
    ->pluck('horse_id');

// Fetch horses that are not assigned to lessons within the date range
$horses = Horse::query()
    ->where('status', 1)
    ->whereNotIn('id', $assignedHorseIds)
    ->get();


    return response()->json([
        'status' => true,
        'message' => "success",
        'data' => $horses
    ]);
}


    public function show($horse_id)
    {
        if (auth()->user()->hasRole('Coach')) {

            $horse = UserHorse::where(['status' => 1, 'horse_id' => $horse_id])->first();

            // if ($horse) {

            //     return response()->json(['message' => 'الحصان محجوز', 'status' => false, 'data' => null]);

            // } else {

                $user_lesson = UserLesson::query()
                    ->where(['user_id' => request('user_id'), 'coach_id' => auth('sanctum')->id(), 'lesson_id' => request('lesson_id'), 'status' => 0])
                    ->first();

                if ($user_lesson) {

                    $user_horse_exists = UserHorse::where([
                        'user_id' => request('user_id'),
                        'lesson_id' => request('lesson_id'),
                        'coach_id' => auth('sanctum')->id(),
                    ])->first();

                    if ($user_horse_exists) {
                        $user_horse_exists->horse_id = $horse_id;
                        $user_horse_exists->save();

                        $user_lesson->horse_id = $horse_id;
                        $user_lesson->save();

                        return response()->json(['status' => true, 'message' => "تم الحجز بنجاح", 'data' => $user_horse_exists]);

                    } else {

                        $user_horse = UserHorse::create([
                            'user_id' => request('user_id'),
                            'horse_id' => $horse_id,
                            'lesson_id' => request('lesson_id'),
                            'coach_id' => auth('sanctum')->id(),
                        ]);

                        $user_lesson->horse_id = $horse_id;
                        $user_lesson->save();

                        return response()->json(['status' => true, 'message' => "تم الحجز بنجاح", 'data' => $user_horse]);
                    }


                } else {

                    return response()->json(['message' => 'الطالب غير مسجل في الدرس', 'status' => false, 'data' => null]);

                }

            // }
        } else {

            return response()->json(['message' => 'عذرا , انت لست مدرب', 'status' => false, 'data' => null]);

        }

    }


    public function horses_end($lesson_id)
    {

        if (auth()->user()->hasRole('Coach')) {

            $lesson = Lesson::where(['id' => $lesson_id, 'coach_id' => auth('sanctum')->id()])->first();

            if (!$lesson) {
                return response()->json(['message' => 'عذرا , الدرس غير موجود حاليا', 'status' => false, 'data' => null]);
            }

           $user_lessons = UserLesson::query()->whereNotNull('horse_id')->where(['lesson_id' => $lesson_id, 'coach_id' => auth('sanctum')->id()])->get();


            foreach ($user_lessons as $user_lesson) {
            $user_lesson->update([
                'end' => 1,
            ]);

                UserHorse::query()->where(['lesson_id' => $user_lesson->lesson_id, 'coach_id' => $user_lesson->coach_id])->delete();
            }

        } else {

            return response()->json(['message' => 'عذرا , انت لست مدرب', 'status' => false, 'data' => null]);

        }

        return response()->json([
            'status' => true,
            'message' => "تم انهاء الحصة بنجاح ",
            'data' => null
        ]);
    }


}
