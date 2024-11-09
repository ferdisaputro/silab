<?php

namespace App\Livewire\Pages\Role;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;

class Tambah extends Component
{
    #[Computed(persist: true)]
    public function permissions() {
        return DB::table('permissions')->get();
    }

    public function render()
    {
        return view('livewire.pages.role.tambah');
    }
}
