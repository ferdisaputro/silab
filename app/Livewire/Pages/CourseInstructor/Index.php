<?php

namespace App\Livewire\Pages\CourseInstructor;

use Livewire\Component;

class Index extends Component
{
    public $listeners = ['setLecturer', 'setCourse'];

    public $selectedLecturer;
    public $selectedCourse;

    public function setCourse($course) {
        // dd($course);
        $this->selectedCourse = $course;
    }

    public function setLecturer($lecturer) {
        // dd($lecturer);
        $this->selectedLecturer = $lecturer;
    }

    public function render()
    {
        return view('livewire.pages.course-instructor.index');
    }
}
