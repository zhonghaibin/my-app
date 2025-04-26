<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = ['pid', 'article_id', 'user_id', 'content'];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
        return $this->belongsTo(Comment::class, 'id', 'pid');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'pid', 'id');
    }
}
