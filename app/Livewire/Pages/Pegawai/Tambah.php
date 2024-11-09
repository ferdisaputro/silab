<?php

namespace App\Livewire\Pages\Pegawai;

use Livewire\Attributes\Rule;
use Livewire\Component;

class Tambah extends Component
{
    #[Rule('required|min:5')]
    public $name;
    #[Rule('required|min:5')]
    public $kode;
    #[Rule('required|min:5|integer')]
    public $nomor;

    public function render()
    {
        return view('livewire.pages.pegawai.tambah');
    }
}
