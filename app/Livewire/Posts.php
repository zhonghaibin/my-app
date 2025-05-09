<?php

namespace App\Livewire;

use App\Enum\Article as ArticleEnum;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Posts extends Component
{
    public object $article;

    public object $articles;

    public ?object $prev;

    public ?object $next;

    public function mount($id)
    {
        $this->article($id);
        $this->articles = Cache::remember('articles', 86400, function () {
            return Article::query()->where(['status' => ArticleEnum::STATUS_OPEN])->get()->reverse();
        });
        $this->prev = Article::query()->where(['status' => ArticleEnum::STATUS_OPEN])->where('id', '>', $id)->first();
        $this->next = Article::query()->where(['status' => ArticleEnum::STATUS_OPEN])->where('id', '<', $id)->orderBy('id', 'desc')->first();
    }

    public function article($id)
    {
        $this->article = Article::query()->where(['status' => ArticleEnum::STATUS_OPEN])->findOrFail($id);
        $this->article->increment('click');
    }

    public function render()
    {
        return view('livewire.posts');
    }
}
