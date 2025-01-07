<?php

namespace App\Livewire\Pages\Department;

use App\Models\Staff;
use Livewire\Component;
use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    public $id;
    #[Validate('required|min:3')]
    public $editCode;
    #[Validate('required|min:3')]
    public $editDepartment;
    #[Validate("required|integer")]
    public $editHeadOfDepartment;

    #[On('initEditDepartment')]
    public function initEditDepartment($key) {
        try {
            $decrypted = Crypt::decrypt($key);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            echo "<script>alert('Failed to decrypt key');</script>";
        }

        try {
            if ($this->id) {
                # code...
                $department = Department::findOrFail($this->id);
                $this->editCode = $department->code;
                $this->editDepartment = $department->department;
                $this->editHeadOfDepartment = $department->user_id;
            }
        } catch (\Exception $e) {
            echo "<script>alert('Failed to receive data');</script>";
        }
    }

    public function edit() {
        $this->validate();
        try {
            $department = Department::findOrFail($this->id);
            $department->code = $this->editCode;
            $department->department = $this->editDepartment;
            $department->user_id = $this->editHeadOfDepartment;
            if ($department->isDirty(['code', 'department', 'user_id'])) {
                $department->update();
                return response()->json(['status' => 'success', 'message' => 'Data Jurusan Berhasil Diubah']);
            }
            return response()->json(['status' => 'info', 'message' => 'Tidak Ada Perubahan Data']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function render()
    {
        return view('livewire.pages.department.edit', [
            'lecturers' => Staff::where("staff_status_id", 1)->with('user')->get()
        ]);
    }
}
