<?php

namespace App\Http\Livewire\Site;

use App\Models\Contact;
use Livewire\Component;

class Contacts extends Component
{

    public $contact;


    public function store()
    {
        $this->validate([
            'contact.name' => 'required|string|max:255',
            'contact.email' => 'required|email|max:255',
            'contact.title' => 'required|string|min:3|max:1000',
            'contact.message' => 'required|string|min:3|max:2000',
        ]);

        $contact = Contact::create($this->contact);
        $this->emit('alertSuccess','تم الارسال بنجاح شكرا لك , سنتواصل معك قريبا');
        $this->contact = [];

    }

    public function render()
    {
        return view('livewire.site.contacts')->layout('layouts.site.app');
    }

}
