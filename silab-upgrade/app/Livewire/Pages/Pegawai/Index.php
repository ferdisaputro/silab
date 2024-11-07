<?php

namespace App\Livewire\Pages\Pegawai;

use Livewire\Component;

class Index extends Component
{
    // public function mount() {

    // }

    public function render()
    {
        $this->dispatch('initialize-table');
        return view('livewire.pages.pegawai.index');
    }
}
