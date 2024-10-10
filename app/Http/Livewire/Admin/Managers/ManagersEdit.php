<?php

namespace App\Http\Livewire\Admin\Managers;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManagersEdit extends Component
{
    use WithFileUploads;

    public $user, $roles = [], $image, $imageTemp;

    function mount($id)
    {
        $user = User::role('Admin')->findOrFail($id);
        $this->user = $user->toArray();
    }

    public function update()
    {

        $this->validate([
            'user.name' => 'required|string',
            'user.status' => 'required|in:0,1,2',
        ]);

        if ($this->user['email']) {
            $this->validate(['user.email' => 'required|email|unique:users,email,' . $this->user['id']]);
        }

        if ($this->user['username']) {
            $this->validate(['user.username' => 'required|string|alpha_dash|max:255|unique:users,username,' . $this->user['id']]);
        }

        if ($this->user['mobile']) {
            $this->validate(['user.mobile' => 'required|numeric|unique:users,mobile,'. $this->user['id']]);
        }

        if (!$this->user['email'] and !$this->user['username'] and !$this->user['mobile']) {
            $this->validate(['user.email' => 'required_without:username,mobile|email|unique:users,email,' . $this->user['id']]);
        }

        $user = User::role('Admin')->findOrFail($this->user['id']);

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
            $this->user['image'] = $this->imageTemp->store('users/' . $this->id);
        } else {
            unset($this->user['image']);
        }

        if (!empty($this->user['password']) and $this->user['password'] != "") {
            $this->validate([
                'user.password' => 'required|min:6',
            ]);
            $user->password = bcrypt($this->user['password']);
            $user->save();
            unset($this->user['password']);
        } else {
            unset($this->user['password']);
        }

        $user->assignRole('Admin');

        $user->update($this->user);
        $this->emit('success', __("Updated successfully"));

    }

    public function render()
    {
        return view('livewire.admin.managers.managers-edit')->layout('layouts.admins.app');
    }

}
