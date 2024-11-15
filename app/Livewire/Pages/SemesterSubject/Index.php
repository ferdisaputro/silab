<?php

namespace App\Livewire\Pages\SemesterSubject;

use Livewire\Component;

class Index extends Component
{
    public $listeners = ["setSelectedSubjects"];
    public $selectedSubjects = [];
    public $subjects;

    public function setSelectedSubjects(Array $subjects) {
        $this->selectedSubjects = $subjects;
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

        $this->subjects = $dummyData;
    }

    public function render()
    {
        return view('livewire.pages.semester-subject.index');
    }
}
