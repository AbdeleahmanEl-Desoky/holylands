<?php

namespace App\Http\Livewire\Admin;

use App\Models\Notification;
use Livewire\Component;

class NotificationsShow extends Component
{
    public $item;

    function mount($id)
    {
        $this->item = Notification::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.notifications-show')->layout('layouts.admins.app');
    }
}
