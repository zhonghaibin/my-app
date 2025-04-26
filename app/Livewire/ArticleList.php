<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ArticleList extends Component
{
    public object $articles;

    public function render()
    {
        return view('livewire.article-list');
    }

    public function mount()
    {
        $this->fetchArticle();
    }

    public function fetchArticle()
    {
        $this->articles = Article::query()->where(['user_id' => auth()->user()->id])->get()->reverse();
    }

    public function delete(Article $articles)
    {
        if ($articles->user_id != auth()->user()->id) {
            $this->js('alert("无权操作")');

            return false;
        }
        $articles->delete();
        $articles->feeds()->delete();
        $this->fetchArticle();
        Cache::forget('articles');
    }
}
