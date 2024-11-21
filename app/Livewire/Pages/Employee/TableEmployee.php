<?php

namespace App\Livewire\Pages\Employee;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class TableEmployee extends Component
{
    use WithPagination;

    public $identifier;
    public $employeeStatus;
    public $isSelectable;

    // template for datatable
    public $employeePerPage = 15;
    public $employeeFilter = null;
    public $employeeOrderBy = 'id';
    public $employeeOrderByDirection = 'asc';

    #[Computed()]
    public function users() {
        return User::where('name', 'like', "%$this->employeeFilter%")
            ->orderBy($this->employeeOrderBy, $this->employeeOrderByDirection)
            ->paginate($this->employeePerPage);
    }

    public function updatedEmployeeFilter() {
        $this->resetPage();
    }

    public function updatedEmployeeOrderBy() {
        dump($this->employeeFilter);
    }

    // public function updatedEmployeeFilter() {
    //     dump($this->employeeFilter);
    // }

    public function dump() {
        dump($this->employeePerPage, $this->employeeFilter, $this->employeeOrderBy, $this->employeeOrderByDirection);
    }

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
