<?php

namespace App\Livewire\Pages\ScheduleReplacement;

use Carbon\Carbon;
use App\Models\Staff;
use Livewire\Component;
use App\Models\Semester;
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
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    public $id;


    // #[Validate('required|exists:laboratories,id')]
    // public $laboratoryId;
    #[Validate('required|exists:staff,id')]
    public $selectedLecturer;

    #[Validate('required|date_format:d/m/Y')]
    public $realSchedule;
    #[Validate('required|date_format:H:i')]
    public $realScheduleTime;
    #[Validate('required|date_format:d/m/Y')]
    public $replacementSchedule;
    #[Validate('required|date_format:H:i')]
    public $replacementScheduleTime;


    #[Validate('required')]
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
        return Laboratory::onlyActiveUserMember()->get();
    }

    #[Computed()]
    public function department() {
        return Laboratory::find($this->selectedLaboratory)->department;
    }

    public $selectedStudyProgram;
    #[Computed()]
    public function studyPrograms() {
        return $this->department->studyPrograms;
    }

    public $selectedAcademicYear;
    #[Computed()]
    public function academicYears() {
        return AcademicYear::all();
    }

    public $selectedSemester;
    #[Computed()]
    public function semesters() {
        return Semester::where('academic_year_id', $this->selectedAcademicYear)->get();
    }

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

    public function edit() {
        // dd(Auth::user()->labMembers->firstWhere('laboratory_id', $this->selectedLaboratory));
        if (!Auth::user()->labMembers->firstWhere('laboratory_id', $this->selectedLaboratory)) {
            return response()->json([
                'status' => "error",
                'message' => "You are not authorized"
            ]);
        }

        $this->validate();
        try {
            DB::beginTransaction();
            $scheduleReplacement = ScheduleReplacement::find($this->id);
            $scheduleReplacement->real_schedule = Carbon::createFromFormat('d/m/Y H:i', $this->realSchedule." ".$this->realScheduleTime)->toDateTimeString();
            $scheduleReplacement->replacement_schedule = Carbon::createFromFormat('d/m/Y H:i', $this->replacementSchedule." ".$this->replacementScheduleTime)->toDateTimeString();
            $scheduleReplacement->lab_member_id = Auth::user()->labMembers->firstWhere('laboratory_id', $this->selectedLaboratory)->id;
            $scheduleReplacement->practicum_event = $this->practicumEvent;
            $scheduleReplacement->staff_id = $this->selectedLecturer;
            $scheduleReplacement->save();

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

    public function mount($id) {
        $this->authorize("hasPermissionTo", 'penggantian-praktek-edit');
        if (Gate::allows('isALabMember', Auth::user())) {
            abort(404);
        }
        try {
            $decrypted = Crypt::decrypt($id);
            $this->id = $decrypted;
            $scheduleReplacement = ScheduleReplacement::find($this->id);
            $this->realSchedule = date('d/m/Y', strtotime($scheduleReplacement->real_schedule));
            $this->realScheduleTime = date('H:i', strtotime($scheduleReplacement->real_schedule));
            $this->replacementSchedule = date('d/m/Y', strtotime($scheduleReplacement->replacement_schedule));
            $this->replacementScheduleTime = date('H:i', strtotime($scheduleReplacement->replacement_schedule));
            $this->practicumEvent = $scheduleReplacement->practicum_event;
            $this->selectedLecturer = $scheduleReplacement->staff_id;
            $this->selectedLaboratory = $this->laboratories()->find($scheduleReplacement->labMember->laboratory_id)->id;
        } catch (DecryptException $e) {
            $this->dispatch('error', ['message' => "Kesalahan load data, Refresh dan coba ulang"]);
        }
    }

    public function render()
    {
        return view('livewire.pages.schedule-replacement.edit', [
            'lecturers' => Staff::where("status", 1)->where('staff_status_id', 1)->get()->load('user'),
        ]);
    }
}
