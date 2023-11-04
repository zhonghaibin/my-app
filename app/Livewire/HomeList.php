<?php

namespace App\Livewire;

use App\Enum\Article as ArticleEnum;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use App\Models\Article;

class HomeList extends Component
{

    public object $articles;

    protected string $keyword='';

    protected $listeners=['searchEvent'=>'search'];

    public function render()
    {
        return view('livewire.home-list');
    }

    public function mount()
    {
        $this->articles();
    }

    public function articles(){
        if($this->keyword){
            $builder = Article::query()->where(['status' => ArticleEnum::STATUS_OPEN]);
            $builder->where('subtitle', 'like', '%' . $this->keyword . '%');
            $articles = $builder->get()->reverse();
        }else{
            $articles =Cache::remember('articles',86400,function (){
                return Article::query()->where(['status' => ArticleEnum::STATUS_OPEN])->get()->reverse();
            });
        }
        $this->articles = $articles;
    }
    public function search($data){
       $this->keyword=$data['keyword'];
       $this->articles();
    }
}
