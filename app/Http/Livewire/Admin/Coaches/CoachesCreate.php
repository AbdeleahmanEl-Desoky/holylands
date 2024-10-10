<?php

namespace App\Http\Livewire\Admin\Coaches;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class CoachesCreate extends Component
{
    use WithFileUploads;

    public $user = ['email' => null, 'username' => null, 'mobile' => null], $image, $imageTemp, $roles = [];

    function mount()
    {

    }

    public function store()
    {
        $this->validate([
            'user.name' => 'required|string',
            'user.status' => 'required|in:0,1,2',
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
        $user->assignRole('Coach');

        $this->emit('success', __("Added successfully"));
        $this->user = ['email' => null, 'username' => null, 'mobile' => null];

    }

    public function render()
    {
        return view('livewire.admin.coaches.coaches-create')->layout('layouts.admins.app');
    }

}
