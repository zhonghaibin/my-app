<?php

namespace App\Livewire;

use App\Models\Articles;
use Livewire\Component;

class EditArticle extends Component
{
    public string $journal = '';
    public string $title = '';
    public string $description = '';
    public string $keywords = '';
    public string $cover = '';
    public string $status = '1';
    public string $content = '';

    public $article;

    public function mount()
    {

        $this->article = Articles::query()->find(request()->route('id'));
        $this->fill($this->article);
        $this->content = $this->article->feeds->content;
    }

    public function render()
    {
        return view('livewire.edit-article');
    }


    public function save()
    {
        $this->article->journal = $this->journal;
        $this->article->title = $this->title;
        $this->article->description = $this->description;
        $this->article->keywords = $this->keywords;
        $this->article->cover = $this->cover;
        $this->article->status = $this->status;
        $this->article->save();

        $feed = $this->article->feeds;
        $feed->content = $this->content;
        $feed->html = $this->content;
        $feed->save();

        return redirect()->route('dashboard');
    }
}
