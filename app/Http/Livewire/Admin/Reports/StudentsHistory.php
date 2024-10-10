<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Models\Level;
use App\Models\User;
use App\Models\HistoryUser;
use App\Models\UserLesson;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudentsHistory extends Component
{
    use WithFileUploads;

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
        
        $historyUser = UserLesson::with(['lesson','level','user','horse','coach'])->where('user_id', $this->user_id)->orderByDesc('id')->paginate(10);
        $user_name = User::where('id',$this->user_id)->first();
        
        return view('livewire.admin.reports.students-history', [
            'users' => $historyUser,
            'user_name' =>$user_name->name
        ])->layout('layouts.admins.app');
    }
}



