<?php

namespace App\Livewire\Pages\ScheduleReplacement;

use App\Models\Course;
use App\Models\ScheduleReplacement;
use App\Models\Semester;
use App\Models\Staff;
use App\Models\StudyProgram;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Create extends Component
{
    #[Computed()]
    public function getSchedulesProperty()
{
    return ScheduleReplacement::all();
}

    public function render()
    {
        // dd($this->getSchedulesProperty());
        return view('livewire.pages.schedule-replacement.create',[
            'Prodis' => StudyProgram::all(),
            'courses' => Course::all(),
            'semesters' => Semester::all(),
            'dosens' => Staff::where("status", 1)->get(),
        ]);
    }
}
