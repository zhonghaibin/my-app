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
Route::get('/posts/{id}', [\App\Http\Controllers\IndexController::class,'posts'])->name('posts');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\HomeController::class,'dashboard'])->name('dashboard');
    Route::get('/article/create',[\App\Http\Controllers\ArticleController::class,'create'])->name('article.create');
    Route::get('/article/edit/{article}',[\App\Http\Controllers\ArticleController::class,'edit'])->name('article.edit');
    Route::post('/article/save/{article?}',[\App\Http\Controllers\ArticleController::class,'save'])->name('article.save');
    Route::post('/upload/image',[\App\Http\Controllers\UploadController::class,'image'])->name('upload.image');
});

Route::get('/article/upload',[\App\Http\Controllers\ArticleController::class,'upload'])->name('article.upload');
