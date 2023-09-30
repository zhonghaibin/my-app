<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Articles;

class ArticleList extends Component
{

    public object $articles;
    public function render()
    {
        return view('livewire.article-list');
    }

    public function mount(){
        $this->fetchArticle();
    }
    public function fetchArticle(){
        $this->articles=Articles::query()->where(['user_id'=>auth()->user()->id])->get()->reverse();
    }

    public function delete(Articles $articles){

        $articles->delete();
        $articles->feeds()->delete();
        $this->fetchArticle();
    }

}
