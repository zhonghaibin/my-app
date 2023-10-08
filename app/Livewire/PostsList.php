<?php

namespace App\Livewire;

use App\Enum\Article as ArticleEnum;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use App\Models\Article;

class PostsList extends Component
{

    public object $articles;

    public function render()
    {
        return view('livewire.posts-list');
    }

    public function mount()
    {
        $this->articles();
    }

    public function articles(){
        $keyword=request()->get('keyword');
        if($keyword){
            $builder = Article::query()->where(['status' => ArticleEnum::STATUS_OPEN]);
            $builder->where('subtitle', 'like', '%' . $keyword . '%');
            $articles = $builder->get()->reverse();
        }else{
            $articles =Cache::remember('articles',86400,function (){
                return Article::query()->where(['status' => ArticleEnum::STATUS_OPEN])->get()->reverse();
            });
        }
        $this->articles = $articles;
    }


}
