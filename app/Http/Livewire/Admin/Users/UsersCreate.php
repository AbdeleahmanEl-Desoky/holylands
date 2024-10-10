<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class UsersCreate extends Component
{
    use WithFileUploads;


    public $user, $image, $imageTemp, $roles = [];

    function mount()
    {
        $this->roles = Role::get();

    }

    public function store()
    {
        $this->validate([
            'user.name' => 'required|string',
            'user.email' => 'required|email|unique:users,email',
            'user.mobile' => 'required|numeric',
            'user.status' => 'required|in:0,1,2',
            'user.role_id' => 'required|exists:roles,id',
        ]);

        $this->user['user_id'] = auth()->id();

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg|max:2048']);
            $this->user['image'] = $this->imageTemp->store('users/' . $this->id);
        } else {
            unset($this->user['image']);
        }

        $user = User::create($this->user);
        $user->syncRoles($this->user['role_id']);

        $this->emit('success', __("Added successfully"));
        $this->user = [];


    }


    public function render()
    {
        return view('livewire.admin.users.users-create')->layout('layouts.admins.app');
    }
}
