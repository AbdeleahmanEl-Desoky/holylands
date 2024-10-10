<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Notification;
use Livewire\WithPagination;

class Notifications extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search ,$description , $name , $type;


    public function search()
    {

    }

    public function render()
    {
        $notifications = Notification::query();

        if ($this->description) {
            $notifications = $notifications->where('description', 'LIKE', '%' . $this->description . '%');
        }
        if ($this->type) {
            $notifications = $notifications->where('type', 'LIKE', '%' . $this->type . '%');
        }

        if ($this->name) {

            $notifications = $notifications->whereHas("user",function ($q){
                return $q->where('name','LIKE',"%".$this->name."%");
            });
        }


        $notifications = $notifications->orderBy('created_at', "DESC")->paginate(10);


        return view('livewire.admin.notifications',compact('notifications'))->layout('layouts.admins.app');
    }
}
