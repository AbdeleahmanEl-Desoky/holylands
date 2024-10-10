<?php

namespace App\Http\Livewire\Admin\Students;

use App\Models\HistoryUser;
use App\Models\Level;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudentsEdit extends Component
{
    use WithFileUploads;

    public $user, $roles = [], $image, $imageTemp ,$levels , $coaches;

    function mount($id)
    {
        $user = User::role('Student')->findOrFail($id);
        $this->user = $user->toArray();
        $this->levels = Level::get();
        $this->coaches = User::Role('Coach')->get();
    }

    public function update()
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
            'user.lesson_add' => 'nullable|numeric',
            'user.level_id' => 'required|exists:levels,id',
            'user.coach_id' => 'required|exists:users,id',
            'user.note' => 'nullable'
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
        $user = User::role('Student')->findOrFail($this->user['id']);

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

        $user->assignRole('Student');

        $user->update($this->user);

        if(isset($this->user['lesson_add']) ){
            HistoryUser::create([
                'add' =>$this->user['lesson_add'],
                'admin_id'=> auth()->user()->id,
                'student_id'=>$this->user['id'],
            ]);
        }
        $this->emit('success', __("Updated successfully"));

    }

    public function incrementLessonCount()
    {
        $this->user['lesson_count'] = $this->user['lesson_add'] + $this->user['lesson_count'];
    }

    public function decrementLessonCount()
    {
        if ($this->user['lesson_count'] > 0) {
            $number = $this->user['lesson_count'];
            $this->user['lesson_count'] = $this->user['lesson_count']- $this->user['lesson_add'];
            if($this->user['lesson_count'] < 0){
                $this->user['lesson_count'] = $number;
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.students.students-edit')->layout('layouts.admins.app');
    }

}
