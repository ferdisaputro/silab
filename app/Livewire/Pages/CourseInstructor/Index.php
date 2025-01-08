<?php

namespace App\Livewire\Pages\CourseInstructor;

use App\Models\AcademicYear;
use App\Models\Course;
use App\Models\Department;
use App\Models\Semester;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    public $listeners = ['setLecturer', 'setCourse'];

    #[Validate('required|integer|exists:departments,id')]
    public $departmentId; // id of department table
    #[Validate('required|integer|exists:study_programs,id')]
    public $studyProgramId; // id of study program table
    #[Validate('required|integer|exists:academic_years,id')]
    public $academicYearId; // id of academic year table
    #[Validate('required|integer|exists:semesters,id')]
    public $semesterId; // id of semester table

    public $selectedLecturer;
    public $selectedCourse;

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
    public function semesterCourses() {
        $semester = Semester::find($this->semesterId);
        return $semester ? $semester->semesterCourses->where('study_program_id', $this->studyProgramId)->load('course') : [];
    }

    // public function setCourse($course) {
    //     $this->selectedCourse = $course;
    // }

    // public function setLecturer($lecturer) {
    //     $this->selectedLecturer = $lecturer;
    // }

    public function render()
    {
        return view('livewire.pages.course-instructor.index');
    }
}
