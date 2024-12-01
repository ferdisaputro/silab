<?php

namespace App\Livewire\Pages\Employee;

use App\Models\User;
use App\Models\Staff;
use Livewire\Component;
use App\Models\StaffStatus;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    use WithFileUploads;

    public $listeners = ['initEditEmployee'];

    #[Locked]
    public $user_id;

    public $editPhoto;

    // personal info
    #[Validate('min:5|nullable')]
    public $editCode;
    #[Validate('required|min:3')]
    public $editName;
    #[Validate('min:8|numeric|nullable|max_digits:15')]
    public $editPhone;

    // account info
    #[Validate('required')]
    public $editStatus = 1;
    #[Validate('required')]
    public $editStaffStatusesId = '1';
    // #[Validate('required')]
    public $editRole;
    #[Validate('required|email')]
    public $editEmail;

    // password
    // #[Validate('confirmed')]
    // public $password;
    // #[Validate('min:5')]
    // public $password_confirmation;

    public function rules() {
        if (is_string($this->editPhoto)) {
            return [
                'editPhoto' => 'string',
            ];
        } else {
            return [
                'editPhoto' => 'image|nullable|max:3072',
            ];
        }
    }

    public function resetForm() {
        $this->reset();
    }

    public function edit() {
        $this->validate();

        $user = User::find($this->user_id);

        $user->staff->status = $this->editStatus;
        $user->staff->staff_statuses_id = $this->editStaffStatusesId;
        $user->code = $this->editCode;
        $user->name = $this->editName;
        $user->phone = $this->editPhone;
        $user->email = $this->editEmail;

        if ($this->editPhoto && !is_string($this->editPhoto)) {
            try {
                $photoPath = $this->editPhoto->store('public/uploads/images/photo-profiles');
                if ($user->photo) {
                    Storage::delete($user->photo);
                }
                $user->photo = $photoPath;
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
            $isStaffUpdated = false;
            $isUserUpdated = false;

            if ($user->staff->isDirty(['status', 'staff_statuses_id'])) {
                $user->staff->update();
                $isStaffUpdated = true;
            }
            if ($user->isDirty(['code', 'name', 'phone', 'email', 'photo'])) {
                $user->update();
                $isUserUpdated = true;
            }

            $user->syncRoles(Role::find($this->editRole));

            DB::commit();
            if ($isStaffUpdated || $isUserUpdated) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data pegawai berhasil diubah',
                ]);
            } else {
                return response()->json([
                    'status' => 'info',
                    'message' => 'Tidak ada data yang berubah',
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function initEditEmployee($key) {
        try {
            $id = Crypt::decrypt($key);
            $this->user_id = $id;
            $user = User::find($id);
            $this->editCode = $user->code;
            $this->editName = $user->name;
            $this->editPhone = $user->phone;
            $this->editEmail = $user->email;
            $this->editStatus = $user->staff->status;
            $this->editStaffStatusesId = $user->staff->staff_statuses_id;
            $this->editRole = $user->roles->first()->id?? null;
            $this->editPhoto = $user->photo;

            // dump($this->editCode, $this->editName, $this->editPhone, $this->editEmail, $this->editStatus, $this->editStaffStatusesId, $this->editRole, $this->editPhoto, $user);
        } catch (DecryptException $e) {
            dd($e);
            $this->dispatch('error', ['message' => "Kesalahan load data, Refresh dan coba ulang"]);
        }
    }

    public function render()
    {
        return view('livewire.pages.employee.edit', [
            'roles' => Role::all(),
            'staffStatuses' => StaffStatus::all(),
        ]);
    }
}
