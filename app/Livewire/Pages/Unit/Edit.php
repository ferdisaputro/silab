<?php

namespace App\Livewire\Pages\Unit;

use App\Models\Unit; // Pastikan model Unit diimport
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public $unit;
    public $id;

    #[Validate('required|min:3')]
    public $editUnitName;

    #[On('initEditUnit')]
    public function initEditUnit($key) {
        try {
            $this->id = Crypt::decrypt($key);
        } catch (DecryptException $de) {
            return response()->json(['status' => 'error', 'message' => 'Invalid decryption key']);
        }

        try {
            if ($this->id) {
                $unit = Unit::findOrFail($this->id);
                $this->editUnitName = $unit->satuan;
            }
        } catch (DecryptException $de) {
            return response()->json(['status' => 'error', 'message' => 'Invalid decryption key']);
        }
    }

    public function edit() {
        $this->validate();
        try {
            $unit = Unit::findOrFail($this->id);
            $unit->satuan = $this->editUnitName;
            if ($unit->isDirty('satuan')) {
                $unit->update();
                return response()->json(['status' => 'success', 'message' => 'Data Permission Berhasil Diubahkan']);
            }
            return response()->json(['status' => 'info', 'message' => 'Tidak Ada Perubahan Data']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function render()
    {
        return view('livewire.pages.unit.edit');
    }
}
