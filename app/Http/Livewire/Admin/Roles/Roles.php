<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];


    public $search, $name, $deleteId, $role_id;

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditRole($id)
    {
        $this->role_id = $id;
    }

    public function refreshModal()
    {
        $this->role_id = "";
    }


    public function delete()
    {

        $roles = Role::findOrFail($this->deleteId);

        if (!auth()->user()->can('roles delete')) {
            $this->emit('error','Role does not have the right permissions.');
            return false;
        }
        $roles->delete();
        $this->emit('success',__("Deleted successfully"));


    }

    public function render()
    {
        $roles = Role::query();

        if ($this->name) {
            $roles = $roles->where('name', 'LIKE', '%' . $this->name . '%');
        }

        $roles = $roles->orderBy('name', "ASC")->paginate(10);
        return view('livewire.admin.roles.roles', compact('roles'))->layout('layouts.admins.app');
    }

}
