<?php

namespace App\Livewire\Pages\ToolInventory;

use App\Models\Item;
use App\Models\LabItem;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate('nullable')]
    public $code;
    #[Validate('required')]
    public $jumlah;
    #[Validate('required')]
    public $is_active = 1;

    #[Validate('nullable')]
    public $desc ;
    public $tool_id;

    public $lab_id ;

    // public $lab_id;

    // public function mount($lab_id)
    // {
    //     $this->lab_id = $lab_id; // Tangkap lab_id dari parameter URL
    // }

    public function create()
    {
        $this->validate();
        try
        {
        $data = [
            'laboratory_id' => $this->lab_id,
            'stock' => $this->jumlah,
            'item_id' => $this->tool_id,
            'is_active' => $this->is_active,
        ];
                LabItem::create($data);
                $this->reset();
            return response()->json(['message' => 'Izin berhasil dibuat!', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }

    public function mount($data) {
        $this->lab_id = $data;
    }
    public function resetForm()
{
    $this->reset();
}
    public function render()
    {
        return view('livewire.pages.tool-inventory.create',[
            'items' => Item::where("item_type_id", 1)->get(),
        ]);

    }
}
