<?php

namespace App\Http\Livewire\Site\Layouts;

use Livewire\Component;

class Header extends Component
{

    public function render()
    {
        return view('layouts.site.header')->layout('layouts.site.app');
    }
}
