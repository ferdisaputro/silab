<?php

namespace App\Livewire\Pages\Laboratory;

use App\Models\Staff;
use Livewire\Component;
use App\Models\Department;
use App\Models\Laboratory;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    public $id;

    #[Validate("nullable|min:3|max:30")]
    public $editCode;
    #[Validate("required|min:3|max:255")]
    public $editName;
    #[Validate("between:0,1")]
    public $editIsActive = 1;
    #[Validate("nullable|min:3|max:255")]
    public $editAcronym;
    #[Validate("nullable|min:3|max:255")]
    public $editColor;
    #[Validate("nullable|exists:departments,id")]
    public $editDepartment; // id of department
    #[Validate("nullable|exists:staff,id")]
    public $editLabLeader; // id of lab_members

    #[On('initEditLaboratory')]
    public function initEditLaboratory($key) {
        $this->reset();
        try {
            $decrypted = Crypt::decrypt($key);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            dump("Failed to decrypt key ".$e);
        }

        try {
            if ($this->id) {
                # code...
                $laboratory = Laboratory::findOrFail($this->id);
                $this->editCode = $laboratory->code?? '';
                $this->editName = $laboratory->name;
                $this->editIsActive = $laboratory->is_active;
                $this->editAcronym = $laboratory->acronym;
                $this->editColor = $laboratory->color?? '';
                $this->editDepartment = $laboratory->department_id?? '';
                $this->editLabLeader = $laboratory->members->firstWhere('is_lab_leader', 1)->staff_id?? '';
            }
        } catch (\Exception $e) {
            dump("Failed to receive data ".$e);
        }
    }

    public function edit() {
        $this->validate();
        try {
            DB::beginTransaction();
            $laboratory = Laboratory::findOrFail($this->id);
            $laboratory->code = !$this->editCode || $this->editCode == ''? null : $this->editCode;
            $laboratory->name = $this->editName;
            $laboratory->acronym = $this->editAcronym;
            $laboratory->color = !$this->editColor || $this->editColor == ''? null : $this->editColor;
            $laboratory->department_id = !$this->editDepartment || $this->editDepartment == ''? null : $this->editDepartment;
            $laboratory->user_id = Auth::user()->staff->id;

            // dd($laboratory);
            if ($this->editLabLeader || $this->editLabLeader !== '') {
                $laboratory->members()->updateOrCreate([
                    'staff_id' => $this->editLabLeader
                ], [
                    'is_lab_leader' => 1,
                    'is_active' => 1,
                    'staff_id' => $this->editLabLeader
                ]);
                $laboratory->members()->where('staff_id', '!=', $this->editLabLeader)->update(['is_lab_leader' => 0]);
                $laboratory->members()->where('staff_id', '!=', $this->editLabLeader)->whereHas('staff', function ($query) {
                    $query->where('staff_status_id', 1);
                })->update(['is_active' => 0]);
            } else {
                $laboratory->members()->update(['is_lab_leader' => 0]);
            }

            if ($laboratory->isDirty(['code', 'name', 'isActive', 'acronym', 'color', 'department_id'])) {
                $laboratory->update();
            }
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Data Laboratorium Berhasil Diubah']);
            // else  return response()->json(['status' => 'info', 'message' => 'Tidak ada perubahan']);
        } catch (\Exception $e) {
            DB::rollBack();
            dump($e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to update laboratory: ' . $e->getMessage()]);
        }
    }

    public function mount() {
        $this->authorize('hasPermissionTo', 'lab-edit');
    }

    public function render()
    {
        return view('livewire.pages.laboratory.edit', [
            'departments' => Department::get(),
            'lecturers' => Staff::where('staff_status_id', 1)->with('user')->get() //dosen
        ]);
    }
}
