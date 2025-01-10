<?php

namespace App\Livewire\Pages\Department;

use App\Models\Staff;
use Livewire\Component;
use App\Models\Department;
use App\Models\HeadOfDepartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;

class Create extends Component
{
    #[Validate("required|min:3|unique:departments|max:8")]
    public $code;
    #[Validate("required|min:3")]
    public $department;
    public $headOfDepartment; // id of staff

    public function create() {
        $this->validate();

        try {
            DB::beginTransaction();
            $department = Department::create([
                'code' => $this->code,
                'department' => $this->department,
                'user_id' => Auth::user()->id
            ]);

            if ($this->headOfDepartment) {
                HeadOfDepartment::create([
                    'staff_id' => $this->headOfDepartment,
                    'department_id' => $department->id,
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

    public function render()
    {
        return view('livewire.pages.department.create', [
            'lecturers' => Staff::where('status', 1)->where("staff_status_id", 1)->with('user')->get()
        ]);
    }
}
