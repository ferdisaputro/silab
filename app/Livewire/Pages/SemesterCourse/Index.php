<?php

namespace App\Livewire\Pages\SemesterCourse;

use Livewire\Component;

class Index extends Component
{
    public $listeners = ["setSelectedCourses"];
    public $selectedCourses = [];
    public $courses;

    public function setSelectedCourses(Array $courses) {
        $this->selectedCourses = $courses;
    }

    public function mount() {
        $dummyData = [];

        for ($i = 1; $i <= 50; $i++) {
            $dummyData[] = [
                'id' => $i,
                'kode' => 'KODE' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'name' => 'Name ' . $i
            ];
        }

        $this->courses = $dummyData;
    }

    public function render()
    {
        return view('livewire.pages.semester-course.index');
    }
}
