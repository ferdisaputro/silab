<?php

namespace App\Livewire\Pages\Pegawai;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

class Tambah extends Component
{
    #[Validate('required|min:5')]
    public $name;
    #[Validate('required|min:5')]
    public $kode;
    #[Validate('required|min:5|integer')]
    public $nomor;

    public function render()
    {
        return view('livewire.pages.pegawai.tambah');
    }
}
