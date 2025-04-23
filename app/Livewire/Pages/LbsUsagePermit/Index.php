<?php

namespace App\Livewire\Pages\LbsUsagePermit;

use App\Models\Staff;
use Livewire\Component;
use App\Models\Laboratory;
use App\Models\LbsUsagePermit;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Index extends Component
{
    public $selectedLab;
    public $lbsUsagePermitPerPage = 15;
    public $lbsUsagePermitFilter = null;
    public $lbsUsagePermitOrderBy = 'id';
    public $lbsUsagePermitOrderByDirection = 'asc';


    public function usagePermits() {
        return LbsUsagePermit::when($this->lbsUsagePermitOrderBy && $this->lbsUsagePermitOrderByDirection, function ($query) {
                        $query->orderBy($this->lbsUsagePermitOrderBy, $this->lbsUsagePermitOrderByDirection);
                    })
                    ->where('laboratory_id', $this->selectedLab)
                    ->with('staffBorrower', 'staffBorrower.user')
                    ->paginate($this->lbsUsagePermitPerPage);
                    // where('columnName', 'like', "%$this->lbsUsagePermitFilter%")
                    // ->orderBy($this->lbsUsagePermitOrderBy, $this->lbsUsagePermitOrderByDirection)
    }

    public function mount() {
        if (Gate::allows('isALabMember', Auth::user())) {
            abort(404);
        }
        $this->selectedLab = $this->laboratories()->first()? $this->laboratories()->first()->id : null;
    }

    #[Computed()]
    public function laboratories() {
        return Laboratory::whereIn('id', Auth::user()->labMembers->pluck('laboratory_id'))->get();
    }

    public function render()
    {
        return view('livewire.pages.lbs-usage-permit.index',[
            'lecturers'=>Staff::where('staff_status_id',1)->with('user')->get(), //dosen
        ]);
    }

}
