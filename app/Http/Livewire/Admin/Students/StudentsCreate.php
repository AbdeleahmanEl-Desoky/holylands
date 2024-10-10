<?php

namespace App\Http\Livewire\Admin\Students;

use App\Models\Level;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudentsCreate extends Component
{
    use WithFileUploads;

    public $user = ['email' => null, 'username' => null, 'mobile' => null], $image, $imageTemp, $roles = [] ,$levels ,$coaches;

    function mount()
    {
        $this->levels = Level::get();
        $this->coaches = User::Role('Coach')->get();

    }

    public function store()
    {
        $this->validate([
            'user.name' => 'required|string',
            'user.status' => 'required|in:0,1,2',
            'user.birth_date' => 'required|date',
            'user.place_of_birth' => 'required|string|max:255',
            'user.nationality' => 'required|string|max:255',
            'user.job' => 'nullable|string|max:255',
            'user.affiliation_date' => 'required|date',
            'user.address' => 'required|string|max:255',
            'user.blood_type' => 'nullable|string|max:255',
            'user.url_facebook' => 'nullable|string',
            'user.lesson_count' => 'required|numeric',
            'user.level_id' => 'required|exists:levels,id',
            'user.coach_id' => 'required|exists:users,id',
            'user.password' => 'required|min:6',
        ]);

        if ($this->user['email']) {
            $this->validate(['user.email' => 'required|email|unique:users,email',]);
        }

        if ($this->user['username']) {
            $this->validate(['user.username' => 'required|string|alpha_dash|max:255|unique:users,username',]);
        }

        if ($this->user['mobile']) {
            $this->validate(['user.mobile' => 'required|numeric|unique:users,mobile',]);
        }

        if (!$this->user['email'] and !$this->user['username'] and !$this->user['mobile']) {
            $this->validate(['user.email' => 'required_without:username,mobile|email|unique:users,email',]);
        }

        $this->user['user_id'] = auth()->id();

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg|max:2048']);
            $this->user['image'] = $this->imageTemp->store('users/' . $this->id);
        } else {
            unset($this->user['image']);
        }

        $this->user['password'] = bcrypt($this->user['password']);

        $user = User::create($this->user);
        $user->assignRole('Student');

        $this->emit('success', __("Added successfully"));
        $this->user = ['email' => null, 'username' => null, 'mobile' => null];
    }

    public function render()
    {
        return view('livewire.admin.students.students-create')->layout('layouts.admins.app');
    }

}
