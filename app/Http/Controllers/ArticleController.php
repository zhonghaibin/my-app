<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Feeds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class ArticleController extends Controller
{
    //

    public function create()
    {
        return view('articles.create');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function save(Request $request, Article $article, Feeds $feeds, \Parsedown $parsedown)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['title', 'subtitle', 'status']);
            $content = $request->get('content') ?? '';
            $parsedown->setSafeMode(true);
            $html = $parsedown->parse($content);
            $description = mb_substr(str_replace(PHP_EOL, '', strip_tags($html)), 0, 200);
            $pattern = '/<img.*?src=["\'](.*?)["\'].*?>/i';
            preg_match_all($pattern, $html, $matches);
            $cover = $matches[1][0] ?? '/images/cover.jpg';
            if (! $article->id) {
                $this->extracted($article, $data, $cover, $description);
                $feeds->content = $content;
                $feeds->html = $html;
                $article->feeds()->save($feeds);
            } else {
                $this->extracted($article, $data, $cover, $description);
                $article->feeds()->update([
                    'content' => $content,
                    'html' => $html,
                ]);
            }
            Cache::forget('articles');
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }

        return redirect()->route('dashboard');
    }

    public function extracted(Article $article, array $data, string $cover, string $description): void
    {
        $article->user_id = auth()->user()->id;
        $article->title = $data['title'];
        $article->subtitle = $data['subtitle'];
        $article->status = $data['status'];
        $article->cover = $cover;
        $article->description = $description;
        $article->save();
    }
}
