<?php

namespace App\Livewire\Pages\Employee;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Computed;

class Index extends Component
{
    public $employeePerPage = 15;
    public $employeeFilter = null;
    public $employeeOrderBy = 'id';
    public $employeeOrderByDirection = 'desc';

    // template for datatable filter
    public function updatedEmployeeFilter() {
        $this->resetPage();
    }

    #[Computed()]
    public function users() {
        return User::where('name', 'like', "%$this->employeeFilter%")
                    // ->orderBy($this->employeeOrderBy, $this->employeeOrderByDirection)
                    ->when($this->employeeOrderBy && $this->employeeOrderByDirection, function ($query) {
                        $query->orderBy($this->employeeOrderBy, $this->employeeOrderByDirection);
                    })
                    ->paginate($this->employeePerPage);
    }

    public function render()
    {
        return view('livewire.pages.employee.index');
    }
}
