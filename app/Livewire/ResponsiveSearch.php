<?php

namespace App\Livewire;

use Livewire\Component;

class ResponsiveSearch extends Component
{
    public string $keyword = '';

    public function render()
    {
        return view('livewire.responsive-search');
    }

    public function search()
    {
        $this->dispatch('searchEvent', ['keyword' => $this->keyword]);
    }
}
