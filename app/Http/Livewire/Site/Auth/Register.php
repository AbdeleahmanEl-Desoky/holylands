<?php

namespace App\Http\Livewire\Site\Auth;


use Livewire\Component;


class Register extends Component
{

    public function render()
    {
        return view('livewire.site.auth.register')->layout('layouts.site.app');
    }
}
