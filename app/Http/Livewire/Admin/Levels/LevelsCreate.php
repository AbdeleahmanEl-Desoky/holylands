<?php

namespace App\Http\Livewire\Admin\Levels;

use App\Models\Level;
use Livewire\Component;

class LevelsCreate extends Component
{

    public $level;

    public function mount()
    {

    }

    public function store()
    {
        $this->validate([
            'level.name' => 'required|string|max:255',
        ]);

        Level::create($this->level);

        $this->emit('success', __("Added successfully"));
        $this->level = [];

    }

    public function render()
    {
        return view('livewire.admin.levels.levels-create')->layout('layouts.admins.app');
    }

}
