<?php

namespace App\Livewire\Pages\LbsUsagePermit;

use Carbon\Carbon; // tambahkan ini di atas
use App\Models\Laboratory;
use App\Models\Staff;
use App\Models\LbsUsagePermit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
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
                    ->with('staffBorrower', 'staffBorrower.user')
                    ->paginate($this->LbsUsagePerPage);

        // Lakukan pengecekan dan update status
        foreach ($usages as $usage) {
            if ($usage->status == 1 && Carbon::now()->greaterThan(Carbon::parse($usage->end_date))) {
                $usage->status = 2;
                $usage->save(); // <== SIMPAN KE DATABASE
            }
        }

        return $usages;
    }

    #[Computed()]
    public function laboratories() {
        return Laboratory::whereIn('id', Auth::user()->labMembers->pluck('laboratory_id'))->get();
    }

    public function delete($key) {
        $id = Crypt::decrypt($key);

        try {
            DB::beginTransaction();

            $lbs = LbsUsagePermit::find($id);
            if ($lbs->status == 1) {

                foreach ($lbs->details as $usageDetails) {
                    $usageDetails->labItem->stock = $usageDetails->labItem->stock + $usageDetails->qty;
                    $usageDetails->labItem->save();
                    $usageDetails->stockCard->delete();
                }

                $lbs->delete();

                // dd($eqLoan);

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Permohonan Ijin LBS berhasil dihapus',
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki akses untuk menghapus data perijinan LBS',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data perijinan LBS: ' . $e->getMessage(),
            ]);
        }
    }

    public function mount(){
        if (Gate::allows('isALabMember', Auth::user())) {
            abort(404);
        }
        $this->selectedLab = $this->laboratories()->first()? $this->laboratories()->first()->id : null;
    }
    public function render()
    {
        // Update status otomatis sebelum render data
        LbsUsagePermit::where('status', 1)
            ->where('end_date', '<', Carbon::now())
            ->update(['status' => 2]);

        return view('livewire.pages.lbs-usage-permit.index',
        ['lecturers' => Staff::where('staff_status_id', 1)->with('user')->get(), //dosen
        ]);
    }
}
