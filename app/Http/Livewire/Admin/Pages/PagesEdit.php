<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithFileUploads;

class PagesEdit extends Component
{
    use WithFileUploads;

    public $page, $image, $imageTemp;

    function mount($id)
    {

        $page = Page::findOrFail($id);
        $this->page = $page->toArray();

    }

    public function update()
    {
        $this->validate([
            'page.title' => 'required|string',
            'page.description' => '',
            'page.image' => '',

        ]);

        if ($this->page['order']) {
            $this->validate([
                'page.order' => 'numeric',
            ]);
        }

        if ($this->page['image']) {
            $this->validate([
                'image' => ''
            ]);
        }

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
            $this->page['image'] = $this->imageTemp->store('pages/' . $this->id);
        } else {
            unset($this->page['image']);
        }

        $page = Page::findOrFail($this->page['id']);

        $page->update($this->page);
        $this->emit('success', __("Updated successfully"));
    }

    public function render()
    {
        return view('livewire.admin.pages.pages-edit')->layout('layouts.admins.app');
    }

}
