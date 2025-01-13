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
    public $employeeOrderByDirection = 'desc';

    #[Computed()]
    public function users() {
        return User::where('name', 'like', "%$this->employeeFilter%")
                    // ->orderBy($this->employeeOrderBy, $this->employeeOrderByDirection)
                    ->when($this->employeeOrderBy && $this->employeeOrderByDirection, function ($query) {
                        $query->orderBy($this->employeeOrderBy, $this->employeeOrderByDirection);
                    })
                    ->when($this->employeeStatus == 'technician', function ($query) {
                        $query->whereHas('staff', function ($query) {
                            $query->where('staff_status_id', 3);
                        });
                    })
                    ->with('staff')
                    ->paginate($this->employeePerPage);
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
