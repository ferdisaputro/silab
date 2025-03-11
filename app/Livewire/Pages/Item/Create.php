<?php

namespace App\Livewire\Pages\Item;

use App\Models\Item;
use App\Models\ItemType;
use App\Models\Unit;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate('required|min:5')]
    public $item_name;
    #[Validate('min:3|nullable')]
    public $item_code;
    #[Validate('required|numeric')]
    public $quantity;
    #[Validate('min:5|nullable')]
    public $specification;
    #[Validate('min:5|nullable')]
    public $description;
    #[Validate('nullable')]
    public $user_id;
    #[Validate('nullable')]
    public $unit_id ;
    #[Validate('nullable')]
    public $item_type_id;
    // ====================
    public $satuan_barang ;
    public $satuanText;

    public function mount()
    {
        $this->authorize('hasPermissionTo', 'barang-create');

        $this->unit_id = ''; // Default kosong atau isi dengan ID tertentu
        $this->satuanText = $this->unit_id; // Menyinkronkan dengan unit_id
    }

    public function updatedUnitId($value)
    {
        $this->satuan_barang = Unit::find($value)->satuan ?? ''; // Ambil nama satuan berdasarkan ID
        $this->satuanText = $value; // Sinkronkan satuanText dengan ID yang dipilih
    }

    public function resetForm()
    {
        $this->reset();
    }

    // Submit form
    public function create()
    {
        $this->validate();
        try
        {
        $data = [
            'item_name' => $this->item_name,
            'item_code' => $this->item_code,
            'quantity' => $this->quantity,
            'specification' => $this->specification,
            'description' => $this->description,
            'user_id' => auth()->id(),
            'unit_id' => $this->unit_id,
            'item_type_id' => $this->item_type_id,
        ];
            Item::create($data);
            $this->reset();
            return response()->json(['message' => 'Izin berhasil dibuat!', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }

    public function render()
    {
        return view('livewire.pages.item.create', [
            'itemTypes' => ItemType::all(),
            'unitItems' => Unit::all(),
        ]);
    }
}
