<?php

namespace App\Livewire\Pages\SemesterSubject;

use Livewire\Component;

class Index extends Component
{
    public $listeners = ["setSelectedSubjects"];

    public $selectedSubjects = [

    ];

    public function setSelectedSubjects($subjects) {
        $this->selectedSubjects = collect($subjects)->map(fn($subject) => $subject);
        // dump($this->selectedSubjects);
    }

    public function render()
    {
        return view('livewire.pages.semester-subject.index');
    }
}
