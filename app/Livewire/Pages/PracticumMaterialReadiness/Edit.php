<?php

namespace App\Livewire\Pages\PracticumMaterialReadiness;

use App\Models\AcademicWeek;
use App\Models\AcademicYear;
use App\Models\Course;
use App\Models\Laboratory;
use App\Models\PracticumReadiness;
use App\Models\PracticumReadinessDetail;
use App\Models\Semester;
use App\Models\SemesterCourse;
use App\Models\Staff;
use App\Models\StudyProgram;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    public $selectedRecomendation;
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
    public $selectedLecturer;
    #[Computed()]
    public function lecturers(){
        return Staff::where("status", 1)->where('staff_status_id', 1)->get()->load('user');
    }
    public $Laboratory_id;
    #[Computed()]
    public function LabItems(){
        return Laboratory::find(id: $this->Laboratory_id?? null)->labItems->load('item');
    }

public function mount($id) {
    try {
        $this->id = Crypt::decrypt($id);
        $pracMat = PracticumReadiness::find($this->id)->load('courseInstructor','semesterCourse','academicWeek','pracMacs','laboratory');
        $this->Laboratory_id = $pracMat->laboratory_id;
        $this->selectedStudyProgram = $pracMat->semesterCourse->study_program_id;
        $this->selectedAcademicYear = $pracMat->semesterCourse->academicYear->id ?? null;
        $this->selectedSemester = $pracMat->semesterCourse->semester_id;
        $this->selectedCourse = $pracMat->courseInstructor->course_id;
        $this->selectedLecturer = $pracMat->courseInstructor->staff_id;
        $this->selectedAcademicWeek = $pracMat->academic_week_id;
        $this->borrowingDate = $pracMat->borrowing_date ? date('d/m/Y', strtotime($pracMat->borrowing_date)) : now()->format('d/m/Y');
        $this->selectedRecomendation = $pracMat->recomendation_id; // ganti sesuai kolom rekomendasi di database

        // Isi Alat dan Bahan
        $this->selectedItems = [];
        foreach ($pracMat->pracMacs as $pracMac) {
            $this->selectedItems[] = [
                'item' => $pracMac->lab_item_id,
                'stock' => $pracMac->labItem->stock ?? 0,
                'qty' => $pracMac->qty,
                'description' => $pracMac->description,
            ];
        }
        } catch (DecryptException $e) {
            return response()->json("error");
        }
    }
    public function edit()
{
    // Validasi data jika diperlukan
    $this->validate([
        'semester_course_id' => 'required|exists:study_programs,id',
        'academic_week_id' => 'required|exists:academic_years,id',
        'seme' => 'required|exists:semesters,id',
        'selectedCourse' => 'required|exists:courses,id',
        'selectedLecturer' => 'required|exists:staff,id',
        'selectedAcademicWeek' => 'required|exists:academic_weeks,id',
        'date' => 'required|date',
        'selectedRecomendation' => 'required|in:1,2,3,4',
        'selectedItems' => 'array',
    ]);

    // Mencari data Praktikum Readiness berdasarkan id
    $pracMat = PracticumReadiness::find($this->id);

    // Update data utama praktikum readiness
    $pracMat->recomendation = $this->selectedRecomendation;
    $pracMat->date = \Carbon\Carbon::createFromFormat('d/m/Y', $this->borrowingDate)->format('Y-m-d');
    $pracMat->course_instructor_id = $this->selectedLecturer;
    $pracMat->semester_course_id = $this->selectedSemester;
    $pracMat->staff_id = $this->selectedLecturer;
    $pracMat->lab_member_id = $this->selectedLabMember;  // Tambahkan input untuk lab_member jika diperlukan
    $pracMat->laboratory_id = $this->selectedLaboratory;  // Tambahkan input untuk laboratory jika diperlukan
    $pracMat->academic_week_id = $this->selectedAcademicWeek;

    // Simpan data Praktikum Readiness
    $pracMat->save();

    // Mengupdate atau menyimpan data praktikum readiness detail
    foreach ($this->selectedItems as $item) {
        PracticumReadinessDetail::updateOrCreate(
            ['id' => $item['id'] ?? null],  // Jika ada id, update data
            [
                'code' => $item['code'],
                'qty' => $item['qty'],
                'description' => $item['description'],
                'practicum_readiness_id' => $pracMat->id,  // Relasikan dengan practicum readiness yang baru
                'lab_item_id' => $item['item'],  // Pastikan ada item_id yang valid
                'stock_card_id' => $item['stock_card_id'],  // Pastikan ada stock_card_id yang valid
                'unit_id' => $item['unit_id'] ?? null,  // Jika unit_id tidak ada, bisa null
            ]
        );
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Data Kesiapan Bahan Praktikum berhasil diperbarui.'
    ]);
}


    public $selectedItems = [
        [
            'item' => '',
            'stok' => '', // stok
            'qty' => '', // jumlah
            'keterangan' => '', // keterangan
        ]
    ];

    // public function addTestResult($bahan, $stok, $jumlah, $tahun_ajaran, $keterangan) {
    public function addItem() {
        $this->selectedItems[] = [
            'item' => '',
            'stok' => '',
            'qty' => '',
            'keterangan' => '',
        ];
    }

    public function removeItem($index) {
        unset($this->selectedItems[$index]);
        $this->selectedItems = array_values($this->selectedItems); // reindex biar rapi
    }


    public function render()
    {
        return view('livewire.pages.practicum-material-readiness.edit',[
            'recomendations' => PracticumReadiness::all()
        ]);
    }
}
