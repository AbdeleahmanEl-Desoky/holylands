<?php

namespace App\Http\Livewire\Admin\Lessons;

use App\Models\Lesson;
use App\Models\Level;
use App\Models\User;
use App\Models\UserLesson;
use App\Models\Notification;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\FCM\FCMService;

class LessonsCreate extends Component
{
    use WithFileUploads;

    public $lesson = ['repetition' => null, 'time' => null], $levels, $coaches, $image, $imageTemp, $lesson_times = [['date' => null,]];

    public function AddLessonTime()
    {
        $this->lesson_times[] = ['date' => null,];
    }

    public function RemoveLessonTime($key)
    {
        unset($this->lesson_times[$key]);
    }

    public function mount()
    {
        $this->coaches = User::role('Coach')->where('status', 1)->get();
        $this->levels = Level::get();
    }

    public function store()
    {
        $this->validate([
            'lesson.name' => 'required|string|max:255',
            'lesson.description' => 'required|string',
            'lesson.date' => 'required|date',
            'lesson.level_id' => 'required|exists:levels,id',
            'lesson.coach_id' => 'required|exists:users,id',
            'lesson.number_hours' => 'required|numeric',
            'lesson.number_students' => 'required|numeric',
            'lesson.repetition' => 'nullable|boolean',
            'lesson.time' => 'nullable|boolean',
            'lesson.location' => 'required|string|max:1000',
        ]);


            
            
            
            
            
            
            $coach = User::where('id',$this->lesson['coach_id'])->first();
            
            $title = 'تم انشاء درس جديد';
            $body = $title . ' '.'للمدرب' . $coach->name;
            $users = User::where('coach_id',$this->lesson['coach_id'])->where('level_id',$this->lesson['level_id'])->get();
            foreach($users as $user){
                $lessonCount = UserLesson::where('user_id', $user->id)->where('status', 1)->count();
                
                if( $user->lesson_count >= $lessonCount ){
                    $fcm = new FCMService();
                    $fcm->sendNotification([$user->fcm_token],$title,$body);
                    
                }                        
                
            }
            
            
          //  $FcmTokens = User::where('coach_id',$this->lesson['coach_id'])->orWhere('id',$this->lesson['coach_id'])->pluck('fcm_token');
            


            // $user_FcmTokens = User::where('coach_id',$this->lesson['coach_id'])->orWhere('id',$this->lesson['coach_id'])->get();
            
            // foreach($user_FcmTokens as $user_FcmToken)
            // {
            //     Notification::create([
            //         'title' => $title,
            //         'description' => $body,
            //         'user_id' => $user_FcmToken->id,
            //     ]);
            // }

        if ($this->lesson['repetition']) {
            $this->validate(['lesson.repetition_number' => 'required|numeric']);
        }

        if ($this->lesson['time']) {
            $this->validate(['lesson_times.*.date' => 'required|date']);
        }

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg|max:2048']);
            $this->lesson['image'] = $this->imageTemp->store('lessons/' . $this->id);
        } else {
            unset($this->lesson['image']);
        }


        $lesson = Lesson::create($this->lesson);

        if ($lesson->repetition and $lesson->repetition_number > 0) {
            for ($i = 1; $i <= $lesson->repetition_number; $i++) {
                $this->lesson['date'] = Carbon::parse($this->lesson['date'])->addWeeks(1);
                Lesson::create($this->lesson);
            }
        }


        if ($lesson->time and count($this->lesson_times) > 0) {
            foreach ($this->lesson_times as $key => $lesson_time) {
                $this->lesson['date'] = $lesson_time['date'];
                Lesson::create($this->lesson);
            }
        }

        $this->emit('success', __("Added successfully"));
        $this->lesson = ['repetition' => null, 'time' => null];

    }

    public function render()
    {
        return view('livewire.admin.lessons.lessons-create')->layout('layouts.admins.app');
    }

}
