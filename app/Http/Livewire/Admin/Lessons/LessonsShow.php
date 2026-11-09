<?php

namespace App\Http\Livewire\Admin\Lessons;

use App\Models\Lesson;
use App\Models\UserLesson;
use Livewire\Component;

class LessonsShow extends Component
{
    public $lesson, $user_lessons;

    public function mount($id)
    {
        $this->lesson = Lesson::findOrFail($id);
        $this->user_lessons = UserLesson::where('lesson_id', $id)->get();
    }

    public function render()
    {
        return view('livewire.admin.lessons.lessons-show')->layout('layouts.admins.app');
    }

    public function deleteStudent($id)
    {
        $userLesson = UserLesson::find($id);

        if ($userLesson && $userLesson->lesson_id == $this->lesson->id) {
            $userLesson->delete();
            $this->user_lessons = UserLesson::where('lesson_id', $this->lesson->id)->get();
            session()->flash('success', 'تم حذف الطالب من الدرس بنجاح.');
        } else {
            session()->flash('error', 'فشل الحذف. الطالب غير موجود.');
        }
    }
}
