<?php

namespace App\Livewire\Pages\Employee;

use Livewire\Component;

class TableEmployee extends Component
{
    public $identifier;
    public $employeeStatus;
    public $isSelectable;

    public function mount($identifier = "null", $employeeStatus = null, $isSelectable = false) {
        $this->identifier = $identifier;
        $this->employeeStatus = $employeeStatus;
        $this->isSelectable = $isSelectable;
    }

    public function render()
    {
        return view('livewire.pages.employee.table-employee');
    }
}
