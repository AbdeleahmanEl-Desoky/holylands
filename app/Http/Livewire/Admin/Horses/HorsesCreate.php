<?php

namespace App\Http\Livewire\Admin\Horses;

use App\Models\Horse;
use Livewire\Component;

class HorsesCreate extends Component
{
    public $horse;

    public function mount()
    {

    }

    public function store()
    {
        $this->validate([
            'horse.name' => 'required|string|max:255',
        ]);

        Horse::create($this->horse);

        $this->emit('success', __("Added successfully"));
        $this->horse = [];

    }

    public function render()
    {
        return view('livewire.admin.horses.horses-create')->layout('layouts.admins.app');
    }

}
