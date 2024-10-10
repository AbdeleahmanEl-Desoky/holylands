<?php

namespace App\Http\Livewire\Admin\Coaches;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Coaches extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $name, $email, $mobile, $deleteId, $coach_id, $role_id, $role, $create_coach, $array ,$username;

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

    public function EditCoach($id)
    {
        $this->coach_id = $id;
    }

    public function CreateCoach()
    {
        $this->create_coach = rand(0, 10000);
    }

    public function refreshModal()
    {
        $this->coach_id = "";
        $this->create_coach = "";
    }

    public function delete()
    {

        $coaches = User::role('Coach')->findOrFail($this->deleteId);

        if (!auth()->user()->can('coaches delete')) {
            $this->emit('error', 'coaches does not have the right permissions.');
            return false;
        }

        $coaches->delete();
        $this->emit('success', __("Deleted successfully"));

    }

    public function render()
    {
        $coaches = User::query();
        $coaches = $coaches->role('Coach');

        if ($this->name) {
            $coaches = $coaches->where('name', 'LIKE', '%' . $this->name . '%');
        }
        if ($this->username) {
            $coaches = $coaches->where('username', 'LIKE', '%' . $this->username . '%');
        }
        if ($this->email) {
            $coaches = $coaches->where('email', 'LIKE', '%' . $this->email . '%');
        }
        if ($this->mobile) {
            $coaches = $coaches->where('mobile', 'LIKE', '%' . $this->mobile . '%');
        }

        $coaches = $coaches->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.coaches.coaches', compact('coaches'))->layout('layouts.admins.app');
    }

}
