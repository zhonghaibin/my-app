<?php

namespace App\Livewire;

use App\Models\Feeds;
use Livewire\Component;
use App\Models\Articles;

class CreateArticle extends Component
{

    public string $journal = '';
    public string $title = '';
    public string $description = '';
    public string $keywords = '';
    public string $cover = '';
    public string $status = '1';
    public string $content = '';

    public function render()
    {
        return view('livewire.create-article');
    }

    public function save()
    {
        $article = new Articles();
        $article->user_id = auth()->user()->id;
        $article->journal = $this->journal;
        $article->title = $this->title;
        $article->description = $this->description;
        $article->keywords = $this->keywords;
        $article->cover = $this->cover;
        $article->status = $this->status;
        $article->save();

        $feed = new Feeds();
        $feed->content = $this->content;
        $feed->html = $this->content;
        $article->feeds()->save($feed);

        $this->reset('journal', 'title', 'description', 'keywords', 'cover', 'status', 'content');
        return redirect()->route('dashboard');
    }
}
