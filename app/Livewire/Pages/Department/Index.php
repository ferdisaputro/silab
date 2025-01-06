<?php

namespace App\Livewire\Pages\Department;

use Livewire\Component;
use App\Models\Department;
use Livewire\Attributes\Computed;

class Index extends Component
{
    public $departmentPerPage = 15;
    public $departmentFilter = null;
    public $departmentOrderBy = 'id';
    public $departmentOrderByDirection = 'asc';

    #[Computed()]
    public function departments() {
        return Department::where('department', 'like', "%$this->departmentFilter%")
                    // ->orderBy($this->departmentOrderBy, $this->departmentOrderByDirection)
                    ->when($this->departmentOrderBy && $this->departmentOrderByDirection, function ($query) {
                        $query->orderBy($this->departmentOrderBy, $this->departmentOrderByDirection);
                    })
                    ->paginate($this->departmentPerPage);
    }

    public function render()
    {
        return view('livewire.pages.department.index');
    }
}
