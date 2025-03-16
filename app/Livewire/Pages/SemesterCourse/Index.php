<?php

namespace App\Livewire\Pages\SemesterCourse;

use App\Models\Course;
use Livewire\Component;
use App\Models\Semester;
use App\Models\Department;
use App\Models\AcademicYear;
use App\Models\StudyProgram;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $listeners = ["setSelectedCourses"];

    #[Validate('required|integer|exists:departments,id')]
    public $departmentId; // id of department table
    #[Validate('required|integer|exists:study_programs,id')]
    public $studyProgramId; // id of study program table
    #[Validate('required|integer|exists:academic_years,id')]
    public $academicYearId; // id of academic year table
    #[Validate('required|integer|exists:semesters,id')]
    public $semesterId; // id of semester table
    #[Validate('required|integer')]
    public $totalGroup;

    public $selectedCourses = [];

    #[Computed()]
    public function departments() {
        return Department::all();
    }

    #[Computed()]
    public function studyPrograms() {
        $department = Department::find($this->departmentId);
        return $department ? $department->studyPrograms()->get() : [];
    }

    #[Computed()]
    public function academicYears() {
        return AcademicYear::all();
    }

    #[Computed()]
    public function semesters() {
        $academicYear = AcademicYear::find($this->academicYearId);
        return $academicYear ? $academicYear->semesters()->get() : [];
    }

    #[Computed()]
    public function selectedCoursesList() {
        return Course::whereIn('code', $this->selectedCourses)->get()?? [];
    }

    public function setSelectedCourses(Array $courses) {
        $this->selectedCourses = $courses;
    }

    public function create() {
        $this->authorize('hasPermissionTo', 'setmatakuliah-create');

        $this->validate();
        try {
            DB::beginTransaction();

            $data = [];
            foreach ($this->selectedCoursesList() as $selectedCourse) {
                $data[] = [
                    'study_program_id' => $this->studyProgramId,
                    'semester_id' => $this->semesterId,
                    'course_id' => $selectedCourse->id,
                    'user_id' => Auth::user()->id,
                    'total_group' => $this->totalGroup,
                ];
            }

            Semester::find($this->semesterId)->semesterCourses()->createMany($data);

            DB::commit();
            $this->reset();

            return response()->json(['status' => 'success', 'message' => 'Mata Kuliah Semester berhasil dibuat']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function mount() {
        $this->authorize('hasPermissionTo', 'setmatakuliah-list');
    }

    public function render()
    {
        return view('livewire.pages.semester-course.index', [
            'courses' => Course::all()
        ]);
    }
}
