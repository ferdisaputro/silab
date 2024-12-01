<?php

namespace App\Livewire\Pages\Employee;

use App\Models\User;
use App\Models\Staff;
use Livewire\Component;
use App\Models\StaffStatus;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    use WithFileUploads;

    #[Validate('image|nullable|max:3072')]
    public $photo;

    // personal info
    #[Validate('min:5|nullable')]
    public $code;
    #[Validate('required|min:3')]
    public $name;
    #[Validate('min:8|numeric|nullable|max_digits:15')]
    public $phone;

    // account info
    #[Validate('required')]
    public $status = 1;
    #[Validate('required')]
    public $staff_statuses_id = '1';
    // #[Validate('required')]
    public $role;
    #[Validate('required|email')]
    public $email;

    // password
    #[Validate('required|confirmed')]
    public $password;
    #[Validate('required|min:5')]
    public $password_confirmation;

    public function resetForm() {
        $this->reset();
    }

    public function create() {
        $this->validate();

        $user = null;
        $data = [
            'code' => $this->code,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'status' => $this->status,
        ];

        if ($this->photo) {
            try {
                $photoPath = $this->photo->store('public/uploads/images/photo-profiles');
                $data['photo'] = $photoPath;
            } catch (\Exception $e) {
                dd($e);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to upload photo',
                ]);
            }
        }

        try {
            DB::beginTransaction();
            $staff = Staff::create([
                'status' => $this->status,
                'staff_statuses_id' => $this->staff_statuses_id
            ]);

            $data['staff_id'] = $staff->id;
            $user = User::create($data);
            $user->assignRole(Role::find($this->role));

            $this->resetForm();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Employee created successfully',
            ]);
            // dump([
            //     'Photo' => $this->photo,
            //     'Code' => $this->code,
            //     'Name' => $this->name,
            //     'Phone' => $this->phone,
            //     'Status' => $this->status,
            //     'Staff Status' => $this->staff_statuses_id,
            //     'Role' => $this->role,
            //     'Email' => $this->email,
            //     'Password' => $this->password,
            //     'Password Confirmation' => $this->password_confirmation,
            // ]);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.pages.employee.create', [
            'roles' => Role::all(),
            'staffStatuses' => StaffStatus::all(),
        ]);
    }
}
