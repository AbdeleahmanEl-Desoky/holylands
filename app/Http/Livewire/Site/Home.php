<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;

class Home extends Component
{

    public function render()
    {
        return view('livewire.site.home')->layout('layouts.site.app');
    }
}
