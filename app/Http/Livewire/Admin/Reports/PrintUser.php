<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Models\User;
use Livewire\Component;

class PrintUser extends Component
{
    public $user_id , $level_id;

    function mount()
    {

        if (!empty(request('user_id'))) {
            $this->user_id = request('user_id');
        }
        if (!empty(request('level_id'))) {
            $this->level_id = request('level_id');
        }

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

        $users = $users->orderBy('created_at', 'DESC')->get();

        return view('livewire.admin.reports.print-user', compact('users'))->layout('layouts.admins.app_print');
    }

}
