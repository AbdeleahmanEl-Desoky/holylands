<?php

namespace App\Http\Livewire\Site\News;

use App\Models\Post;
use Livewire\Component;

class News extends Component
{
    public $posts;

    public function mount()
    {

        $this->posts = Post::limit(4)->orderBy('created_at', "DESC")->get();

    }

    public function render()
    {

        return view('livewire.site.news.news')->layout('layouts.site.app');
    }
}
