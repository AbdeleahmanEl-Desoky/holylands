<?php

namespace App\Http\Livewire\Admin\Posts;

use App\Models\Event;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostsEdit extends Component
{
    use WithFileUploads;

    public $post ,$image ,$imageTemp ,$events;

    function mount($id){
        $post = Post::findOrFail($id);
        $this->post = $post->toArray();

    }

    public function update()
    {
        $this->validate([
            'post.title' => 'required|max:255',
            'post.description' => 'nullable',
        ]);

        if ($this->imageTemp) {
            $this->validate([ 'imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048' ]);
            $this->post['image'] = $this->imageTemp->store('posts/'.$this->id);
        }else{
            unset($this->post['image']);
        }

        $post = Post::findOrFail($this->post['id']);
        $post->update($this->post);
        $this->emit('success',__("Updated successfully"));
    }


    public function render()
    {

        return view('livewire.admin.posts.posts-edit')->layout('layouts.admins.app');
    }

}
