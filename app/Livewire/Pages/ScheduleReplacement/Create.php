<?php

namespace App\Livewire\Pages\ScheduleReplacement;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Course;
use Livewire\Component;
use App\Models\Semester;
use App\Models\Department;
use App\Models\Laboratory;
use Illuminate\Support\Str;
use App\Models\AcademicYear;
use App\Models\StudyProgram;
use App\Models\SemesterCourse;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use App\Models\ScheduleReplacement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Crypt;

class Create extends Component
{
    #[Validate('required|exists:staff,id')]
    public $selectedLecturer;

    #[Validate('required|date_format:d/m/Y')]
    public $realSchedule;
    #[Validate('required|date_format:d/m/Y')]
    public $replacementSchedule;
    public $practicumEvent;

    // #[Computed()]
    // public function getSchedulesProperty()
    // {
    //     return ScheduleReplacement::all();
    // }

    #[Validate('required|exists:laboratories,id')]
    public $selectedLaboratory;
    #[Computed()]
    public function laboratories() {
        return Laboratory::whereIn('id', Auth::user()->labMembers->pluck('laboratory_id'))->get();
    }

    #[Computed()]
    public function department() {
        return Laboratory::find($this->selectedLaboratory)->department;
    }

    #[Validate('required|exists:study_programs,id')]
    public $selectedStudyProgram;
    #[Computed()]
    public function studyPrograms() {
        return $this->department->studyPrograms;
    }

    #[Validate('required|exists:academic_years,id')]
    public $selectedAcademicYear;
    #[Computed()]
    public function academicYears() {
        return AcademicYear::all();
    }

    #[Validate('required|exists:semesters,id')]
    public $selectedSemester;
    #[Computed()]
    public function semesters() {
        return Semester::where('academic_year_id', $this->selectedAcademicYear)->get();
    }

    #[Validate('required|exists:courses,id')]
    public $selectedCourse;
    #[Computed()]
    public function courses() {
        return SemesterCourse::where('semester_id', $this->selectedSemester)
                        ->where('study_program_id', $this->selectedStudyProgram)
                        ->get()->load('course')->pluck('course');
    }

    public function resetForm() {
        $this->reset();
    }

    public function redirectToIndex() {
        $this->redirectRoute('schedule-replacement', navigate: true);
    }

    public function create() {
        $this->validate();
        $headOfStudyProgram = StudyProgram::find($this->selectedStudyProgram)->headOfStudyPrograms->firstWhere('is_active', 1);

        $data = [
            'code' => Str::random(8),
            'practicum_event' => $this->practicumEvent,
            'real_schedule' => Carbon::createFromFormat('d/m/Y', $this->realSchedule)->toDateTimeString(),
            'replacement_schedule' => Carbon::createFromFormat('d/m/Y', $this->replacementSchedule)->toDateTimeString(),
            'head_of_study_program_id' => $headOfStudyProgram? $headOfStudyProgram->id : null,
            'lab_member_id' => Auth::user()->labMembers->firstWhere('laboratory_id', $this->selectedLaboratory)->id,
            'course_id' => $this->selectedCourse,
            'staff_id' => $this->selectedLecturer,
        ];

        try {
            DB::beginTransaction();
            ScheduleReplacement::create($data);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Data penggantian jadwal berhasil dibuat'
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function mount() {
        $this->authorize("hasPermissionTo", 'penggantian-praktek-create');
        if (Gate::allows('isALabMember', Auth::user())) {
            abort(404);
        }
        $this->selectedLaboratory = $this->laboratories()->first()->id;
    }

    public function render()
    {
        // dd($this->getSchedulesProperty());
        return view('livewire.pages.schedule-replacement.create',[
            'lecturers' => Staff::where("status", 1)->where('staff_status_id', 1)->get()->load('user'),
        ]);
    }
}
