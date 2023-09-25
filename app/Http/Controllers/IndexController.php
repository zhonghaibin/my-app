<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {
        $articles = Articles::query()->where(['status' => 1])->paginate();
        return view('index.home', compact('articles'));
    }


    public function posts($article_id)
    {
        $article = Articles::query()->where(['status' => 1])->findOrFail($article_id);
        $articles = Articles::query()->where(['status' => 1])->get();
        $article->increment('click', 1);
        return view('index.posts', compact('article', 'articles'));
    }
}
