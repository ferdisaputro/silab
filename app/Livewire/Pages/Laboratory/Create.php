<?php

namespace App\Livewire\Pages\Laboratory;

use App\Models\Staff;
use Livewire\Component;
use App\Models\LabMember;
use App\Models\Department;
use App\Models\Laboratory;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    #[Validate("nullable|min:3|max:30")]
    public $code;
    #[Validate("required|min:3|max:255")]
    public $name;
    #[Validate("between:0,1")]
    public $isActive = 1;
    #[Validate("nullable|min:3|max:255")]
    public $acronym;
    #[Validate("nullable|min:3|max:255")]
    public $color;
    #[Validate("nullable|exists:departments,id")]
    public $department;
    #[Validate("nullable|exists:staff,id")]
    public $labLeader;

    public function create()
    {
        $this->validate();

        try {
            DB::beginTransaction();
            $laboratory = Laboratory::create([
                'code' => $this->code?? null,
                'name' => $this->name,
                'is_active' => $this->isActive,
                'acronym' => $this->acronym,
                'color' => $this->color?? null,
                'department_id' => $this->department?? null,
            ]);

            if ($this->labLeader) {
                LabMember::create([
                    'laboratory_id' => $laboratory->id,
                    'staff_id' => $this->labLeader,
                    'is_lab_leader' => 1,
                    'is_active' => 1,
                ]);
            }

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Laboratorium berhasil dibuat']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }

        dump($this->code, $this->name, $this->isActive, $this->acronym, $this->color, $this->department);
    }

    public function render()
    {
        return view('livewire.pages.laboratory.create', [
            // 'technicians' => Staff::where('staff_status_id', 3)->get() //teknisi
            'departments' => Department::get(),
            'lecturers' => Staff::where('staff_status_id', 1)->with('user')->get() //dosen
        ]);
    }
}
