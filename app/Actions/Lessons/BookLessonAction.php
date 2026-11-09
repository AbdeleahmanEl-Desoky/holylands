<?php

namespace App\Actions\Lessons;

use App\DTOs\Lessons\BookLessonDto;
use App\Models\Lesson;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserLesson;
use App\Services\FCM\FCMService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class BookLessonAction
{
    public function __construct(private FCMService $fcm)
    {
    }

    public function execute(BookLessonDto $data): array
    {
        return DB::transaction(function () use ($data) {
            // Serialize bookings for the student's balance, then the lesson's capacity.
            $user = User::whereKey($data->userId)->lockForUpdate()->first();
            if (!$user || !$user->hasRole('Student')) {
                return $this->failure('عذرا , الحجز متاح للطلاب فقط');
            }

            $lesson = Lesson::whereKey($data->lessonId)->lockForUpdate()->first();
            if (!$lesson || $lesson->coach_id != $user->coach_id) {
                return $this->failure('عذرا , الدرس غير موجود حاليا');
            }

            if (UserLesson::where('user_id', $user->id)->where('lesson_id', $lesson->id)->lockForUpdate()->first()) {
                return $this->failure('عذرا , لايمكن حجز الدرس مرتين');
            }

            if (UserLesson::where('user_id', $user->id)->lockForUpdate()->get(['id'])->count() >= $user->lesson_count) {
                return $this->failure('عذرا , لايمكن حجز دروس لعدم تواجد رصيد دروس لك من فضلك تابع مع الادارة');
            }

            if (UserLesson::where('lesson_id', $lesson->id)->lockForUpdate()->get(['id'])->count() >= $lesson->number_students) {
                return $this->failure('عذرا , عدد الطلاب مكتمل');
            }

            $booking = UserLesson::create([
                'user_id' => $user->id,
                'lesson_id' => $lesson->id,
                'level_id' => $lesson->level_id,
                'coach_id' => $lesson->coach_id,
                'number_hours' => $lesson->number_hours,
                'time_end' => now()->addHours(3)->toDateTimeString(),
            ]);

            $title = 'تم حجز درس جديد من';
            $body = $title . ' ' . 'الطالب' . ' ' . $user->name;
            Notification::create([
                'title' => $title,
                'description' => $body,
                'user_id' => $lesson->coach_id,
            ]);

            DB::afterCommit(function () use ($lesson, $title, $body) {
                try {
                    $tokens = User::whereKey($lesson->coach_id)->whereNotNull('fcm_token')->pluck('fcm_token');
                    if ($tokens->isNotEmpty()) {
                        $this->fcm->sendNotification($tokens, $title, $body);
                    }
                } catch (Throwable $exception) {
                    Log::warning('Booking saved, but its push notification failed.', ['lesson_id' => $lesson->id]);
                }
            });

            return ['status' => true, 'message' => 'success', 'data' => $booking];
        }, 3);
    }

    private function failure(string $message): array
    {
        return ['status' => false, 'message' => __($message), 'data' => null];
    }
}
