<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
class PostsComments extends Component
{
    public $comments;

    public $artice_id;

    public $content;


    public function mount()
    {
        $this->comments = Comment::query()->get(); // 获取最新评论
    }


    public function render()
    {
        return view('livewire.posts-comments');
    }

    public function addComment()
    {
        $this->validate([
            'content' => 'required|string|max:255',
        ]);

        Comment::create([
            'content' => $this->content,
            'article_id' => $this->artice_id,
            'user_id' =>auth()->user()->id,
            'pid'=>0
        ]);

        $this->reset('content');
        $this->mount(); // 重新加载评论列表
    }
}
