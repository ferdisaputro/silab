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
    public $code;
    #[Validate('required|min:3')]
    public $department;
    #[Validate("required|integer")]
    public $headOfDepartmentEdit;

    #[On('initEditDepartment')]
    public function initEditDepartment($key) {
        try {
            $decrypted = Crypt::decrypt($key);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            echo "<script>alert('Failed to decrypt key');</script>";
        }

        try {
            $department = Department::findOrFail($this->id);
            $this->code = $department->code;
            $this->department = $department->department;
            $this->headOfDepartmentEdit = $department->user_id;
            // dump($this->code, $this->department, $this->headOfDepartmentEdit);

            // this function is dispatching a script from x-forms.select
            $this->dispatch('setFormSelectedItem');
        } catch (\Exception $e) {
            echo "<script>alert('Failed to receive data');</script>";
        }
    }

    public function render()
    {
        return view('livewire.pages.department.edit', [
            'lecturers' => Staff::where("staff_status_id", 1)->with('user')->get()
        ]);
    }
}
