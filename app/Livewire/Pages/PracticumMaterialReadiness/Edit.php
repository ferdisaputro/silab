<?php

namespace App\Livewire\Pages\PracticumMaterialReadiness;

use App\Models\AcademicWeek;
use App\Models\AcademicYear;
use App\Models\Course;
use App\Models\LabItem;
use App\Models\Laboratory;
use App\Models\PracticumReadiness;
use App\Models\PracticumReadinessDetail;
use App\Models\Semester;
use App\Models\SemesterCourse;
use App\Models\Staff;
use App\Models\StockCard;
use App\Models\StudyProgram;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $code;
    public $pracMat;
    public $recomendations;
    public $borrowingDate;
    public $id;
    // #[Validate('required|exists:study_programs,id')]
    public $selectedStudyProgram;
    #[Computed()]
    public function studyPrograms() {
        $department = Laboratory::find($this->Laboratory_id)->department;
        return $department ? $department->studyPrograms : collect();
    }
    public $selectedAcademicYear;
    #[Computed()]
    public function academicYears(){
        return AcademicYear::all();
    }
    public $selectedAcademicWeek;
    #[Computed()]
    public function academicWeeks(){
        return AcademicWeek::where('academic_year_id',$this->selectedAcademicYear)->get();
    }
    public $selectedSemester;
    #[computed()]
    public function semesters() {
        return Semester::where('academic_year_id', $this->selectedAcademicYear)->get();
    }
    public $selectedCourse;
    #[computed()]
    public function Courses() {
        return SemesterCourse::where('semester_id',$this->selectedSemester)
                        ->where('study_program_id',$this->selectedStudyProgram)
                        ->get()->load('course')->pluck('course');
    }

    // public $selectedLecturer;
    // #[Computed()]
    // public function lecturers(){
    //     return Staff::where("status", 1)->where('staff_status_id', 1)->get()->load('user');
    // }

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

    public $Laboratory_id;
    #[Computed()]
    public function LabItems(){
        return Laboratory::find(id: $this->Laboratory_id?? null)->labItems->load('item');
    }

public function mount($id) {
    try {
        $this->id = Crypt::decrypt($id);
        $pracMat = PracticumReadiness::find($this->id)->load('courseInstructor','semesterCourse.semester.academicYear','staff.user','academicWeek','pracMacs','pracMacs.labItem','laboratory');
        // dd($this->recomendations = $pracMat->recomendation);
        $this->Laboratory_id = $pracMat->laboratory_id;
        $this->selectedStudyProgram = $pracMat->semesterCourse->study_program_id;
        $this->selectedAcademicYear = $pracMat->semesterCourse->semester->academicYear->id;
        $this->selectedSemester = $pracMat->semesterCourse->semester_id;
        $this->selectedCourse = $pracMat->semesterCourse->course->id;
        $this->selectedCourseInstructor = $pracMat->course_instructor_id;
        $this->selectedAcademicWeek = $pracMat->academic_week_id;
        $this->borrowingDate = Carbon::parse($pracMat->date)->format('d/m/Y');
        $this->recomendations = $pracMat->recomendation;
        $this->pracMatUpdate = $pracMat;
        $this->code = Str::random(8);

        $this->selectedItems = $pracMat->pracMacs->map(function($item) {
            return [
                // 'id' => $item->id,
                'item' => $item->lab_item_id,
                'qty' => $item->qty,
                'stock' => $item->stockCard->stock,
                'description' => $item->description,
            ];
        })->toArray();


        } catch (DecryptException) {
            return response()->json("error");
        }
    }

    public $pracMatUpdate;
    protected function getSemesterCourse(){
        $semesterCourse = SemesterCourse::firstWhere([
            'semester_id' => $this->selectedSemester,
            'study_program_id' => $this->selectedStudyProgram,
            'course_id' => $this->selectedCourse
        ]);
        return $semesterCourse;
    }
    public function edit()
    {
        if ($this->getSemesterCourse()->courseInstructor) {
            $data['course_instructor_id'] = $this->getSemesterCourse()->courseInstructor->id;
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Matakuliah ini belum memiliki dosen pengampu.'
            ]);
        }
        $this->pracMatUpdate->recomendation = $this->recomendations;
        $this->pracMatUpdate->date = Carbon::createFromFormat('d/m/Y', $this->borrowingDate)->format('Y-m-d');
        $this->pracMatUpdate->staff_id = Auth::user()->staff->id;
        $this->pracMatUpdate->academic_week_id = $this->selectedAcademicWeek;
        $this->pracMatUpdate->semester_course_id = $this->getSemesterCourse()->id;
        // dd($this->recomendations);
        try {
            DB::beginTransaction();
            $this->pracMatUpdate->save();
            // dd($this->deleteItemList);

            if (count($this->deleteItemList) > 0) {
                // creating the stockCards
                $stockCardDatas = [];
                foreach ($this->deleteItemList as $item) {
                    $stockCardDatas[] = [
                        'qty' => $this->pracMatUpdate->pracMacs->firstWhere('lab_item_id', $item['item'])->qty,
                        'stock' => $item['stock'],
                        'is_stock_in' => 1,
                        'description' => 'stock in from deleted item in labItem(canceled loan item)',
                        'lab_item_id' => $item['item'],
                        'lab_member_id' => Auth::user()->staff->id,
                    ];
                }
                $stockCards = StockCard::insert($stockCardDatas);


                // updating the stock in labItem based on deleted LoanDetail
                $deletedPracMacs = LabItem::whereIn('id', collect($stockCardDatas)->pluck('lab_item_id'))->get()->load('item');
                foreach ($deletedPracMacs as $deletedPracMacsItem) {
                    $deletedPracMacsItem->update([
                        'stock' => $deletedPracMacsItem->stock + collect($stockCardDatas)->firstWhere('lab_item_id', $deletedPracMacsItem->id)['qty']
                    ]);
                }


                // deleting the equipmentLoanDetails based on $deletedLoanItems
                $qeLoanDetail = $this->pracMatUpdate->pracMacs->whereIn('lab_item_id', collect($this->deleteItemList)->pluck('item'))->each(function ($pracMatDetail) {
                    $pracMatDetail->stockCard->delete();
                    $pracMatDetail->delete();
                });
            }

            foreach ($this->selectedItems as $item) {
                $pracMacsDetail = $this->pracMatUpdate->pracMacs->firstWhere('lab_item_id', $item['item']);

                // if ($loanDetail && $loanDetail->stockCard) {
                if ($pracMacsDetail) {
                    $pracMacsDetail->stockCard->qty = $item['qty'];

                    $pracMacsDetail->update([
                        'qty' => $item['qty'],
                        'description' => $item['description']
                    ]);

                    $pracMacsDetail->labItem->update([
                        'stock' => $pracMacsDetail->stockCard->stock - $item['qty']
                    ]);
                } else {
                    $stockCard = StockCard::create([
                        'qty' => $item['qty'],
                        'stock' => $item['stock'],
                        'is_stock_in' => 0,
                        'description' => $item['description'],
                        'lab_item_id' => $item['item'],
                        'lab_member_id' => Auth::user()->labMembers->firstWhere('laboratory_id', $this->pracMatUpdate->laboratory_id)->id,
                    ]);
                    $createdPracMacsDetail = PracticumReadinessDetail::create([
                        // 'code' => $this->code,
                        'qty' => $item['qty'],
                        'description' => $item['description'],
                        'practicum_readiness_id' => $this->pracMatUpdate->id,
                        'lab_item_id' => $item['item'],
                        'stock_card_id' => $stockCard->id,
                    ]);

                    $createdPracMacsDetail->labItem->update([
                        'stock' => $createdPracMacsDetail->labItem->stock - $createdPracMacsDetail->qty
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

    public $deleteItemList = [];

    public $selectedItems = [
        [
            'item' => '',
            'stock' => '', // stok
            'qty' => '', // jumlah
            'description' => '', // keterangan
        ]
    ];

    // public function addTestResult($bahan, $stok, $jumlah, $tahun_ajaran, $keterangan) {
    public function addItem() {
        $this->selectedItems[] = [
            'item' => '',
            'stock' => '',
            'qty' => '',
            'description' => '',
            'is_new' => true
        ];
    }

    public function removeItem($index) {
        $this->deleteItemList[] = $this->selectedItems[$index];
        unset($this->selectedItems[$index]);
        if (count($this->selectedItems) == 0) {
            $this->selectedItems = [];
            $this->addItem();
        }
        // $this->selectedItems = array_values($this->selectedItems); // reindex biar rapi
    }

    public function redirectToIndex() {
        $this->redirectRoute('prac-mat-ready', navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.practicum-material-readiness.edit',[
            // 'recomendations' => PracticumReadiness::all()
        ]);
    }
}
