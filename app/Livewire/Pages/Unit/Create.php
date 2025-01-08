<?php

namespace App\Livewire\Pages\Unit;

use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate(rule: ['units.*.satuan' => 'required|min:3'], message: 'Unit name is required and must be at least 5 characters')]
    public $units = [
        ['satuan' => ''],
    ];

    public function updatedUnit() {
        $this->validate();
    }

    public function addUnit() {
        $this->units[] = ['satuan' => ''];
    }

    public function removeUnit($index) {
        unset($this->units[$index]);
    }

    public function create() {
        $this->validate();
        try {
            $user_id = Auth::id();

            $unit = array_map(function($unit) use ($user_id){
                return[
                    'satuan' => $unit['satuan'],
                    'user_id' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                    ];
            },$this->units);
            Unit::insert($unit);
            $this->reset('units');
            $this->units=[['satuan' => '']];
            return response()->json(['message' => 'Izin berhasil dibuat!', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }

    public function render()
    {
        return view('livewire.pages.unit.create');
    }
}
