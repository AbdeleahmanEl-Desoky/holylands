<?php

namespace App\Http\Livewire\Admin\Levels;

use App\Models\Level;
use Livewire\Component;
use Livewire\WithPagination;

class Levels extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];


    public $search, $name, $deleteId, $level_id,$create_level;

    public function search()
    {

    }

    function mount(){

    }


    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditLevel($id)
    {
        $this->level_id = $id;
    }

    public function CreateLevel()
    {
        $this->create_level = rand(0,10000);
    }

    public function refreshModal()
    {
        $this->level_id = "";
        $this->create_level = "";
    }

//    public function delete()
//    {
//
//        $levels = Level::findOrFail($this->deleteId);
//
//        if (!auth()->user()->can('levels delete')) {
//            $this->emit('error', 'Level does not have the right permissions.');
//            return false;
//        }
//
//        $levels->delete();
//        $this->emit('success', __("Deleted successfully"));
//
//    }

    public function render()
    {
        $levels = Level::query();

        if ($this->name) {
            $levels = $levels->where('name', 'LIKE', '%' . $this->name . '%');
        }

        $levels = $levels->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.levels.levels', compact('levels'))->layout('layouts.admins.app');
    }

}
