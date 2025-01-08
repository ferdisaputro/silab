<?php

namespace App\Livewire\Pages\CourseInstructor;

use App\Models\AcademicYear;
use App\Models\Department;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public $listeners = ['setLecturer', 'setCourse'];

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

    public function setCourse($course) {
        $this->selectedCourse = $course;
    }

    public function setLecturer($lecturer) {
        $this->selectedLecturer = $lecturer;
    }

    public function render()
    {
        return view('livewire.pages.course-instructor.index');
    }
}
