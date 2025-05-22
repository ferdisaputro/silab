<?php

namespace App\Livewire\Pages\PracticumEquipmentLoan;

use App\Models\Staff;
use Livewire\Component;
use App\Models\Laboratory;
use App\Models\EquipmentLoan;
use App\Models\LabMember;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        return Laboratory::onlyActiveUserMember()->get();
    }

    public function delete($key) {
        $this->authorize('hasPermissionTo', 'bonalat-delete');
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

    // public function print($key) {
    //     $equipmentLoan = EquipmentLoan::find(Crypt::decrypt($key));
    //     $labMember = LabMember::firstWhere('staff_id', Auth::user()->staff->id);

    //     $name = null;
    //     $code = null;
    //     $returnerName = null;
    //     $returnerCode = null;

    //     if ($equipmentLoan->is_staff == 1) {
    //         $name = $equipmentLoan->staffBorrower->user->name;
    //         $code = "NIP.".$equipmentLoan->staffBorrower->user->code;
    //     } else {
    //         $name = $equipmentLoan->name;
    //         $code = "NIM.".$equipmentLoan->nim;
    //     }

    //     if ($equipmentLoan->is_returner_staff == 1) {
    //         $returnerName = $equipmentLoan->staffReturner->user->name;
    //         $returnerCode = "NIP.".$equipmentLoan->staffReturner->user->code;
    //     } else {
    //         $returnerName = $equipmentLoan->returner_name;
    //         $returnerCode = "NIM.".$equipmentLoan->returner_nim;
    //     }

    //     $data = [
    //         'department' => $labMember->laboratory->department->name,
    //         'name' => $name,
    //         'code' => $code,
    //         'equipmentLoan' => $equipmentLoan,
    //         'returnerName' => $returnerName,
    //         'returnerCode' => $returnerCode,
    //     ];

    //     $date = date('YmdHis');

    //     $pdf = Pdf::loadView('print.equipment-loan', $data)->setPaper('a4', 'portrait')->setWarnings(false);
    //     return $pdf->download($date."#peminjaman-alat#".$name.".pdf");
    // }

    public function mount() {
        $this->authorize('hasPermissionTo', 'bonalat-list|bonalat-create|bonalat-edit|bonalat-delete');
        $this->selectedLab = $this->laboratories()->first()? $this->laboratories()->first()->id : null;
    }

    public function render()
    {
        if (Gate::allows('isNotALabMember', Auth::user())) {
            return view('components.not-a-lab-member-exception');
        }
        return view('livewire.pages.practicum-equipment-loan.index', [
            'lecturers' => Staff::where('staff_status_id', 1)->with('user')->get(), //dosen
        ]);
    }
}
