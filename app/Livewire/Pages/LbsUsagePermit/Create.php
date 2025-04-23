<?php

namespace App\Livewire\Pages\LbsUsagePermit;

use Livewire\Component;
use App\Models\Staff;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Throwable;
use Carbon\Carbon;
use App\Models\LabItem;
use App\Models\Laboratory;
use Illuminate\Support\Str;
use App\Models\EquipmentLoan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Crypt;



class Create extends Component
{
    // public string $id;

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
    public $startDate;
    #[Validate('required')]
    public $endDate;

    #[Validate('required|integer|exists:academic_years,id')]
    public $academicYearId; // id of academic year table
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
            'semester_course' => '', // semester_course
            'description' => '', // description
        ]
    ];

    // public function addItem($item, $stock, $qty, $tahun_ajaran, $description) {
    public function addItem() {
        $this->selectedItems[] = [
        'item' => '', // id of lab_item_id
        'stock' => '', // id stock
        'qty' => '', // qty
        'semester_course' => '', // semester_course
        'description' => '', // description
        ];
    }

    public function removeItem($index) {
        unset($this->selectedItems[$index]);
    }

    #[Computed()]
    public function labItems() {
        return Laboratory::find($this->laboratoryId?? null)->labItems->load('item');
    }

    #[Computed()]
    public function academicYears() {
        return AcademicYear::all();
    }

    public function redirectToIndex() {
        $this->redirectRoute('lbs-usage-permit', navigate: true);
    }

    public function mount($id)
    {
        if (Gate::allows('isALabMember', Auth::user())) {
            abort(404);
        }

        $decrypted = Crypt::decrypt($id);  // Decrypt the id here
        $this->laboratoryId = $decrypted;
        $this->labMemberIdBorrow = Auth::user()->staff->id;
        $this->code = Str::random(8);
    }


    public function render()
    {
        return view('livewire.pages.lbs-usage-permit.create', [
            'lecturers' => Staff::with('user')->where('staff_status_id', 1)->get(), //dosen
            'staffs' => Staff::with('user')->get(), //staff
            ]);
    }
}
