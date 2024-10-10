<?php

namespace App\Http\Livewire\Admin\Students;

use App\Models\Level;
use App\Models\User;
use App\Models\UserLesson;
use Livewire\Component;
use Livewire\WithPagination;

class Students extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $name, $email, $mobile, $deleteId, $student_id, $role_id, $role, $create_student, $array,$levels, $level_id ,$username;

    public function mount()
    {
        $this->levels = Level::get();
    }

    public function search()
    {
        $this->resetPage();
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditStudent($id)
    {
        $this->student_id = $id;
    }

    public function HistoryStudent($id)
    {
        $this->student_id = $id;
    }

    public function CreateStudent()
    {
        $this->create_student = rand(0, 10000);
    }

    public function refreshModal()
    {
        $this->student_id = "";
        $this->create_student = "";
    }

    public function delete()
    {

        $students = User::role('Student')->findOrFail($this->deleteId);

        if (!auth()->user()->can('students delete')) {
            $this->emit('error', 'students does not have the right permissions.');
            return false;
        }

        $students->delete();
        $this->emit('success', __("Deleted successfully"));

    }

    public function render()
    {
        $students = User::query();
        $students = $students->role('Student');

        if ($this->name) {
            $students = $students->where('name', 'LIKE', '%' . $this->name . '%');
        }
        if ($this->username) {
            $students = $students->where('username', 'LIKE', '%' . $this->username . '%');
        }
        if ($this->email) {
            $students = $students->where('email', 'LIKE', '%' . $this->email . '%');
        }
        if ($this->mobile) {
            $students = $students->where('mobile', 'LIKE', '%' . $this->mobile . '%');
        }
        if ($this->level_id) {
            $students = $students->where('level_id', $this->level_id);
        }

        $students = $students->orderBy('created_at', "DESC")->paginate(10);
     
     
        $students->getCollection()->transform(function ($user) {
            $userLesson = UserLesson::where('user_id', $user->id)->count();
            $user->lesson_motabaky = $user->lesson_count -  $userLesson;

            return $user;
        });
     
     
        return view('livewire.admin.students.students', compact('students'))->layout('layouts.admins.app');
    }

}
