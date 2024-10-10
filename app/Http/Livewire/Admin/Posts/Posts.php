<?php

namespace App\Http\Livewire\Admin\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];


    public $search, $title, $description, $deleteId, $post_id ,$image ,$imageTemp ,$create_post ,$Status ,$status;

    public function search()
    {

    }

    function mount(){

    }


    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditPost($id)
    {
        $this->post_id = $id;
    }

    public function Status($id)
    {
        $this->Status = $id;
    }

    public function active()
    {
        $status = '1';

        $sliders = Post::findOrFail($this->Status);
        $sliders->status = $status;

        $sliders->save();
        $this->emit('success',__("Activated successfully"));

    }

    public function inactive()
    {

        $status = '0';

        $sliders = Post::findOrFail($this->Status);
        $sliders->status = $status;

        $sliders->save();
        $this->emit('success',__("Canceled successfully"));


    }

    public function CreatePost()
    {
        $this->create_post = rand(0,10000);
    }


    public function refreshModal()
    {
        $this->post_id = "";
        $this->create_post = "";
    }


    public function delete()
    {

        $posts = Post::findOrFail($this->deleteId);

        if (!auth()->user()->can('posts delete')) {
            $this->emit('error','does not have the right permissions.');
            return false;
        }

        $posts->delete();
        $this->emit('success',__("Deleted successfully"));


    }

    public function render()
    {
        $posts = Post::query();


        if ($this->title) {
            $posts = $posts->where('title', 'LIKE', '%' . $this->title . '%');
        }
        if ($this->description) {
            $posts = $posts->where('description', 'LIKE', '%' . $this->description . '%');
        }

        $posts = $posts->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.posts.posts', compact('posts'))->layout('layouts.admins.app');
    }
}
