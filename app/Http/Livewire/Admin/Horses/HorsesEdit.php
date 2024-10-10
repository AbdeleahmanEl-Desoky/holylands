<?php

namespace App\Http\Livewire\Admin\Horses;

use App\Models\Horse;
use Livewire\Component;

class HorsesEdit extends Component
{
    public $horse;

    function mount($id)
    {
        $horse = Horse::findOrFail($id);
        $this->horse = $horse->toArray();
    }

    public function update()
    {
        $this->validate([
            'horse.name' => 'required|string|max:255',
        ]);

        $horse = Horse::findOrFail($this->horse['id']);
        $horse->update($this->horse);
        $this->emit('success', __("Updated successfully"));
    }

    public function render()
    {
        return view('livewire.admin.horses.horses-edit')->layout('layouts.admins.app');
    }
}
