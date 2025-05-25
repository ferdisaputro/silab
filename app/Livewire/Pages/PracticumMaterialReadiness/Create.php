<?php

namespace App\Livewire\Pages\PracticumMaterialReadiness;

use App\Models\AcademicWeek;
use App\Models\AcademicYear;
use App\Models\Course;
use App\Models\CourseInstructor;
use App\Models\EquipmentLoan;
use App\Models\LabItem;
use App\Models\Laboratory;
use App\Models\PracticumReadiness;
use App\Models\Semester;
use App\Models\SemesterCourse;
use App\Models\Staff;
use App\Models\StudyProgram;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Termwind\Components\Dd;
use Illuminate\Support\Str;
use Throwable;

class Create extends Component
{
    // ======== Praticum_Readiness =======\
    #[Validate('required')]
    public $recomendation;
    #[Validate('required|string|max:12')] // VARCHAR(12) for unique code
    public $code;
    #[Validate('required')]
    public $borrowingDate;
    #[Validate('required|integer|exists:laboratories,id')] // BIGINT(20), foreign key, not null
    public $laboratoryId;

    #[Validate('nullable|integer|exists:staff,id')] // BIGINT(20), nullable, foreign key
    public $labMemberIdBorrow;

    // #[Validate('exists:staff,id')]
    // public $selectedLecturer;


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
        $department = Laboratory::find($this->laboratoryId)->department;
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

    #[Computed()]
    public function LabItems(){
        return Laboratory::find(id: $this->laboratoryId?? null)->labItems->load('item');
    }

    #[Validate('required:exists:course_instructors,id')]
    public $selectedCourseInstructor;
    #[Computed()]
    public function courseInstructor(){
        // return Staff::where("status", 1)->where('staff_status_id', 1)->get()->load('user');
        return SemesterCourse::firstWhere([
            'semester_id' => $this->selectedSemester,
            'study_program_id' => $this->selectedStudyProgram,
            'course_id' => $this->selectedCourse
        ])?->load('courseInstructor.staff.user')->courseInstructor?? null;
    }

    public $semesterCourse_Id;
    public function semesterCourse(){
        return SemesterCourse::where('study_program_id',$this->selectedStudyProgram)
                                ->where('semester_id',$this->selectedSemester)
                                ->where('course_id',$this->selectedCourse)->first()->id;
    }

    protected function getSemesterCourse(){
        $semesterCourse = SemesterCourse::firstWhere([
            'semester_id' => $this->selectedSemester,
            'study_program_id' => $this->selectedStudyProgram,
            'course_id' => $this->selectedCourse
        ]);
        return $semesterCourse;
    }

    public function create() {
        $this->validate();
        $data = [];
        if ($this->getSemesterCourse()->courseInstructor) {
            $data['course_instructor_id'] = $this->getSemesterCourse()->courseInstructor->id;
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Matakuliah ini belum memiliki dosen pengampu.'
            ]);
        }
        $data['recomendation'] = $this->recomendation;
        $data['date'] = Carbon::createFromFormat('d/m/Y', time: $this->borrowingDate)->toDateTimeString();
        // dd($this->semesterCourse(), $data['course_instructor_id']);
        $data['semester_course_id'] = $this->getSemesterCourse()->id;
        $data['staff_id'] = Auth::user()->staff->id;
        $data['lab_member_id'] = Auth::user()->labMembers->firstWhere('laboratory_id', $this->laboratoryId)->id;
        $data['laboratory_id'] = $this->laboratoryId;
        $data['academic_week_id'] = $this->selectedAcademicWeek;
        // dd($data);

        $stockCards = collect($this->selectedItems)->map(function($item) {
            return [
                'qty' => $item['qty'],
                'stock' => $item['stock'],
                'is_stock_in' => 0,
                'description' => $item['description']?? null,
                // 'practicum_readiness_id' => $practicum_readiness_id?? 1, // ?? 1 just temp data
                'lab_item_id' => $item['item'],
                'lab_member_id' => Auth::user()->labMembers->firstWhere('laboratory_id', $this->laboratoryId)->id,
            ];
        });

        try {
            DB::beginTransaction();

            $stockCardsResult = Auth::user()->labMembers->firstWhere("laboratory_id", $this->laboratoryId)->stockCards()->createMany($stockCards);

            $practicum_readiness_id = PracticumReadiness::create($data);

            $practicum_detail = collect($this->selectedItems)->map(function($item) use ($practicum_readiness_id, $stockCardsResult) {
                return [
                    'code' => $this->code,
                    'qty' => $item['qty'],
                    'description' => $item['description']?? null,
                    // 'practicum_readiness_id' => $practicum_readiness_id->id, //  just temp data
                    'lab_item_id' => $item['item'],
                    'stock_card_id' => $stockCardsResult->firstWhere('lab_item_id', $item['item'])->id,
                ];
            });

            // dd($practicum_detail);

            $practicum_detailResult = $practicum_readiness_id->pracMacs()->createMany($practicum_detail);

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

    // public function updatedSelectedItems() {
    //     dump($this->selectedItems);
    // }

    public $selectedItems = [
        [
            'item' => '',
            'stock' => '',
            'qty' => '',
            'description' => '',
        ]
    ];

    // public function addTestResult($bahan, $stok, $jumlah, $tahun_ajaran, $keterangan) {
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

    public function mount($id){
        $decrypted = Crypt::decrypt($id);
        $this->laboratoryId = $decrypted;
        $this->labMemberIdBorrow = Auth::user()->staff->id;
        $this->code = Str::random(8);
    }

    public function redirectToIndex() {
        $this->redirectRoute('prac-mat-ready', navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.practicum-material-readiness.create',[
            'Recomendations' => PracticumReadiness::all(),
            // 'lecturers' => Staff::where("status", 1)->where('staff_status_id', 1)->get()->load('user'), //dosen
        ]);
    }
}
