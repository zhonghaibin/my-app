<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\IndexController::class,'home'])->name('home');
Route::get('/posts/{article_id}', [\App\Http\Controllers\IndexController::class,'posts'])->name('posts');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\ArticleController::class,'dashboard'])->name('dashboard');
    Route::get('/article', [\App\Http\Controllers\ArticleController::class,'index'])->name('article.index');
});
