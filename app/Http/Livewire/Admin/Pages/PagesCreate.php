<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithFileUploads;

class PagesCreate extends Component
{
    use WithFileUploads;

    public $page, $image, $imageTemp;


    public function store()
    {
        $this->validate([
            'page.title' => 'required|string',
            'page.order' => 'numeric',
            'page.image' => '',

        ]);

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
            $this->page['image'] = $this->imageTemp->store('pages/' . $this->id);
        } else {
            unset($this->page['image']);
        }

        $page = Page::create($this->page);

        $this->emit('success', __("Added successfully"));
        $this->page = [];
    }


    public function render()
    {
        return view('livewire.admin.pages.pages-create')->layout('layouts.admins.app');
    }


}
