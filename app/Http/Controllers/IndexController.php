<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(){

        return view('index.home');

    }


    public function posts(){

        return view('index.posts');

    }
}
