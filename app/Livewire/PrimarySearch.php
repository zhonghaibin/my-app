<?php

namespace App\Livewire;

use Livewire\Component;

class PrimarySearch extends Component
{

    public string $keyword='';

    public function render()
    {
        return view('livewire.primary-search');
    }

    public function search(){
        $this->dispatch('searchEvent', ['keyword'=>$this->keyword]);
    }
}
