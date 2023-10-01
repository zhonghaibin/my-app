<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Feeds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
class ArticleController extends Controller
{
    //


    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request, Articles $articles, Feeds $feeds, \Parsedown $parsedown)
    {
        DB::beginTransaction();
        try {
            $articles_data = $request->only(['title', 'subtitle', 'status']);
            $content = $request->get('content');
            $parsedown->setSafeMode(true);
            $html = $parsedown->parse($content);
            $description = substr(str_replace(PHP_EOL, '', strip_tags($html)), 0, 200);
            $pattern = '/<img.*?src=["\'](.*?)["\'].*?>/i';
            preg_match_all($pattern, $html, $matches);
            $cover = $matches[1][0]??'/images/cover.jpg';
            $articles = $articles->query()->create(
                array_merge($articles_data, [
                    'user_id' => auth()->user()->id,
                    'cover' => $cover,
                    'description' => $description,
                ])
            );
            $feeds->content = $content;
            $feeds->html = $html;
            $articles->feeds()->save($feeds);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw  new Exception($exception->getMessage());
        }

        return redirect()->route('dashboard');
    }

    public function edit(Articles $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Articles $article, \Parsedown $parsedown)
    {
        DB::beginTransaction();
        try {
            $articles_data = $request->only(['title', 'subtitle', 'status']);
            $content = $request->get('content');
            $parsedown->setSafeMode(true);
            $html = $parsedown->parse($content);
            $description = substr(str_replace(PHP_EOL, '', strip_tags($html)), 0, 200);
            $pattern = '/<img.*?src=["\'](.*?)["\'].*?>/i';
            preg_match_all($pattern, $html, $matches);
            $cover = $matches[1][0]??'/images/cover.jpg';
            $article->feeds()->update(
                [
                    'content' => $content,
                    'html' => $html,
                ]
            );
            $article->update( array_merge($articles_data, [
                'user_id' => auth()->user()->id,
                'cover' => $cover,
                'description' => $description,
            ]));
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw  new Exception($exception->getMessage());
        }
        return redirect()->route('dashboard');
    }
}
