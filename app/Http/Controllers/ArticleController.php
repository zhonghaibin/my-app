<?php

namespace App\Http\Controllers;

use App\Models\Articles;

class ArticleController extends Controller
{
    //

    public function edit()
    {
        return view('articles.edit');
    }
}
