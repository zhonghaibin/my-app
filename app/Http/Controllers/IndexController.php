<?php

namespace App\Http\Controllers;

use App\Enum\Article as ArticleEnum;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function home()
    {
        return view('index.home');
    }


    public function posts($id)
    {
        return view('index.posts', compact('id'));
    }
}
