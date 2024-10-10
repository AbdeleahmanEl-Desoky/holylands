<?php

namespace App\Http\Livewire\Site\Auth;


use Livewire\Component;

class UpdatePassword extends Component
{


    public function render()
    {
        return view('livewire.site.auth.update-password')->layout('layouts.site.app');
    }
}
