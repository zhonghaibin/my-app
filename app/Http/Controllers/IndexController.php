<?php

namespace App\Http\Controllers;

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
