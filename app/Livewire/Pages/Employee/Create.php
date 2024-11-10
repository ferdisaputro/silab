<?php

namespace App\Livewire\Pages\Employee;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

class Create extends Component
{
    #[Validate('required|min:5')]
    public $name;
    #[Validate('required|min:5')]
    public $kode;
    #[Validate('required|min:5|integer')]
    public $nomor;

    public function render()
    {
        return view('livewire.pages.employee.create');
    }
}
