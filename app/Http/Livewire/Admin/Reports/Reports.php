<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Models\User;
use App\Models\UserLesson;
use Livewire\Component;
use Livewire\WithPagination;

class Reports extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];


    public $search, $from, $to, $user_id, $coach_id, $users;

    public function search()
    {

    }

    function mount()
    {
        $this->users = User::role('Coach')->get();
    }

    public function refreshModal()
    {

    }

    public function render()
    {
        $user_lessons = UserLesson::query();

        if ($this->coach_id) {
            $user_lessons = $user_lessons->where('coach_id', $this->coach_id);
        }

        if ($this->from && $this->to) {

            $user_lessons = $user_lessons->whereBetween('created_at', [$this->from . " 00:00:00", $this->to . " 23:59:59"]);
        }

        $user_lessons = $user_lessons->orderBy('created_at', "DESC")->get();

        return view('livewire.admin.reports.reports', compact('user_lessons'))->layout('layouts.admins.app');

    }

}
