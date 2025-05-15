<?php

namespace App\Livewire\Pages\PracticumEquipmentLoan;

use Throwable;
use Carbon\Carbon;
use App\Models\Staff;
use App\Models\LabItem;
use Livewire\Component;
use App\Models\Laboratory;
use Illuminate\Support\Str;
use App\Models\EquipmentLoan;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Crypt;

class Create extends Component
{
    #[Validate('required|string|max:12')] // VARCHAR(12) for unique code
    public $code;


    #[Validate('required|boolean')] // TINYINT(1) for boolean (0 or 1)
    public $isStaff;
    // variables if isStaff is true
    #[Validate('required_if:isStaff,1')] // BIGINT(20), nullable, foreign key
    public $staff; // selected staff id

    // variables if isStaff is false
    #[Validate('required_if:isStaff,0|max:255')] // VARCHAR(255) for the name
    public $name;
    #[Validate('required_if:isStaff,0|max:12')] // NIM field, optional, VARCHAR(255)
    public $nim;
    #[Validate('required_if:isStaff,0|max:255')] // Group class, optional, VARCHAR(255)
    public $groupClass;
    #[Validate('nullable|integer|exists:staff,id|required_if:isStaff,0')]
    public $mentor; // selected staff id for mentor

    // variables for borrowing
    #[Validate('required')] // DATETIME for borrowing date
    public $borrowingDate;
    #[Validate('required')]
    public $borrowingTime;
    // #[Validate('nullable|integer|exists:lab_members,id')] // BIGINT(20), nullable, foreign key
    // public $labMemberIdBorrow;

    // #[Validate('required|boolean')] // TINYINT(1) for boolean (0 or 1)
    // public $isReturnerStaff;

    // variable for returning
    // #[Validate('nullable')] // DATETIME for return date, nullable
    // public $returnDate;
    // #[Validate('nullable|integer|exists:lab_members,id')] // BIGINT(20), nullable, foreign key
    // public $labMemberIdReturn;

    // variables if the one who returning is staff
    // #[Validate('nullable|integer|exists:staff,id')] // BIGINT(20), nullable, foreign key
    // public $staffIdReturner;

    // variables if the one who returning is not staff
    // #[Validate('nullable|string|max:255')] // Returner name, optional, VARCHAR(255)
    // public $returnerName;
    // #[Validate('nullable|string|max:255')] // Returner NIM, optional, VARCHAR(255)
    // public $returnerNim;
    // #[Validate('nullable|string|max:255')] // Returner group class, optional, VARCHAR(255)
    // public $returnerGroupClass;

    #[Validate('required|integer|in:1,2')] // TINYINT(4) with specific values (1 or 2 for status). Is returned or not
    public $status = 1;

    #[Validate('required|integer|exists:laboratories,id')] // BIGINT(20), foreign key, not null
    public $laboratoryId;

    #[Validate([
        'selectedItems.*.item' => 'required',
        'selectedItems.*.qty' => 'required|integer|min:1'
    ])]
    public $selectedItems = [
        [
            'item' => '', // id of lab_item_id
            'stock' => '', // id stock
            'qty' => '', // qty
            'description' => '', // description
        ]
    ];

    // public function addItem($item, $stock, $qty, $tahun_ajaran, $description) {
    public function addItem() {
        $this->selectedItems[] = [
            'item' => '',
            'stock' => '',
            'qty' => '',
            'description' => '',
        ];
    }

    public function removeItem($index) {
        unset($this->selectedItems[$index]);
    }

    #[Computed()]
    public function labItems() {
        return Laboratory::find($this->laboratoryId?? null)->labItems->load('item');
    }

    public function create() {
        // dump(
        //     $this->borrowingDate." ".$this->borrowingTime,
        //     Carbon::createFromFormat('d/m/Y H:i', $this->borrowingDate." ".$this->borrowingTime)->toDateTimeString()
        // );
        // return;
        $this->validate();
        $data = [];
        $data['code'] = $this->code;
        $data['borrowing_date'] = Carbon::createFromFormat('d/m/Y H:i', $this->borrowingDate." ".$this->borrowingTime)->toDateTimeString();
        $data['status'] = 1;
        $data['laboratory_id'] = $this->laboratoryId;
        $data['lab_member_id_borrow'] = Auth::user()->labMembers->firstWhere('laboratory_id', $this->laboratoryId)->id;

        if ($this->isStaff) {
            $data['is_staff'] = 1;
            $data['staff_id'] = $this->staff;
        } else {
            $data['is_staff'] = 0;
            $data['nim'] = $this->nim;
            $data['name'] = $this->name;
            $data['group_class'] = $this->groupClass;
            $data['staff_id_mentor'] = $this->mentor;
        }

        $stockCards = collect($this->selectedItems)->map(function($item) {
            return [
                'qty' => $item['qty'],
                'stock' => $item['stock'],
                'is_stock_in' => 0,
                'description' => $item['description']?? null,
                'equipment_loan_id' => $equipmentLoan?? 1, // ?? 1 just temp data
                'lab_item_id' => $item['item'],
                'lab_member_id' => Auth::user()->labMembers->firstWhere('laboratory_id', $this->laboratoryId)->id,
            ];
        });

        try {
            DB::beginTransaction();

            $stockCardsResult = Auth::user()->labMembers->firstWhere("laboratory_id", $this->laboratoryId)->stockCards()->createMany($stockCards);

            $equipmentLoan = EquipmentLoan::create($data);

            $eqLoanDetail = collect($this->selectedItems)->map(function($item) use ($equipmentLoan, $stockCardsResult) {
                return [
                    'qty' => $item['qty'],
                    'description' => $item['description']?? null,
                    'equipment_loan_id' => $equipmentLoan->id, //  just temp data
                    'lab_item_id' => $item['item'],
                    'stock_card_id' => $stockCardsResult->firstWhere('lab_item_id', $item['item'])->id,
                ];
            });

            $eqLoanDetailResult = $equipmentLoan->loanDetails()->createMany($eqLoanDetail);

            foreach ($this->selectedItems as $item) {
                $labItem = LabItem::find($item['item']);
                $labItem->stock -= $item['qty'];
                $labItem->save();
            }

            // dump($stockCardsResult, $equipmentLoan, $eqLoanDetailResult);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Peminjaman alat praktikum berhasil dibuat'
            ]);

        } catch (Throwable $th) {
            DB::rollback();
            // dump($th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function redirectToIndex() {
        $this->redirectRoute('prac-equipment-loan', navigate: true);
    }

    public function mount($id){
        $this->authorize('hasPermissionTo', 'bonalat-create');
        if (Gate::allows('isALabMember', Auth::user())) {
            abort(404);
        }
        $decrypted = Crypt::decrypt($id);
        $this->laboratoryId = $decrypted;
        // $this->labMemberIdBorrow = Auth::user()->staff->id;
        $this->code = Str::random(8);
    }

    public function render()
    {
        return view('livewire.pages.practicum-equipment-loan.create', [
            'lecturers' => Staff::with('user')->where('staff_status_id', 1)->get(), //dosen
            'staffs' => Staff::with('user')->get(), //staff
        ]);
    }
}
