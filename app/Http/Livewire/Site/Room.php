<?php

namespace App\Http\Livewire\Site;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Room extends Component
{
    public $lessons, $coaches ,$from;

    function mount()
    {
        $this->from = Carbon::now()->format('Y-m-d');
        $this->coaches = User::role('Coach')->whereHas('coach_users_lessons',function($q){
                    $q->where('end', '!=', 1)
          ->orWhereNull('end')->orWhere('end',0);
        })->where('status', 1)->get();
    }

    public function render()
    {
        return view('livewire.site.room')->layout('layouts.site.app');
    }

}
