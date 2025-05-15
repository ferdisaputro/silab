<?php

namespace App\Livewire\Pages\LbsUsagePermit;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use App\Models\Item;
use App\Models\Staff;
use App\Models\LabItem;
use App\Models\StockCard;
use App\Models\Laboratory;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use App\Models\LbsUsagePermit;
use App\Models\LbsUsagePermitDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Edit extends Component
{
    // #[Validate('required|string|max:12')] // VARCHAR(12) for unique code
    // public $code;
    #[Validate('required|boolean')] // TINYINT(1) for boolean (0 or 1)
    public $isStaff;
    // variables if isStaff is true
    #[Validate('required_if:isStaff,1')] // BIGINT(20), nullable, foreign key
    public $staff; // selected staff id

    // variables if the one who returning is staff
    #[Validate('nullable|integer|exists:staff,id')] // BIGINT(20), nullable, foreign key
    public $staffIdReturner;

    // variables if isStaff is false
    #[Validate('required_if:isStaff,0|max:255')] // VARCHAR(255) for the name
    public $name;
    #[Validate('required_if:isStaff,0|max:12')] // NIM field, optional, VARCHAR(255)
    public $nim;
    #[Validate('required_if:isStaff,0|max:255')] // Group class, optional, VARCHAR(255)
    public $groupClass;
    #[Validate('nullable|integer|exists:staff,id|required_if:isStaff,0')]
    public $mentor; // selected staff id for mentor

    // variables for starting
    #[Validate('required')] // DATETIME for starting date
    public $startingDate;
    #[Validate('required')]
    public $startingTime;
    // #[Validate('nullable|integer|exists:lab_members,id')] // BIGINT(20), nullable, foreign key
    // public $labMemberIdStart;

     #[Validate('nullable|integer|exists:lab_members,id')]
    public$labMemberId;

    // variables for ending
    #[Validate('required')] // DATETIME for ending date
    public $endingDate;
    #[Validate('required')]
    public $endingTime;

    public $id;
    public $pageType;
    public $lbsUsagePermit;

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


    public function staffs(){
        return Staff::all();
    }

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
        $this->lbsUsagePermit->nim = $this->nim;
        $this->lbsUsagePermit->name = $this->name;
        $this->lbsUsagePermit->group_class = $this->groupClass;
        $this->lbsUsagePermit->staff_id_mentor = $this->mentor;

        $stockCards = null;

        try {
            DB::beginTransaction();

            // update the LbsUsage
            if ($this->lbsUsagePermit->isDirty('nim', 'name', 'group_class', 'staff_id_mentor')) {
                $this->lbsUsagePermit->save();
            }

            // create stockCards for the deleted  item
            if (count($this->deleteItemList) > 0) {
                // creating the stockCards
                $stockCardDatas = [];
                foreach ($this->deleteItemList as $item) {
                    $stockCardDatas[] = [
                        'qty' => $item['qty'],
                        'stock' => $item['stock'],
                        'is_stock_in' => 0,
                        'description' => $item['description'] ?? null,
                        'lbs_usage_permit_id' => $lbsUsagePermit?? 1, // placeholder sementara
                        'lab_item_id' => $item['item'],
                        'lab_member_id_borrow' => Auth::user()->labMembers->firstWhere('laboratory_id', $this->laboratoryId)->id,
                    ];
                }
                $stockCards = StockCard::insert($stockCardDatas);


                // updating the stock in labItem based on deleted LoanDetail
                $deletedLbsDetails = LabItem::whereIn('id', collect($stockCardDatas)->pluck('lab_item_id'))->get()->load('item');
                foreach ($deletedLbsDetails as $deletedLbsItem) {
                    $deletedLbsItem->update([
                        'stock' => $deletedLbsItem->stock + collect($stockCardDatas)->firstWhere('lab_item_id', $deletedLbsItem->id)['qty']
                    ]);
                }


                // deleting the LbsUsageDetails based on $deletedLoanItems
                $LbsUsageDetail = $this->lbsUsagePermit->details->whereIn('lab_item_id', collect($this->deleteItemList)->pluck('item'))->each(function ($LbsUsageDetail) {
                    $LbsUsageDetail->stockCard->delete();
                    $LbsUsageDetail->delete();
                });

                // dd($stockCards, $deletedLoanDetails, $qeLoanDetail);
                dump(true);
            }

            foreach ($this->selectedItems as $item) {
                $LbsDetail = $this->lbsUsagePermit->details->firstWhere('lab_item_id', $item['item']);

                // if ($loanDetail && $loanDetail->stockCard) {
                if ($LbsDetail && $LbsDetail->stockCard) {
                    $oldQty = $LbsDetail->stockCard->qty;

                    $LbsDetail->stockCard->update(['qty' => $item['qty']]);

                    $LbsDetail->update([
                        'qty' => $item['qty'],
                        'description' => $item['description']
                    ]);

                    $LbsDetail->labItem->update([
                        'stock' => $LbsDetail->labItem->stock + ($oldQty - $item['qty']) // koreksi stok dengan selisih qty
                    ]);
                } else {
                    $stockCard = StockCard::create([
                        'qty' => $item['qty'],
                        'stock' => $item['stock'],
                        'is_stock_in' => 0,
                        'description' => $item['description'],
                        'lab_item_id' => $item['item'],
                        'lab_member_id' => Auth::user()->labMembers->firstWhere('laboratory_id', $this->lbsUsagePermit->laboratory_id)->id,
                    ]);
                    $createdLbsDetail = LbsUsagePermitDetail::create([
                        'qty' => $item['qty'],
                        'description' => $item['description'],
                        'lbs_usage_permit_id' => $this->lbsUsagePermit->id,
                        'lab_item_id' => $item['item'],
                        'stock_card_id' => $stockCard->id,
                    ]);

                    $createdLbsDetail->labItem->update([
                        'stock' => $createdLbsDetail->labItem->stock - $createdLbsDetail->qty
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'status' => "success",
                'message' => "Laporan ijin penggunaan LBS berhasil diubah"
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
        $this->redirectRoute('lbs-usage-permit', navigate: true);
    }

    public function mount($id, $type = "edit") {
        if (Gate::allows('isALabMember', Auth::user())) {
            abort(404);
        }
        try {
            $this->id = Crypt::decrypt($id);
            // $this->laboratoryId = Crypt::decrypt($labId);
            $this->pageType = $type;
            $lbs = LbsUsagePermit::find($this->id)->load('staffMentor', 'staffBorrower', 'details.labItem', 'details.unit', 'details.stockCard', 'laboratory.labItems.item');
            $this->name = $lbs->name;
            $this->nim = $lbs->nim;
            $this->groupClass = $lbs->group_class;
            $this->mentor = $lbs->staff_id_mentor;
            $this->lbsUsagePermit = $lbs;

            $this->selectedItems = $lbs->details->map(function($detail) {
                return [
                    'item' => $detail->lab_item_id,
                    'qty' => $detail->qty,
                    'stock' => $detail->stockCards ? $detail->stockCards->stock : 0, // safe fallback to 0
                    'description' => $detail->description,
                ];
            });


        } catch (DecryptException $e) {
            return response()->json("error");
        }
    }

    public function render()
    {
        return view('livewire.pages.lbs-usage-permit.edit', [
            'lecturers' => Staff::with('user')->where('staff_status_id', 1)->get(), //dosen
            'staffs' => Staff::with('user')->get(), //staff
        ]);
    }
}

