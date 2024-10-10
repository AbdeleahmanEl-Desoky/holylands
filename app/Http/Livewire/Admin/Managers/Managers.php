<?php

namespace App\Http\Livewire\Admin\Managers;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Managers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $name, $email, $mobile, $deleteId, $manager_id, $role_id, $role, $create_manager, $array;

    public function mount()
    {

    }

    public function search()
    {
        $this->resetPage();
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditManager($id)
    {
        $this->manager_id = $id;
    }

    public function CreateManager()
    {
        $this->create_manager = rand(0, 10000);
    }

    public function refreshModal()
    {
        $this->manager_id = "";
        $this->create_manager = "";
    }

    public function delete()
    {

        $managers = User::role('Admin')->findOrFail($this->deleteId);

        if (!auth()->user()->can('managers delete')) {
            $this->emit('error', 'managers does not have the right permissions.');
            return false;
        }

        $managers->delete();
        $this->emit('success', __("Deleted successfully"));

    }

    public function render()
    {
        $managers = User::query();
        $managers = $managers->role('Admin');

        if ($this->name) {
            $managers = $managers->where('name', 'LIKE', '%' . $this->name . '%');
        }
        if ($this->email) {
            $managers = $managers->where('email', 'LIKE', '%' . $this->email . '%');
        }
        if ($this->mobile) {
            $managers = $managers->where('mobile', 'LIKE', '%' . $this->mobile . '%');
        }

        $managers = $managers->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.managers.managers', compact('managers'))->layout('layouts.admins.app');
    }
}
