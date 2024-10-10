<?php

namespace App\Http\Livewire\Admin;

use App\Models\Contact;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Home extends Component
{

    public $models ,$levels;

    public function mount()
    {

        if (auth()->check() and auth()->user()->hasRole('Admin')) {
            $this->models = [
                'Roles' => Role::count(),
                'Coaches' => User::Role('Coach')->count(),
                'Students' => User::Role('Student')->count(),
                'Lessons' => Lesson::count(),
                'Contacts' => Contact::count(),
            ];

            $this->levels = Level::get();

        } else {
            $this->models = [];
        }

    }

    public function render()
    {
        return view('livewire.admin.home')->layout('layouts.admins.app');
    }
}
