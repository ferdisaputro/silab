<?php

namespace App\Livewire\Pages\LbsUsagePermit;

use App\Models\Laboratory;
use App\Models\LbsUsagePermit;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public $LbsUsagePerPage = 15;
    public $LbsUsageFilter = null;
    public $LbsUsageOrderBy = 'id';
    public $LbsUsageOrderByDirection = 'asc';

    public $selectedLab;
    #[Computed()]
    public function lbsUsage() {
        return LbsUsagePermit::when($this->LbsUsageOrderBy && $this->LbsUsageOrderByDirection, function ($query) {
                        $query->orderBy($this->LbsUsageOrderBy, $this->LbsUsageOrderByDirection);
                    })
                    ->where('laboratory_id', $this->selectedLab)
                    // ->with('staffBorrower', 'staffBorrower.user')
                    ->paginate($this->LbsUsagePerPage);
    }
    #[Computed()]
    public function laboratories() {
        return Laboratory::whereIn('id', Auth::user()->labMembers->pluck('laboratory_id'))->get();
    }
    public function mount(){
        $this->selectedLab = $this->laboratories()->first()? $this->laboratories()->first()->id : null;
    }
    public function render()
    {
        return view('livewire.pages.lbs-usage-permit.index');
    }
}
