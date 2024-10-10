<?php

namespace App\Http\Livewire\Site\Auth;


use Livewire\Component;

class ResetPassword extends Component
{

    public function render()
    {
        return view('livewire.site.auth.reset-password')->layout('layouts.site.app');
    }
}
