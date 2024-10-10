<?php

namespace App\Http\Livewire\Admin\Lessons;

use App\Models\Lesson;
use App\Models\Level;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class LessonsEdit extends Component
{
    use WithFileUploads;
    public $lesson ,$levels ,$coaches ,$image, $imageTemp;

    function mount($id)
    {
        $lesson = Lesson::findOrFail($id);
        $this->lesson = $lesson->toArray();

        $this->coaches = User::role('Coach')->where('status',1)->get();
        $this->levels = Level::get();
    }

    public function update()
    {
        $this->validate([
            'lesson.name' => 'required|string|max:255',
            'lesson.description' => 'required|string',
            'lesson.date' => 'required|date',
            'lesson.level_id' => 'required|exists:levels,id',
            'lesson.coach_id' => 'required|exists:users,id',
            'lesson.number_hours' => 'required|numeric',
            'lesson.number_students' => 'required|numeric',
            'lesson.location' => 'required|string|max:1000',
        ]);

        $lesson = Lesson::findOrFail($this->lesson['id']);

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg|max:2048']);
            $this->lesson['image'] = $this->imageTemp->store('lessons/' . $this->id);
        } else {
            unset($this->lesson['image']);
        }

        $lesson->update($this->lesson);
        $this->emit('success', __("Updated successfully"));
    }

    public function render()
    {
        return view('livewire.admin.lessons.lessons-edit')->layout('layouts.admins.app');
    }

}
