<?php

namespace App\Http\Livewire\Admin\Students;

use App\Models\Level;
use App\Models\User;
use App\Models\HistoryUser;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudentsHistory extends Component
{
    use WithFileUploads;

    protected $userData; // Define a protected property

    public $user = [];

    public function mount($id)
    {
        $this->userData = HistoryUser::with('user')->where('student_id', $id)->orderByDesc('id')->get(); // Assign to $userData
    }

    public function render()
    {
        return view('livewire.admin.students.students-history', [
            'users' => $this->userData, // Pass $userData to the view as 'users'
        ])->layout('layouts.admins.app');
    }
}
