<?php

namespace App\Livewire\Pages\HandoverPracticalResult;

use App\Models\AcademicWeek;
use App\Models\AcademicYear;
use App\Models\CourseInstructor;
use App\Models\LabItem;
use App\Models\Laboratory;
use App\Models\practicumLeftOver;
use App\Models\PracticumResult;
use App\Models\PracticumResultHandover;
use App\Models\Semester;
use App\Models\SemesterCourse;
use App\Models\Staff;
use App\Models\Unit;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Throwable;

use function Livewire\Volt\computed;

class Create extends Component
{
    public $practicumEvent;
    public $code;
    #[validate('required')]
    public $handOverDate;
    #[Validate('required|integer|exists:laboratories,id')]
    public $laboratoryId;

    #[Validate('required|exists:academic_years,id')]
    public $selectedAcademicYear;
    #[Computed()]
    public function academicYears() {
        return AcademicYear::all();
    }
    #[Validate('required|exists:academic_weeks,id')]
    public $selectedAcademicWeek;
    #[Computed()]
    public function academicWeeks() {
        return AcademicWeek::where('academic_year_id',$this->selectedAcademicYear)->get();
    }
    #[Validate('required|exists:semesters,id')]
    public $selectedSemester;
    #[Computed()]
    public function semesters() {
        return Semester::where('academic_year_id', $this->selectedAcademicYear)->get();
        // return Semester::all();
    }
    #[Validate('required|exists:study_programs,id')]
    public $selectedStudyProgram;
    #[Computed()]
    public function studyPrograms() {
        $department = $this->laboratory->department;
        return $department ? $department->studyPrograms : collect(); // Jika department ada, ambil study programs, jika tidak, return koleksi kosong
    }
    #[Validate('required|exists:courses,id')]
    public $selectedCourse;
    #[Computed()]
    public function Courses() {
        return SemesterCourse::where('semester_id',$this->selectedSemester)
                        ->where('study_program_id',$this->selectedStudyProgram)
                        ->get()->load('course')->pluck('course');
    }
    public $selectedLecturer;
    #[Computed()]
    public function lectures(){
        return Staff::where("status", 1)->where('staff_status_id', 1)->get()->load('user');
    }

    #[Computed()]
    public function laboratory()
    {
        // Only eager load labItems with their item relation
        return Laboratory::with('labItems.item')->find($this->laboratoryId ?? null);
    }

    public function labMaterials()
    {
        // Use loaded relation to avoid extra queries
        if (!$this->laboratory) {
            return collect();
        }
        return $this->laboratory->labItems
            ->filter(fn($labItem) => $labItem->item && $labItem->item->item_type_id == 2)
            ->values();
    }

    public function labPracticums()
    {
        // Use loaded relation to avoid extra queries
        if (!$this->laboratory) {
            return collect();
        }
        return $this->laboratory->labItems
            ->filter(fn($labItem) => $labItem->item && $labItem->item->item_type_id == 3)
            ->values();
    }

    #[computed()]
    public function units(){
        return Unit::all();
    }
    #[computed()]
    public function practicumHandResults(){
        return PracticumResult::with('labItems.item')->get();
    }
    protected function getSemesterCourse(){
        $semesterCourses = SemesterCourse::firstWhere([
            'semester_id' => $this->selectedSemester,
            'study_program_id' => $this->selectedStudyProgram,
            'course_id' => $this->selectedCourse
        ]);
        return $semesterCourses;
    }

    public function create() {
        $this->validate();
        $data = [];
        $data['code'] = $this->code;
        $data['practicum_event'] = $this->practicumEvent;
        $data['date'] = Carbon::createFromFormat('d/m/Y',  $this->handOverDate)->toDateTimeString();
        $data['course_instructor_id'] = $this->getSemesterCourse()->courseInstructor->id;
        $data['academic_week_id'] = $this->selectedAcademicWeek;
        $data['laboratory_id'] = $this->laboratoryId;
        $data['lab_member_id'] = Auth::user()->labMembers->firstWhere('laboratory_id', $this->laboratoryId)->id;

        $stockCardsLeftOver = collect($this->materialItems)->map(function($item) {
            return [
                'qty' => $item['qty'],
                'stock' => labItem::find($item['material'])->item->unit_id, // ambil nilai stock dari LabItem tanpa menjumlahkan
                'is_stock_in' => 1,
                'description' => $item['description'] ?? null,
                'lab_item_id' => $item['material'],
                'lab_member_id' => Auth::user()
                    ->labMembers
                    ->firstWhere('laboratory_id', $this->laboratoryId)?->id,
            ];
        });

        $stockCardsResults = collect($this->practicumResults)->map(function($practicum_result) {
            $labItem = LabItem::find($practicum_result['pracRes']); // ambil lab item berdasarkan ID material
            return [
                'qty' => $practicum_result['qty'],
                'stock' => LabItem::find($practicum_result['pracRes'])->item->unit_id, // ambil nilai stock dari LabItem tanpa menjumlahkan
                'is_stock_in' => 1,
                'description' => $practicum_result['description']?? null,
                'lab_item_id' => $practicum_result['pracRes'],
                'lab_member_id' => Auth::user()->labMembers->firstWhere('laboratory_id', $this->laboratoryId)->id,
            ];
        });


        try {
            DB::beginTransaction();

            $stockCardsLeftOverResult = Auth::user()->labMembers->firstWhere("laboratory_id", $this->laboratoryId)->stockCards()->createMany($stockCardsLeftOver);
            $stockCardsResult = Auth::user()->labMembers->firstWhere("laboratory_id", $this->laboratoryId)->stockCards()->createMany($stockCardsResults);

            $practicum_result_leftover_handover= PracticumResultHandover::create($data);

            $practicum_leftover = collect($this->materialItems)->map(function($item) use ($practicum_result_leftover_handover, $stockCardsLeftOverResult) {
                return [
                    'code' => $this->code,
                    'qty' => $item['qty'],
                    'lab_item_id' => $item['material'],
                    // 'practicum_result_leftover_handover_id' => $practicum_result_leftover_handover->id,
                    'unit_id' => $item['unit'],
                    'stock_card_id' => $stockCardsLeftOverResult->firstWhere('lab_item_id', $item['material'])->id,
                ];
            });
            $practicum_result = collect($this->practicumResults)->map(function($practicum_result) use ($practicum_result_leftover_handover, $stockCardsResult) {
                return [
                    'code' => $this->code,
                    'qty' => $practicum_result['qty'],
                    'description' => $practicum_result['description'] = "new",
                    // 'practicum_result_leftover_handover_id' => $practicum_result_leftover_handover->id,
                    'lab_item_id' => $practicum_result['pracRes'],
                    'stock_card_id' => $stockCardsResult->firstWhere('lab_item_id', $practicum_result['pracRes'])->id,
                ];
            });
            // dd($practicum_leftover->toArray());
            // dd($practicum_result->toArray());
            // dd($practicum_leftover);

            $practicum_handover_leftover = $practicum_result_leftover_handover->practicumResultLeftOver()->createMany($practicum_leftover);
            $practicum_handover_result = $practicum_result_leftover_handover->practicumResult()->createMany($practicum_result);
            // dd($practicum_handover_leftover);

            foreach ($this->practicumResults as $result) {
                $labItem = LabItem::find($result['pracRes']);
                $labItem->stock += $result['qty'];
                $labItem->save();
            }

            foreach ($this->materialItems as $item) {
                $labItem = LabItem::find($item['material']);
                $labItem->stock += $item['qty'];
                $labItem->save();
            }

            // dump($stockCardsResult, $equipmentLoan, $eqLoanDetailResult);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Peminjaman alat praktikum berhasil dibuat'
            ]);

        } catch (Exception $th) {
            DB::rollback();
            dd($th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function redirectToIndex() {
        $this->redirectRoute('handover-practical-result', navigate: true);
    }

    public $materialItems = [
        [
            // 'id'
            'material' => '',
            'qty' => '',
            'unit' => '',
        ]
    ];
    public function addMaterialItem() {
        $this->materialItems[] = [
            'material' => '',
            'qty' => '',
            'unit' => '',
        ];
    }
    public function removeMaterialItem($index) {
        unset($this->materialItems[$index]);
    }

    public $practicumResults = [
        [
            'pracRes' => '',
            'qty' => '',
        ]
    ];

    public function addPracticumResult() {
        $this->practicumResults[] = [
            'pracRes' => '',
            'qty' => '',
        ];
    }
    public function removePracticumResult($index) {
        unset($this->practicumResults[$index]);
    }

    public function mount($id){
        $decrypted = Crypt::decrypt($id);
        $this->laboratoryId = $decrypted;
        $this->code = Str::random(8);
    }


    public function render()
    {
        // dd($this->labPracticums(), $this->labMaterials());
        return view('livewire.pages.handover-practical-result.create', [
            'labPracticums' => $this->labPracticums(),
            'labMaterials' => $this->labMaterials(),
        ]);

    }
}
