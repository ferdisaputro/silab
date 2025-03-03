<?php

namespace App\Livewire\Pages\PracticumEquipmentLoan;

use Throwable;
use Carbon\Carbon;
use App\Models\Staff;
use App\Models\LabItem;
use Livewire\Component;
use App\Models\StockCard;
use App\Models\Laboratory;
use Illuminate\Support\Str;
use App\Models\EquipmentLoan;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use App\Models\EquipmentLoanDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class BorrowReturn extends Component
{
// #[Validate('required|string|max:12')] // VARCHAR(12) for unique code
    // public $code;

    #[Validate('required|boolean')] // TINYINT(1) for boolean (0 or 1)
    public $isStaff;

    // variables if isStaff is false
    #[Validate('required_if:isStaff,0|max:255')] // VARCHAR(255) for the name
    public $returnerName;
    #[Validate('required_if:isStaff,0|max:12')] // NIM field, optional, VARCHAR(255)
    public $returnerNim;
    #[Validate('required_if:isStaff,0|max:255')] // Group class, optional, VARCHAR(255)
    public $returnerGroupClass;

    // variable for returning
    #[Validate('required')] // DATETIME for return date, required
    public $returnDate;
    #[Validate('required')] // DATETIME for return date, required
    public $returnTime;
    #[Validate('required|integer|exists:lab_members,id')] // BIGINT(20), required, foreign key
    public $labMemberReturn;

    // variables if the one who returning is staff
    #[Validate('required_if:isStaff,1')] // BIGINT(20), nullable, foreign key
    public $staffReturner;

    public $id;
    public $equipmentLoan;

    // #[Validate('required|boolean')] // TINYINT(1) for boolean (0 or 1)
    // public $isReturnerStaff;

    #[Validate([
        'loanDetailItems.*.returnQty' => 'required|integer|min:1'
    ])]
    //item list for labItems
    public $loanDetailItems = [
        [
            'loanDetailId' => "",
            'returnQty' => 0
        ]
    ];

    public function return() {
        $this->validate();
        // dd([
        //     'Equipment Loan' => $this->equipmentLoan,
        //     'Loan Detail Item' => $this->loanDetailItems,
        //     'Is Staff' => $this->isStaff,
        //     'Returner Name' => $this->returnerName,
        //     'Returner NIM' => $this->returnerNim,
        //     'Returner Group Class' => $this->returnerGroupClass,
        //     'Return Date' => $this->returnDate,
        //     'Lab Member Return' => $this->labMemberReturn,
        //     'Staff Returner' => $this->staffReturner
        // ]);

        try {
            // dump(Carbon::createFromFormat('d/m/Y H:i', $this->returnDate." ".$this->returnTime)->toDateTimeString());
            // return;
            DB::beginTransaction();
            if ($this->isStaff) {
                $this->equipmentLoan->is_returner_staff = 1;
                $this->equipmentLoan->staff_id_returner = $this->staffReturner;
            } else {
                $this->equipmentLoan->is_returner_staff = 0;
                $this->equipmentLoan->returner_nim = $this->returnerNim;
                $this->equipmentLoan->returner_name = $this->returnerName;
                $this->equipmentLoan->returner_group_class = $this->returnerGroupClass;
            }
            $this->equipmentLoan->return_date = Carbon::createFromFormat('d/m/Y H:i', $this->returnDate." ".$this->returnTime)->toDateTimeString();
            $this->equipmentLoan->lab_member_id_return = Auth::user()->labMembers->firstWhere('laboratory_id', $this->equipmentLoan->laboratory_id)->id;
            $this->equipmentLoan->status = 2;
            
            $this->equipmentLoan->save();

            $loanDetailItems = collect($this->loanDetailItems);
            foreach ($this->equipmentLoan->loanDetails as $loanDetail) {
                // dump($loanDetailItems->firstWhere('loanDetailId', $loanDetail->id));
                $returnStockCard = StockCard::create([
                    'qty' => $loanDetail->qty,
                    'stock' => $loanDetail->labItem->stock,
                    'is_stock_in' => 1,
                    'description' => $loanDetail->description,
                    'system_description' => "Return stock from PracticumEquipmentLoan",
                    'lab_item_id' => $loanDetail->lab_item_id,
                    'lab_member_id' => Auth::user()->labMembers->firstWhere('laboratory_id', $this->equipmentLoan->laboratory_id)->id,
                ]);

                $loanDetail->return_qty = $loanDetailItems->firstWhere('loanDetailId', $loanDetail->id)['returnQty'];
                $loanDetail->stock_card_id_return = $returnStockCard->id;
                $loanDetail->status = $loanDetailItems->firstWhere('loanDetailId', $loanDetail->id)['returnQty'] < $loanDetail->qty? 2 : 1;
                $loanDetail->save();

                $loanDetail->labItem->stock = $loanDetail->labItem->stock + $loanDetail->return_qty;
                $loanDetail->labItem->save();

                // dump($returnStockCard, $loanDetail, $loanDetail->labItem);
                // dump("------------------------------");
            }

            // dd($this->equipmentLoan);

            DB::commit();
            return response()->json([
                'status' => "success",
                'message' => "Laporan peminjaman alat praktikum berhasil diubah"
            ]);
            DB::rollback();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return response()->json([
                'status' => "error",
                'message' => $e->getMessage()
            ]);
        }
    }

    public function redirectToIndex() {
        $this->redirectRoute('prac-equipment-loan', navigate: true);
    }

    public function mount($id) {
        try {
            $this->id = Crypt::decrypt($id);
            $this->equipmentLoan = EquipmentLoan::find($this->id)->load('mentor', 'staffBorrower', 'loanDetails');
            $this->labMemberReturn = Auth::user()->staff->id;
            $this->loanDetailItems = $this->equipmentLoan->loanDetails->map(function($detail) {
                return [
                    'loanDetailId' => $detail->id,
                    'returnQty' => 0
                ];
            });

        } catch (DecryptException $e) {
            return response()->json("error");
        }
    }

    public function render()
    {
        return view('livewire.pages.practicum-equipment-loan.borrow-return', [
            'lecturers' => Staff::with('user')->where('staff_status_id', 1)->get(), //dosen
            'staffs' => Staff::with('user')->get(), //staff
        ]);
    }
}
