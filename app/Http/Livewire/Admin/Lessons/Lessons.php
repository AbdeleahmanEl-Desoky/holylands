<?php

namespace App\Http\Livewire\Admin\Lessons;

use App\Models\Lesson;
use App\Models\Level;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Lessons extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];


    public $search, $name, $deleteId, $lesson_id, $create_lesson, $image, $imageTemp, $coaches, $coach_id, $levels, $level_id ,$date ,$date_status;

    public function search()
    {

    }

    function mount()
    {
        $this->coaches = User::role('Coach')->get();
        $this->levels = Level::get();
    }


    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditLesson($id)
    {
        $this->lesson_id = $id;
    }

    public function CreateLesson()
    {
        $this->create_lesson = rand(0, 10000);
    }

    public function refreshModal()
    {
        $this->lesson_id = "";
        $this->create_lesson = "";
    }

    public function delete()
    {

        $lessons = Lesson::findOrFail($this->deleteId);

        if (!auth()->user()->can('lessons delete')) {
            $this->emit('error', 'Lesson does not have the right permissions.');
            return false;
        }

        $lessons->delete();
        $this->emit('success', __("Deleted successfully"));

    }

    public function render()
    {
        $lessons = Lesson::query();

        if ($this->name) {
            $lessons = $lessons->where('name', 'LIKE', '%' . $this->name . '%');
        }

        if ($this->coach_id) {
            $lessons = $lessons->where('coach_id', $this->coach_id);
        }

        if ($this->level_id) {
            $lessons = $lessons->where('level_id', $this->level_id);
        }

        if ($this->date) {
            $lessons = $lessons->where('date', $this->date);
        }

        if ($this->date_status == 1) {
            $lessons = $lessons->where('date', '>=' , Carbon::now());
        }

        if ($this->date_status == 2) {
            $lessons = $lessons->where('date', '<' , Carbon::now());
        }

        $lessons = $lessons->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.lessons.lessons', compact('lessons'))->layout('layouts.admins.app');
    }
}
