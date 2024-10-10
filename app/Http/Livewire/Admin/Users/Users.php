<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $name, $email, $mobile, $deleteId, $user_id, $role_id, $role, $create_user, $array;

    public function mount($array = [])
    {
        $this->array = $array;
        if (!empty($array['role_id'])) {
            $this->role_id = $array['role_id'];
        }

    }


    public function search()
    {
        $this->resetPage();
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditUser($id)
    {
        $this->user_id = $id;
    }

    public function CreateUser()
    {
        $this->create_user = rand(0, 10000);
    }

    public function refreshModal()
    {
        $this->user_id = "";
        $this->create_user = "";
    }


    public function delete()
    {

        $users = User::findOrFail($this->deleteId);

        if (!auth()->user()->can('users delete')) {
            $this->emit('error', 'users does not have the right permissions.');
            return false;
        }

        $users->delete();
        $this->emit('success', __("Deleted successfully"));

    }

    public function render()
    {
        $users = User::query();

        if ($this->name) {
            $users = $users->where('name', 'LIKE', '%' . $this->name . '%');
        }
        if ($this->email) {
            $users = $users->where('email', 'LIKE', '%' . $this->email . '%');
        }
        if ($this->mobile) {
            $users = $users->where('mobile', 'LIKE', '%' . $this->mobile . '%');
        }

        $users = $users->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.users.users', compact('users'))->layout('layouts.admins.app');
    }
}
