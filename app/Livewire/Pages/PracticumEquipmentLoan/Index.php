<?php

namespace App\Livewire\Pages\PracticumEquipmentLoan;

use App\Models\Staff;
use Livewire\Component;
use App\Models\Laboratory;
use App\Models\EquipmentLoan;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

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
                    ->with('staffBorrower', 'staffBorrower.user')
                    ->paginate($this->equipmentLoanPerPage);
                    // where('columnName', 'like', "%$this->equipmentLoanFilter%")
                    // ->orderBy($this->equipmentLoanOrderBy, $this->equipmentLoanOrderByDirection)
    }

    #[Computed()]
    public function laboratories() {
        return Laboratory::whereIn('id', Auth::user()->labMembers->pluck('laboratory_id'))->get();
    }

    public function delete($key) {
        $id = Crypt::decrypt($key);

        try {
            DB::beginTransaction();

            $eqLoan = EquipmentLoan::find($id);
            if ($eqLoan->status == 1) {

                foreach ($eqLoan->loanDetails as $loanDetail) {
                    $loanDetail->labItem->stock = $loanDetail->labItem->stock + $loanDetail->qty;
                    $loanDetail->labItem->save();
                    $loanDetail->stockCard->delete();
                }

                $eqLoan->delete();

                // dd($eqLoan);

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Jurusan berhasil dihapus',
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki akses untuk menghapus data peminjaman',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data jurusan: ' . $e->getMessage(),
            ]);
        }
    }

    public function mount() {
        $this->selectedLab = $this->laboratories()->first()? $this->laboratories()->first()->id : null;
    }

    public function render()
    {
        return view('livewire.pages.practicum-equipment-loan.index', [
            'lecturers' => Staff::where('staff_status_id', 1)->with('user')->get(), //dosen
        ]);
    }
}
