<?php

namespace App\Http\Livewire\Admin\layouts;

use App\Models\Notification;
use Livewire\Component;

class HeaderNotifications extends Component
{

    public $notifications;

    function mount(){


    }

    public function render()
    {
        $this->notifications = Notification::orderBy('id',"DESC")->limit(3)->get();
        return view('livewire.admin.layouts.header-notifications');
    }
}
