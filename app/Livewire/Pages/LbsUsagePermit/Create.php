<?php

namespace App\Livewire\Pages\LbsUsagePermit;

use Livewire\Component;
use App\Models\Staff;
// use App\Models\AcademicYear;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Throwable;
use Carbon\Carbon;
use App\Models\LabItem;
use App\Models\Laboratory;
use App\Models\LbsUsagePermit;
use Illuminate\Support\Str;
// use App\Models\EquipmentLoan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Crypt;



class Create extends Component
{
    // public $id;
    public $selectedLab;

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
    #[Validate('required_if:isStaff,0|integer|exists:staff,id|nullable')]
    public $mentor;

    // #[Validate('nullable|integer|exists:staff,id|required_if:isStaff,0')]
    // public $mentor; // selected staff id for mentor

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
    // #[Validate('nullable|integer|exists:lab_members,id')] // BIGINT(20), nullable, foreign key
    // public $labMemberIdEnd;

    // #[Validate('required|exists:academic_years,id')]
    // public $academic_year; // id of academic year table
    #[Validate('required|integer|in:1,2')] // TINYINT(4) with specific values (1 or 2 for status). Is returned or not
    public $status = 1;

    #[Validate('required|integer|exists:laboratories,id')] // BIGINT(20), foreign key, not null
    public $laboratoryId;

    #[Validate([
        'selectedItems.*.item' => 'required',
        'selectedItems.*.qty' => 'required|integer|min:1',
    ])]
    public $selectedItems = [
        [
            'item' => '',
            'stock' => '',
            'qty' => '',
            // 'academic_year_id' => '',
            'description' => '',
        ]
    ];

    public function staffs(){
        return Staff::all();
    }

    // public function addItem($item, $stock, $qty, $tahun_ajaran, $description) {
    public function addItem() {
        $this->selectedItems[] = [
        'item' => '', // id of lab_item_id
        'stock' => '', // id stock
        'qty' => '', // qty
        // 'academic_year_id' => '',
        'description' => '', // description
        ];
    }

    public function removeItem($index) {
        array_splice($this->selectedItems, $index, 1);
    }


    #[Computed()]
    public function labItems() {
        $lab = Laboratory::find($this->laboratoryId);
        return $lab ? $lab->labItems->load('item') : collect();
    }

    public function create()
    {
        $this->validate();
        $data = [];
        $data['code'] = $this->code;
        $data['start_date'] = Carbon::createFromFormat('d/m/Y H:i', $this->startingDate . " " . $this->startingTime)->toDateTimeString();
        $data['end_date'] = Carbon::createFromFormat('d/m/Y H:i', $this->endingDate . " " . $this->endingTime)->toDateTimeString();
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

        $stockCards = collect($this->selectedItems)->map(function ($item) {
            return [
                'qty' => $item['qty'],
                'stock' => $item['stock'],
                'is_stock_in' => 0,
                'description' => $item['description'] ?? null,
                'lbs_usage_permit_id' => $lbsUsagePermit?? 1, // placeholder sementara
                'lab_item_id' => $item['item'],
                'lab_member_id_borrow' => Auth::user()->labMembers->firstWhere('laboratory_id', $this->laboratoryId)->id,
            ];
        });

        try {
            DB::beginTransaction();

            $stockCardsResult = Auth::user()->labMembers
                ->firstWhere("laboratory_id", $this->laboratoryId)
                ->stockCards()
                ->createMany($stockCards);

            $lbsUsagePermit = LbsUsagePermit::create($data); // ⬅️ BUAT DULU

            $lbsUsageDetail = collect($this->selectedItems)->map(function ($item) use ($lbsUsagePermit, $stockCardsResult) {
                return [
                    'qty' => $item['qty'],
                    'description' => $item['description'] ?? null,
                    'lbs_usage_permit_id' => $lbsUsagePermit->id,
                    'lab_item_id' => $item['item'],
                    'stock_card_id' => $stockCardsResult->firstWhere('lab_item_id', $item['item'])->id,
                ];
            });

            $lbsUsageDetailResult= $lbsUsagePermit->details()->createMany($lbsUsageDetail);

            foreach ($this->selectedItems as $item) {
                $labItem = LabItem::find($item['item']);
                $labItem->stock -= $item['qty'];
                $labItem->save();
            }

            DB::commit();

            return [
                'status' => 'success',
                'message' => 'Peminjaman alat praktikum berhasil dibuat.'
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e); // Untuk debugging
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }

    }


    // #[Computed()]
    // public function academicYears() {
    //     return AcademicYear::all();
    // }

    public function redirectToIndex() {
        $this->redirectRoute('lbs-usage-permit', navigate: true);
    }

    public function mount($id)
    {
        // dd($id);
        if (Gate::allows('isALabMember', Auth::user())) {
            abort(404);
        }

        $decrypted = Crypt::decrypt($id);
        $this->laboratoryId = $decrypted;
        $this->labMemberId = Auth::user()->staff->id;
        $this->code = Str::random(8);
    }



    public function render()
    {
        return view('livewire.pages.lbs-usage-permit.create', [
            'lecturers' => Staff::with('user')->where('staff_status_id', 1)->get(), //dosen
            'staffs' => Staff::with('user')->get(), //staff
            // 'labItems' => LabItem::with('item')->get(),
            ]);
    }
}
