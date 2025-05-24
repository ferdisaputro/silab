<?php

namespace App\Livewire\Pages\HandoverPracticalResult;

use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Illuminate\Support\Str;


class CreateItem extends Component
{
    public $id;
    public $code;

    #[Computed()]
    public function Units(){
        return Unit::all();
    }
    public function create()
{
    $this->validate([
        'items.*.praktikum' => 'required|string|max:255',
        'items.*.description' => 'nullable|string',
        'items.*.satuan' => 'required|exists:units,id',
    ]);

    try {
        foreach ($this->items as $item) {
            Item::create([
                'item_name' => $item['praktikum'],
                'item_code' => $this->code,
                'quantity' => 0,
                'specification' => $item['description'],
                'unit_id' => $item['satuan'],
                'item_type_id' => 3,
                'is_active' => 0,
                'user_id' => auth()->id(),
            ]);
        }

        // Reset input tapi tetap generate code baru
        $this->items = [
            ['praktikum' => '', 'description' => '', 'satuan' => '']
        ];
        $this->code = Str::random(8);

        return response()->json([
            'message' => 'Data berhasil ditambahkan',
            'status' => 'success',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => $e->getMessage(),
            'status' => 'error',
        ]);
    }
}


public function mount(){
    $this->code = Str::random(8);

}

    public $items = [
        [
            'praktikum' => '',
            'description' => '',
            'satuan' => '',
        ]
    ];
    public function addBahanItem() {
        $this->items[] = [
            'praktikum' => '',
            'description' => '',
            'satuan' => '',
        ];
    }
    public function removeBahanItem($index) {
        unset($this->items[$index]);
    }
    public function render()
    {
        return view('livewire.pages.handover-practical-result.create-item');
    }
}
