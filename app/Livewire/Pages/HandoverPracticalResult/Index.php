<?php

namespace App\Livewire\Pages\HandoverPracticalResult;

use App\Models\Laboratory;
use App\Models\PracticumResultHandover;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public $handOverPerPage = 15;
    public $handOverFilter = null;
    public $handOverOrderBy = 'id';
    public $handOverOrderByDirection = 'asc';
    public $selectedLab;

    // #[Computed()]
    // public function handOvers() {
    //     return PracticumResultHandover::when($this->handOverOrderBy && $this->handOverOrderByDirection, function ($query) {
    //                     $query->orderBy($this->handOverOrderBy, $this->handOverOrderByDirection);
    //                 })
    //                 ->where('laboratory_id', $this->selectedLab)
    //                 // ->with('staffBorrower', 'staffBorrower.user')
    //                 ->paginate($this->handOverPerPage);
    //                 // where('columnName', 'like', "%$this->equipmentLoanFilter%")
    //                 // ->orderBy($this->equipmentLoanOrderBy, $this->equipmentLoanOrderByDirection)
    // }

    #[Computed()]
    public function laboratories() {
        return Laboratory::whereIn('id', Auth::user()->labMembers->pluck('laboratory_id'))->get();
    }

    public function mount(){
        $this->selectedLab = $this->laboratories()->first()? $this->laboratories()->first()->id : null;
    }
    public function render()
    {
        return view('livewire.pages.handover-practical-result.index');
    }
}
