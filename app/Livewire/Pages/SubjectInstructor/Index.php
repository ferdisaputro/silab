<?php

namespace App\Livewire\Pages\SubjectInstructor;

use Livewire\Component;

class Index extends Component
{
    public $listeners = ['setLecturer', 'setSubject'];

    public $selectedLecturer;
    public $selectedSubject;

    public function setSubject($subject) {
        // dd($subject);
        $this->selectedSubject = $subject;
    }

    public function setLecturer($lecturer) {
        // dd($lecturer);
        $this->selectedLecturer = $lecturer;
    }

    public function render()
    {
        return view('livewire.pages.subject-instructor.index');
    }
}
