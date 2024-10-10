<?php

namespace App\Http\Livewire\Site;

use App\Models\Page;
use Livewire\Component;

class Policy extends Component
{
    public $page;

    function mount()
    {
        $this->page = Page::where('slug', 'policy')->first();
    }

    public function render()
    {
        return view('livewire.site.policy')->layout('layouts.site.app');
    }
}
