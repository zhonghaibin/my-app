<?php

namespace App\Http\Controllers;

use App\Enum\Article as ArticleEnum;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function home(Request $request)
    {
        $keyword=$request->get('keyword');
        if($keyword){
            $builder = Article::query()->where(['status' => ArticleEnum::STATUS_OPEN]);
            $builder->where('subtitle', 'like', '%' . $keyword . '%');
            $articles = $builder->get()->reverse();
        }else{
            $articles =Cache::remember('articles',86400,function (){
                return Article::query()->where(['status' => ArticleEnum::STATUS_OPEN])->get()->reverse();
            });
        }
        return view('index.home', compact('articles'));
    }


    public function posts($id)
    {
        $article = Article::query()->where(['status' => ArticleEnum::STATUS_OPEN])->findOrFail($id);
        return view('index.posts', compact('article'));
    }
}
