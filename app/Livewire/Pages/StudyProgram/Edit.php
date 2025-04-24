<?php

namespace App\Livewire\Pages\StudyProgram;

use App\Models\Staff;
use Livewire\Component;
use App\Models\Department;
use Livewire\Attributes\On;
use App\Models\StudyProgram;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    public $id;
    #[Validate('required|min:3')]
    public $editCode;
    #[Validate('required|min:3')]
    public $editStudyProgram;
    #[Validate("required|exists:departments,id")]
    public $editDepartment; // id of department
    #[Validate("required|exists:staff,id")]
    public $editHeadOfStudyProgram; // id of staff

    #[On('initEditStudyProgram')]
    public function initEditStudyProgram($key) {
        try {
            $decrypted = Crypt::decrypt($key);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            dump("Failed to decrypt key ".$e);
        }

        try {
            if ($this->id) {
                # code...
                $studyProgram = StudyProgram::findOrFail($this->id);
                $this->editCode = $studyProgram->code;
                $this->editStudyProgram = $studyProgram->study_program;
                $this->editDepartment = $studyProgram->department->id?? null;
                $this->editHeadOfStudyProgram = $studyProgram->headOfStudyPrograms->firstWhere('is_active', 1)->staff->user->id?? null;
            }
        } catch (\Exception $e) {
            dump("Failed to receive data ".$e);
        }
    }

    public function edit() {
        $this->validate();
        try {
            $studyProgram = StudyProgram::findOrFail($this->id);
            $studyProgram->code = $this->editCode;
            $studyProgram->study_program = $this->editStudyProgram;
            $studyProgram->department_id = $this->editDepartment;
            $studyProgram->user_id = Auth::user()->id;

            $headOfStudyProgram = $studyProgram->headOfStudyPrograms()->where('staff_id', $this->editHeadOfStudyProgram)->first();

            $studyProgram->headOfStudyPrograms()->update([
                'is_active' => 0
            ]);

            if ($headOfStudyProgram) {
                $studyProgram->headOfStudyPrograms()->updateOrCreate([
                    'staff_id' => $this->editHeadOfStudyProgram,
                    'study_program_id' => $studyProgram->id,
                ], [
                    'is_active' => 1,
                ]);
            } else {
                $studyProgram->headOfStudyPrograms()->create([
                    'staff_id' => $this->editHeadOfStudyProgram,
                    'study_program_id' => $studyProgram->id,
                    'is_active' => 1,
                ]);
            }

            // if ($studyProgram->isDirty(['code', 'studyProgram', 'user_id'])) {
            $studyProgram->save();
            return response()->json(['status' => 'success', 'message' => 'Data Program Studi Berhasil Diubah']);
            // }

            // return response()->json(['status' => 'info', 'message' => 'Tidak Ada Perubahan Data']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function mount() {
        $this->authorize('hasPermissionTo', 'jurusan-edit');
    }

    public function render()
    {
        return view('livewire.pages.study-program.edit', [
            'lecturers' => Staff::where('status', 1)->where("staff_status_id", 1)->with('user')->get(),
            'departments' => Department::get(),
        ]);
    }
}
