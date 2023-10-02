<?php

namespace App\Http\Controllers;

use App\Enum\Article;
use App\Models\Articles;

class IndexController extends Controller
{
    public function home()
    {

        $articles = Articles::query()->where(['status' => Article::STATUS_OPEN])->get()->reverse();
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
