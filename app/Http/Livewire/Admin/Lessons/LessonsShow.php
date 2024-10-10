<?php

namespace App\Http\Livewire\Admin\Lessons;

use App\Models\Lesson;
use App\Models\UserLesson;
use Livewire\Component;

class LessonsShow extends Component
{
    public $lesson ,$user_lessons;

    function mount($id)
    {
        $this->lesson = Lesson::findOrFail($id);

        $this->user_lessons = UserLesson::query()->where('lesson_id',$id)->get();

    }

    public function render()
    {
        return view('livewire.admin.lessons.lessons-show')->layout('layouts.admins.app');
    }

}
