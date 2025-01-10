<?php

namespace App\Livewire\Pages\Department;

use App\Models\Staff;
use Livewire\Component;
use App\Models\Department;
use Livewire\Attributes\On;
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
    public $editDepartment;
    public $editHeadOfDepartment;

    #[On('initEditDepartment')]
    public function initEditDepartment($key) {
        try {
            $decrypted = Crypt::decrypt($key);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            dump("Failed to decrypt key ".$e);
        }

        try {
            if ($this->id) {
                # code...
                $department = Department::findOrFail($this->id);
                $this->editCode = $department->code;
                $this->editDepartment = $department->department;
                $this->editHeadOfDepartment = $department->headOfDepartments->firstWhere('is_active', 1)->staff->user->id?? null;
            }
        } catch (\Exception $e) {
            dump("Failed to receive data ".$e);
        }
    }

    public function edit() {
        $this->validate();
        try {
            $department = Department::findOrFail($this->id);
            $department->code = $this->editCode;
            $department->department = $this->editDepartment;
            $department->user_id = Auth::user()->id;

            $headOfDepartment = $department->headOfDepartments()->where('staff_id', $this->editHeadOfDepartment)->first();

            $department->headOfDepartments()->update([
                'is_active' => 0
            ]);

            if ($headOfDepartment) {
                $department->headOfDepartments()->updateOrCreate([
                    'staff_id' => $this->editHeadOfDepartment,
                    'department_id' => $department->id,
                ], [
                    'is_active' => 1,
                ]);
            } else {
                $department->headOfDepartments()->create([
                    'staff_id' => $this->editHeadOfDepartment,
                    'department_id' => $department->id,
                    'is_active' => 1,
                ]);
            }

            // if ($department->isDirty(['code', 'department', 'user_id'])) {
            $department->save();
            return response()->json(['status' => 'success', 'message' => 'Data Jurusan Berhasil Diubah']);
            // }

            // return response()->json(['status' => 'info', 'message' => 'Tidak Ada Perubahan Data']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function render()
    {
        return view('livewire.pages.department.edit', [
            'lecturers' => Staff::where('status', 1)->where("staff_status_id", 1)->with('user')->get()
        ]);
    }
}
