<?php

namespace App\Http\Livewire\Admin\Coaches;

use App\Models\Lesson;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class CoachesHistory extends Component
{
    use WithFileUploads;

    protected $userData;
    public $user = [];
    public $startDate;
    public $endDate;
    public $coachId;

    public function mount($id)
    {
        $this->coachId = $id;
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        $this->loadUserData();
    }

    public function loadUserData()
    {
        $this->userData = Lesson::with(['level', 'users', 'user_horses'])
            ->where('coach_id', $this->coachId)
            ->whereBetween('created_at', [$this->startDate . ' 00:00:00', $this->endDate . ' 23:59:59'])
            ->orderByDesc('id')
            ->get();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['startDate', 'endDate'])) {
            $this->loadUserData();
        }
    }

    public function exportToExcel()
    {
        $data = Lesson::with(['level', 'users', 'user_horses'])
            ->where('coach_id', $this->coachId)
            ->whereBetween('created_at', [$this->startDate . ' 00:00:00', $this->endDate . ' 23:59:59'])
            ->orderByDesc('id')
            ->get();

        return Excel::download(new \App\Exports\HistoryExport($data), 'coaches_history.xlsx');
    }
    public function __destruct()
    {
        session()->forget('exportData');
    }


    public function render()
    {
        return view('livewire.admin.coaches.coaches-history', [
            'histories' => $this->userData,
        ])->layout('layouts.admins.app');
    }
}
