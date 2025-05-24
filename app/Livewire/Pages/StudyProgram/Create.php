<?php

namespace App\Livewire\Pages\StudyProgram;

use App\Models\Staff;
use Livewire\Component;
use App\Models\Department;
use App\Models\StudyProgram;
use Livewire\Attributes\Validate;
use App\Models\HeadOfStudyProgram;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    #[Validate("required|min:3|unique:study_programs|max:32")]
    public $code;
    #[Validate("required|min:3")]
    public $studyProgram;
    #[Validate("required|exists:departments,id")]
    public $department; // id of department
    #[Validate("required|exists:staff,id")]
    public $headOfStudyProgram; // id of staff

    public function create() {
        $this->validate();

        try {
            DB::beginTransaction();
            $studyProgram = StudyProgram::create([
                'code' => $this->code,
                'study_program' => $this->studyProgram,
                'user_id' => Auth::user()->id,
                'department_id' => $this->department ?? null
            ]);

            if ($this->headOfStudyProgram) {
                HeadOfStudyProgram::create([
                    'staff_id' => $this->headOfStudyProgram,
                    'study_program_id' => $studyProgram->id,
                    'is_active' => 1,
                ]);
            }
            DB::commit();
            $this->reset();
            return response()->json(['status' => 'success', 'message' => 'Jurusan berhasil dibuat']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Gagal membuat jurusan: ' . $e->getMessage()]);
        }
    }

    public function mount() {
        $this->authorize('hasPermissionTo', 'jurusan-create');
    }

    public function render()
    {
        return view('livewire.pages.study-program.create', [
            'lecturers' => Staff::where('status', 1)->where("staff_status_id", 1)->with('user')->get(),
            'departments' => Department::get(),
        ]);
    }
}
