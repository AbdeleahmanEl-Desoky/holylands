<?php

namespace App\Http\Livewire\Admin\Horses;

use App\Models\Horse;
use Livewire\Component;
use Livewire\WithPagination;

class Horses extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];


    public $search, $name, $description, $deleteId, $horse_id ,$image ,$imageTemp ,$create_horse ,$Status ,$status;

    public function search()
    {

    }

    function mount(){

    }


    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditHorse($id)
    {
        $this->horse_id = $id;
    }

    public function Status($id)
    {
        $this->Status = $id;
    }

    public function active()
    {
        $status = '1';

        $sliders = Horse::findOrFail($this->Status);
        $sliders->status = $status;

        $sliders->save();
        $this->emit('success',__("Activated successfully"));

    }

    public function inactive()
    {

        $status = '0';

        $sliders = Horse::findOrFail($this->Status);
        $sliders->status = $status;

        $sliders->save();
        $this->emit('success',__("Canceled successfully"));


    }

    public function CreateHorse()
    {
        $this->create_horse = rand(0,10000);
    }


    public function refreshModal()
    {
        $this->horse_id = "";
        $this->create_horse = "";
    }


    public function delete()
    {

        $horses = Horse::findOrFail($this->deleteId);

        if (!auth()->user()->can('horses delete')) {
            $this->emit('error','does not have the right permissions.');
            return false;
        }

        $horses->delete();
        $this->emit('success',__("Deleted successfully"));


    }

    public function render()
    {
        $horses = Horse::query();


        if ($this->name) {
            $horses = $horses->where('name', 'LIKE', '%' . $this->name . '%');
        }

        $horses = $horses->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.horses.horses', compact('horses'))->layout('layouts.admins.app');
    }
}
