<?php

namespace App\Livewire\Pages\Employee;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Computed;

class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.employee.index');
    }
}
