<?php

namespace App\Http\Livewire\Admin\Posts;

use App\Models\Event;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostsCreate extends Component
{
    use WithFileUploads;

    public $post, $image, $imageTemp ,$events;


    public function mount(){

    }

    public function store()
    {
        $this->validate([
            'post.title' => 'required|max:255',
            'post.description' => 'nullable',
        ]);

        if ($this->imageTemp) {
            $this->validate([ 'imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048' ]);
            $this->post['image'] = $this->imageTemp->store('posts/' . $this->id);
        } else {
            unset($this->post['image']);
        }

        $this->post['user_id'] =  auth()->id();

        $post = Post::create($this->post);

        $this->emit('success',__("Added successfully"));
        $this->post = [];

    }


    public function render()
    {
        return view('livewire.admin.posts.posts-create')->layout('layouts.admins.app');
    }

}
