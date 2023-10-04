<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use App\Models\Comment;

class PostsComments extends Component
{
    public $comments = '';

    public $article_id = '';

    public $content = '';

    public $pid = 0;

    public $replies_content = '';

    public $comment_id = 0;

    public $hidden = 0;

    public function mount()
    {
        $this->article_id = Route::current()->parameter('id');
        $this->comments();
    }

    public function comments()
    {
        $this->comments = Comment::query()->withCount('replies')->where('article_id', $this->article_id)->get();
    }


    public function render()
    {
        return view('livewire.posts-comments');
    }

    public function addComment()
    {
        if (!auth()->check()) {
            throw ValidationException::withMessages([
                'content' => '请先登录',
            ]);
        }

        $this->validate([
            'content' => 'required|string|max:255',
        ]);

        Comment::create([
            'content' => $this->content,
            'article_id' => $this->article_id,
            'user_id' => auth()->user()->id,
            'pid' => $this->pid
        ]);

        $this->reset('content');
        $this->comments();
    }

    public function delComment($id)
    {
        if (!auth()->check()) {
            return false;
        }
        $comment = Comment::query()->where('user_id', auth()->user()->id)->findOrFail($id);
        $comment->delete();
        $this->comments();
    }

    public function addReplies()
    {
        if (!auth()->check()) {
            throw ValidationException::withMessages([
                'replies_content' => '请先登录',
            ]);
        }

        $this->validate([
            'replies_content' => 'required|string|max:255',
            'comment_id' => 'required',
        ]);

        $comment = Comment::query()->find($this->comment_id);
        Comment::create([
            'content' => $this->replies_content,
            'article_id' => $comment->article_id,
            'user_id' => auth()->user()->id,
            'pid' => $this->comment_id
        ]);

        $this->reset('replies_content');
        $this->comments();
    }

    public function replies($id)
    {
        if ($this->comment_id != $id) {
            $this->hidden = 0;
        }
        $this->comment_id = $id;
        $this->hidden = !$this->hidden;
        $this->comments();
    }

}
