<?php

namespace App\Livewire\Pages\Laboratory;

use App\Models\Staff;
use Livewire\Component;
use App\Models\LabMember;
use App\Models\Laboratory;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Detail extends Component
{
    public $id;
    public $newTechnicians = [
    ];

    public $listeners = [
        'initDetailLaboratory',
        'addNewTechnician'
    ];

    #[Computed()]
    public function laboratory() {
        return Laboratory::find($this->id)->load('members', 'members.staff', 'members.staff.user', 'members.staff.staffStatus');
    }


    public function addNewTechnician($key) {
        try {
            $decrypted = Crypt::decrypt($key);
            $this->newTechnicians[] = Staff::find($decrypted);
        } catch (DecryptException $e) {
            return response()->json('error');
        }
    }

    public function removeNewTechnician($index) {
        unset($this->newTechnicians[$index]);
    }

    public function edit() {
        try {
            $laboratory = Laboratory::find($this->id);
            if ($laboratory) {
                foreach ($this->newTechnicians as $newTechnician) {
                    LabMember::updateOrCreate([
                        'staff_id' => $newTechnician->id, // newTechnician is a data from staff table,
                        'laboratory_id' => $laboratory->id
                    ], [
                        'is_active' => 1,
                        'staff_id' => $newTechnician->id,
                        'laboratory_id' => $laboratory->id,
                        'is_lab_leader' => 0
                    ]);
                }
                $this->newTechnicians = [];
                return response()->json(['status' => 'success', 'message' => 'Member Baru Berhasil Ditambahkan.']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Error dalam menambahkan data, refresh dan coba lagi.']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menambahkan prodi. Error: '.$th->getMessage()]);
        }
    }

    public function initDetailLaboratory($key) {
        $this->reset();
        try {
            $decrypted = Crypt::decrypt($key);
            $this->id = $decrypted;
        } catch (DecryptException $e) {
            return response()->json('error');
        }
    }

    public function removeMember($key) {
        try {
            $decrypted = Crypt::decrypt($key);
            LabMember::where('staff_id', $decrypted)->update([
                'is_active' => 0,
                'is_lab_leader' => 0
            ]);
            return response()->json(['status' => 'success', 'message' => 'Program Studi Berhasil Dihapus.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus prodi. Error: '.$th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.pages.laboratory.detail');
    }
}
