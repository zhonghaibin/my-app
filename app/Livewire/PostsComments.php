<?php

namespace App\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class PostsComments extends Component
{
    public object $comments;

    public string $article_id = '';

    public string $content = '';

    public int $pid = 0;

    public string $replies_content = '';

    public int $comment_id = 0;

    public bool $hidden = false;

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
                'content' => '您还未登录,请先登录',
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

    public function delComment(Comment $comment)
    {
        $this->authorize('delete-comment',$comment);
        DB::beginTransaction();
        try {
            $this->delChild($comment->id);
            $comment->delete();
            DB::commit();
            $this->comments();
        }catch (\Exception $e){
            DB::rollBack();
            \Log::error($e);
        }


    }

    protected function delChild($id)
    {
        $replies = Comment::where('pid', $id)->get();
        if(!$replies->isEmpty()) {
            foreach ($replies as $comment) {
                $this->delChild($comment->id);
                $comment->delete();
            }
        }
    }

    public function addReplies()
    {


        if (!auth()->check()) {
            throw ValidationException::withMessages([
                'replies_content' => '您还未登录,请先登录',
            ]);
        }

        $this->validate([
            'replies_content' => 'required|string|max:255',
            'comment_id' => 'required',
        ]);
        $user= auth()->user;
        $comment = Comment::query()->find($this->comment_id);
        if ($comment->user_id == $user->id) {
            throw ValidationException::withMessages([
                'replies_content' => '很抱歉,不允许您评论自己',
            ]);
        }
        Comment::create([
            'content' => $this->replies_content,
            'article_id' => $comment->article_id,
            'user_id' => $user->id,
            'pid' => $this->comment_id
        ]);

        $this->reset('replies_content');
        $this->comments();
    }

    public function replies($id)
    {
        if ($this->comment_id != $id) {
            $this->hidden = false;
        }
        $this->comment_id = $id;
        $this->hidden = !$this->hidden;
        $this->comments();
    }

}
