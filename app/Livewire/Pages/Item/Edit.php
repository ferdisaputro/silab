<?php

namespace App\Livewire\Pages\Item;

use App\Models\Item;
use App\Models\ItemType;
use App\Models\Unit;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Livewire\Attributes\Validate;

use function Livewire\Volt\mount;

class Edit extends Component
{
    public $item_id;
    public $id;
    public $item;
    // #[Validate('required|min:3')]
    public $editItemName;
    #[Validate('min:3|nullable')]
    public $editItemCode;
    #[Validate('required|numeric')]
    public $editQty;
    // #[Validate('min:5|nullable')]
    public $editSpec;
    // #[Validate('min:5|nullable')]
    public $editDesc;
    #[Validate('nullable')]
    public $editUnit ;
    #[Validate('nullable')]
    public $editType;
    // ====================
    public $satuan_barang ;
    public $satuanText;

    public function mount()
    {
        $this->authorize('hasPermissionTo', 'barang-edit');

        $this->editUnit = ''; // Default kosong atau isi dengan ID tertentu
        $this->satuanText = $this->editUnit; // Menyinkronkan dengan unit_id
    }

    public function updatedEditUnit($value)
    {
        $this->satuan_barang = Unit::find($value)->satuan ?? ''; // Ambil nama satuan berdasarkan ID
        $this->satuanText = $value; // Sinkronkan satuanText dengan ID yang dipilih
    }


    // public $listeners = ['initEditItem'];

    #[On('initEditItem')]
    public function initEditItem($key) {
        try {
            $this->id = Crypt::decrypt($key);
        } catch (DecryptException $de) {
            return response()->json(['status' => 'error', 'message' => 'Invalid decryption key']);
        }

        try {
            if ($this->id) {
                $item = Item::findOrFail($this->id);
                $this->editItemName = $item->item_name;
                $this->editItemCode = $item->item_code;
                $this->editQty = $item->quantity;
                $this->editSpec = $item->specification;
                $this->editDesc = $item->description;
                $this->editUnit = $item->unit_id;
                $this->editType = $item->item_type_id;
                $this->satuan_barang = $item->unit->satuan ?? '';
            }
        } catch (DecryptException $de) {
            return response()->json(['status' => 'error', 'message' => 'Invalid decryption key']);
        }
    }
    public function edit() {
        $this->validate();
        try {
            $item = Item::findOrFail($this->id);
            $item->item_code = $this->editItemCode;
            $item->item_name = $this->editItemName;
            $item->item_type_id = $this->editType;
            $item->unit_id = $this->editUnit;
            $item->specification = $this->editSpec;
            $item->description = $this->editDesc;
            $item->quantity = $this->editQty;
            if ($item->isDirty('item_name','item_code','quantity','specification','description','unit_id','item_type_id')) {
                $item->update();
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
        return view('livewire.pages.item.edit', [
            'itemTypes' => ItemType::all(),
            'unitItems' => Unit::all(),
        ]);

    }
}
