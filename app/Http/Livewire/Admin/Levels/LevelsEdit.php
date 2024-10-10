<?php

namespace App\Http\Livewire\Admin\Levels;

use App\Models\Level;
use Livewire\Component;

class LevelsEdit extends Component
{
    public $level;

    function mount($id)
    {
        $level = Level::findOrFail($id);
        $this->level = $level->toArray();
    }

    public function update()
    {
        $this->validate([
            'level.name' => 'required|string|max:255',
        ]);

        $level = Level::findOrFail($this->level['id']);
        $level->update($this->level);
        $this->emit('success', __("Updated successfully"));
    }

    public function render()
    {
        return view('livewire.admin.levels.levels-edit')->layout('layouts.admins.app');
    }

}
