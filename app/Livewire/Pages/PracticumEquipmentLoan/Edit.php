<?php

namespace App\Livewire\Pages\PracticumEquipmentLoan;

use App\Models\Item;
use App\Models\Staff;
use App\Models\LabItem;
use Livewire\Component;
use App\Models\StockCard;
use App\Models\EquipmentLoan;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use App\Models\EquipmentLoanDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

// #[Lazy()]
class Edit extends Component
{
    // #[Validate('required|string|max:12')] // VARCHAR(12) for unique code
    // public $code;

    // variables if isStaff is false
    #[Validate('required_if:isStaff,0|max:255')] // VARCHAR(255) for the name
    public $name;
    #[Validate('required_if:isStaff,0|max:12')] // NIM field, optional, VARCHAR(255)
    public $nim;
    #[Validate('required_if:isStaff,0|max:255')] // Group class, optional, VARCHAR(255)
    public $groupClass;
    #[Validate('nullable|integer|exists:staff,id|required_if:isStaff,0')]
    public $mentor; // selected staff id for mentor

    // variables if the one who returning is staff
    #[Validate('nullable|integer|exists:staff,id')] // BIGINT(20), nullable, foreign key
    public $staffIdReturner;

    public $id;
        public $pageType;
    public $equipmentLoan;


    #[Validate([
        'selectedItems.*.item' => 'required',
        'selectedItems.*.qty' => 'required|integer|min:1'
    ])]
    //item list for labItems
    public $selectedItems = [
        [
            'item' => '', // id of lab_item_id
            'stock' => '', // id stock
            'qty' => '', // qty
            'description' => '', // description
        ]
    ];
    // deleted item list for labItems
    public $deleteItemList = [];


    // public function addItem($item, $stock, $qty, $tahun_ajaran, $description) {
    public function addItem() {
        $this->selectedItems[] = [
            'item' => '',
            'stock' => '',
            'qty' => '',
            'description' => '',
            'new' => true
        ];
    }

    public function removeItem($index) {
        $this->deleteItemList[] = $this->selectedItems[$index];
        unset($this->selectedItems[$index]);
        if (count($this->selectedItems) == 0) {
            $this->selectedItems = [];
            $this->addItem();
        }
    }

    public function edit() {
        $this->equipmentLoan->nim = $this->nim;
        $this->equipmentLoan->name = $this->name;
        $this->equipmentLoan->group_class = $this->groupClass;
        $this->equipmentLoan->staff_id_mentor = $this->mentor;

        $stockCards = null;

        try {
            DB::beginTransaction();

            // update the equipmentloan
            if ($this->equipmentLoan->isDirty('nim', 'name', 'group_class', 'staff_id_mentor')) {
                $this->equipmentLoan->save();
            }

            // create stockCards for the deleted  item
            if (count($this->deleteItemList) > 0) {
                // creating the stockCards
                $stockCardDatas = [];
                foreach ($this->deleteItemList as $item) {
                    $stockCardDatas[] = [
                        'qty' => $this->equipmentLoan->loanDetails->firstWhere('lab_item_id', $item['item'])->qty,
                        'stock' => $item['stock'],
                        'is_stock_in' => 1,
                        'description' => 'stock in from deleted item in labItem(canceled loan item)',
                        'lab_item_id' => $item['item'],
                        'lab_member_id' => Auth::user()->staff->id,
                    ];
                }
                $stockCards = StockCard::insert($stockCardDatas);


                // updating the stock in labItem based on deleted LoanDetail
                $deletedLoanDetails = LabItem::whereIn('id', collect($stockCardDatas)->pluck('lab_item_id'))->get()->load('item');
                foreach ($deletedLoanDetails as $deletedLoanItem) {
                    $deletedLoanItem->update([
                        'stock' => $deletedLoanItem->stock + collect($stockCardDatas)->firstWhere('lab_item_id', $deletedLoanItem->id)['qty']
                    ]);
                }


                // deleting the equipmentLoanDetails based on $deletedLoanItems
                $qeLoanDetail = $this->equipmentLoan->loanDetails->whereIn('lab_item_id', collect($this->deleteItemList)->pluck('item'))->each(function ($equipmentLoanDetail) {
                    $equipmentLoanDetail->stockCard->delete();
                    $equipmentLoanDetail->delete();
                });
            }

            foreach ($this->selectedItems as $item) {
                $loanDetail = $this->equipmentLoan->loanDetails->firstWhere('lab_item_id', $item['item']);

                // if ($loanDetail && $loanDetail->stockCard) {
                if ($loanDetail) {
                    $loanDetail->stockCard->qty = $item['qty'];

                    $loanDetail->update([
                        'qty' => $item['qty'],
                        'description' => $item['description']
                    ]);

                    $loanDetail->labItem->update([
                        'stock' => $loanDetail->stockCard->stock - $item['qty']
                    ]);
                } else {
                    $stockCard = StockCard::create([
                        'qty' => $item['qty'],
                        'stock' => $item['stock'],
                        'is_stock_in' => 0,
                        'description' => $item['description'],
                        'lab_item_id' => $item['item'],
                        'lab_member_id' => Auth::user()->labMembers->firstWhere('laboratory_id', $this->equipmentLoan->laboratory_id)->id,
                    ]);
                    $createdLoanDetail = EquipmentLoanDetail::create([
                        'qty' => $item['qty'],
                        'description' => $item['description'],
                        'equipment_loan_id' => $this->equipmentLoan->id,
                        'lab_item_id' => $item['item'],
                        'stock_card_id' => $stockCard->id,
                    ]);

                    $createdLoanDetail->labItem->update([
                        'stock' => $createdLoanDetail->labItem->stock - $createdLoanDetail->qty
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'status' => "success",
                'message' => "Laporan peminjaman alat praktikum berhasil diubah"
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => "error",
                'message' => $e->getMessage()
            ]);
        }
    }

    public function redirectToIndex() {
        $this->redirectRoute('prac-equipment-loan', navigate: true);
    }

    public function mount($id, $type = "edit") {
        $this->authorize('hasPermissionTo', 'bonalat-edit');
        if (Gate::allows('isALabMember', Auth::user())) {
            abort(404);
        }
        try {
            $this->id = Crypt::decrypt($id);
            // $this->laboratoryId = Crypt::decrypt($labId);
            $this->pageType = $type;
            $eqLoan = EquipmentLoan::find($this->id)->load('mentor', 'staffBorrower', 'loanDetails');
            $this->name = $eqLoan->name;
            $this->nim = $eqLoan->nim;
            $this->groupClass = $eqLoan->group_class;
            $this->mentor = $eqLoan->staff_id_mentor;
            $this->equipmentLoan = $eqLoan;

            $this->selectedItems = $eqLoan->loanDetails->map(function($detail) {
                return [
                    'item' => $detail->lab_item_id,
                    'qty' => $detail->qty,
                    'stock' => $detail->stockCard->stock,
                    'description' => $detail->description,
                ];
            });

        } catch (DecryptException $e) {
            return response()->json("error");
        }
    }

    public function render()
    {
        return view('livewire.pages.practicum-equipment-loan.edit', [
            'lecturers' => Staff::with('user')->where('staff_status_id', 1)->get(), //dosen
            'staffs' => Staff::with('user')->get(), //staff
        ]);
    }
}
