<?php

namespace App\Http\Livewire\Site\News;

use App\Models\Post;
use Livewire\Component;

class NewsSingle extends Component
{
    public $post, $posts;

    public function mount($id)
    {
        $this->post = Post::where('status', 1)->findOrFail($id);
        $this->posts = Post::where('id', '!=', $id)->limit(4)->orderBy('created_at', "DESC")->get();

    }

    public function render()
    {
        return view('livewire.site.news.news-single')->layout('layouts.site.app');
    }
}
