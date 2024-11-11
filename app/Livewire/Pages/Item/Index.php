<?php

namespace App\Livewire\Pages\Item;

use Livewire\Component;

class Index extends Component
{
    public $showCreate = false;

    public function setShowCreate() {
        $this->showCreate = true;
    }

    public function render()
    {
        return view('livewire..pages.item.index');
    }
}
