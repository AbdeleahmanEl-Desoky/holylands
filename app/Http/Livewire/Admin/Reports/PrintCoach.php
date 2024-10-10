<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Models\User;
use Livewire\Component;

class PrintCoach extends Component
{
    public $coach_id;

    function mount()
    {

        if (!empty(request('coach_id'))) {
            $this->coach_id = request('coach_id');
        }

    }

    public function render()
    {
        $coaches = User::query();
        $coaches = $coaches->role('Coach');

        if ($this->coach_id) {
            $coaches = $coaches->where('id', $this->coach_id);
        }

        $coaches = $coaches->orderBy('created_at', 'DESC')->get();

        return view('livewire.admin.reports.print-coach', compact('coaches'))->layout('layouts.admins.app_print');
    }

}
