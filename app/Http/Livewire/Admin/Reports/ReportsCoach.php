<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ReportsCoach extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];


    public $search,$user_id, $coach_id, $users;

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
        $coaches = User::query();
        $coaches = $coaches->role('Coach');

        if ($this->coach_id) {
            $coaches = $coaches->where('id', $this->coach_id);
        }

        $coaches = $coaches->orderBy('created_at', "DESC")->paginate(40);

        return view('livewire.admin.reports.reports-coach', compact('coaches'))->layout('layouts.admins.app');

    }
}
