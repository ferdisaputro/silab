<?php

namespace App\Livewire\Pages\MaterialInventory;

use App\Models\Item;
use App\Models\LabItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    // public $listeners = ['initEditMaterialInventory'];
    public $id;
    public $labItem;
    public $lab_id = null;

    #[Validate('required|numeric')]
    public $editStock;
    #[Validate('nullable')]
    public $editItemId;
    public $materialName;
    public $materialTopName;
    public function mount()
    {
        $this->editItemId = ''; // Default kosong atau isi dengan ID tertentu
        $this->materialName = $this->editItemId; // Menyinkronkan dengan unit_id
    }

    public function updatedEditTool($value)
    {
        $this->materialTopName = Item::find($value)->item_name ?? ''; // Ambil nama satuan berdasarkan ID
        $this->materialName= $value; // Sinkronkan satuanText dengan ID yang dipilih
    }


    #[On('initEditLabItem')]
    public function initEditLabItem($key) {
        try {
            $this->id = Crypt::decrypt($key);
            // dd($key);
        } catch (DecryptException $de) {
            return response()->json(['status' => 'error', 'message' => 'Invalid decryption key']);
        }

        try {
            if ($this->id) {
                $labItem = LabItem::findOrFail($this->id);
                $this->editItemId = $labItem->item_id;
                $this->editStock = $labItem->stock;
                $this->materialTopName = $labItem->item->item_name;

            }
        } catch (DecryptException $de) {
            return response()->json(['status' => 'error', 'message' => 'Invalid decryption key']);
        }
    }
    // public function mount($data) {
    //     $this->lab_id = $data;
    // }
    // public function
    public function edit() {
        $this->validate();
        try {
            $labItem = LabItem::findOrFail($this->id);
            $labItem->stock = $this->editStock;
            $labItem->item_id = $this->editItemId;

            if ($labItem->isDirty('stock','item_id')) {
                $labItem->update();
                $this->reset();
                return response()->json(['status' => 'success', 'message' => 'Data Permission Berhasil Diubahkan']);
            }
            return response()->json(['status' => 'info', 'message' => 'Tidak Ada Perubahan Data']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function resetForm()
{
    $this->reset();
}

    public function render()
    {
        return view('livewire.pages.material-inventory.edit',[
            'items' => Item::where("item_type_id", 2)->get(),
        ]);

    }
}
