<?php

namespace App\Http\Livewire\Admin;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class Contacts extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $email ,$name, $title ,$message , $deleteId ,$search ;

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }


    public function delete()
    {

        $contacts = Contact::findOrFail($this->deleteId);

        if (!auth()->user()->can('contacts delete')) {
            $this->emit('error','contact does not have the right permissions.');
            return false;
        }

        $contacts->delete();
        $this->emit('success',__("Deleted successfully"));


    }

    public function render()
    {
        $contacts = Contact::query();

        if ($this->name) {
            $contacts = $contacts->where('name', 'LIKE', '%' . $this->name . '%');
        }

        if ($this->email) {
            $contacts = $contacts->where('email', 'LIKE', '%' . $this->email . '%');
        }

        if ($this->title) {
            $contacts = $contacts->where('title', 'LIKE', '%' . $this->title . '%');
        }

        if ($this->message) {
            $contacts = $contacts->where('message', 'LIKE', '%' . $this->message . '%');
        }

        $contacts = $contacts->orderBy('created_at', "DESC")->paginate(20);

        return view('livewire.admin.contacts',compact('contacts'))->layout('layouts.admins.app');
    }


}
