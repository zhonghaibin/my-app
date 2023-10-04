<?php

namespace App\Http\Controllers;

use App\Enum\Article;
use App\Models\Articles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(Request $request)
    {
        $keyword=$request->get('keyword');
        $builder = Articles::query()->where(['status' => Article::STATUS_OPEN]);
        $builder->when($keyword,function (Builder $builder,$keyword){
            $builder->where('subtitle','like','%'.$keyword.'%');
        });
        $articles =$builder ->get()->reverse();
        return view('index.home', compact('articles'));
    }


    public function posts($id)
    {
        $article = Articles::query()->where(['status' => Article::STATUS_OPEN])->findOrFail($id);
        $article->increment("click");
        $articles = Articles::query()->where(['status' => Article::STATUS_OPEN])->get()->reverse();
        $prev = Articles::query()->where(['status' => Article::STATUS_OPEN])->where('id', '>', $id)->first();
        $next = Articles::query()->where(['status' => Article::STATUS_OPEN])->where('id', '<', $id)->orderBy('id','desc')->first();
        return view('index.posts', compact('article', 'articles', 'prev', 'next'));
    }
}
