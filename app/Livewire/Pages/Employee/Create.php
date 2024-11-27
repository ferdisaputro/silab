<?php

namespace App\Livewire\Pages\Employee;

use App\Models\Role;
use Livewire\Component;
use App\Models\StaffStatus;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

class Create extends Component
{
    #[Validate('image|nullable|max:3072')]
    public $photo;

    // personal info
    #[Validate('min:5|nullable')]
    public $code;
    #[Validate('required|min:5')]
    public $name;
    #[Validate('min:5|numeric|nullable')]
    public $phone;

    // account info
    #[Validate('required')]
    public $status;
    #[Validate('required')]
    public $staff_statuses_id;
    #[Validate('required')]
    public $role;
    #[Validate('required|min:5|email')]
    public $email;
    // password
    #[Validate('required|confirmed')]
    public $password;
    #[Validate('required|min:5')]
    public $password_confirmation;

    public function submit_handler() {
        $this->validate();

        dd(
            $this->code,
            $this->name,
            $this->phone,
            $this->status,
            $this->staff_statuses_id,
            $this->role,
            $this->email,
            $this->photo,
            $this->password,
            $this->password_confirmation
        );
    }

    public function render()
    {
        return view('livewire.pages.employee.create', [
            'roles' => Role::all(),
            'staffStatuses' => StaffStatus::all(),
        ]);
    }
}
