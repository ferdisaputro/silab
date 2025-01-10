<?php

namespace App\Livewire\Pages\PracticumEquipmentLoan;

use Livewire\Component;
use App\Models\Laboratory;
use App\Models\EquipmentLoan;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    // template for datatable
    public $equipmentLoanPerPage = 15;
    public $equipmentLoanFilter = null;
    public $equipmentLoanOrderBy = 'id';
    public $equipmentLoanOrderByDirection = 'asc';

    public $selectedLab;

    // template for datatable filter
    // public function updatedEquipmentLoanFilter() {
    //     $this->resetPage();
    // }

    #[Computed()]
    public function equipmentLoans() {
        return EquipmentLoan::when($this->equipmentLoanOrderBy && $this->equipmentLoanOrderByDirection, function ($query) {
                        $query->orderBy($this->equipmentLoanOrderBy, $this->equipmentLoanOrderByDirection);
                    })
                    ->where('laboratory_id', $this->selectedLab)
                    ->with('staff', 'staff.user')
                    ->paginate($this->equipmentLoanPerPage);
                    // where('columnName', 'like', "%$this->equipmentLoanFilter%")
                    // ->orderBy($this->equipmentLoanOrderBy, $this->equipmentLoanOrderByDirection)
    }

    #[Computed()]
    public function laboratories() {
        return Laboratory::whereIn('id', Auth::user()->labMembers->pluck('laboratory_id'))->get();
    }

    public function mount() {
        $this->selectedLab = $this->laboratories()->first()->id;
    }

    public function render()
    {
        return view('livewire.pages.practicum-equipment-loan.index');
    }
}
