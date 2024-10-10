<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Models\Level;
use App\Models\User;
use App\Models\UserLesson;
use Livewire\Component;
use Livewire\WithPagination;

class ReportsUser extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];


    public $search,$user_id, $students ,$levels ,$level_id;

    public function search()
    {

    }

    function mount()
    {
        $this->students = User::role('Student')->get();
        $this->levels = Level::get();

    }

    public function refreshModal()
    {

    }
    


    public function render()
    {
        $users = User::query();
        $users = $users->role('Student');

        if ($this->user_id) {
            $users = $users->where('id', $this->user_id);
        }
        if ($this->level_id) {
            $users = $users->where('level_id', $this->level_id);
        }

        $users = $users->orderBy('created_at', "DESC")->paginate(40);

        
        $users->getCollection()->transform(function ($user) {
            $userLesson = UserLesson::where('user_id', $user->id)->count();
            $user->lessons = $userLesson;
            $user->lessons_sum_hours = UserLesson::where('user_id', $user->id)->sum('number_hours');
            
            return $user;
        });


        return view('livewire.admin.reports.reports-user', compact('users'))->layout('layouts.admins.app');

    }

}
