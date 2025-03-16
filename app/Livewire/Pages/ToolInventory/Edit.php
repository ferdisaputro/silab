<?php

namespace App\Livewire\Pages\ToolInventory;

use App\Models\Item;
use App\Models\LabItem;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Edit extends Component
{
    public $id;
    public $labItem;
    public $lab_id = null;

    #[Validate('required|numeric')]
    public $editStockTool;
    #[Validate('nullable')]
    public $editItemIdTool;

    public $toolName;
    public $toolTopName;

    public function updatedEditTool($value)
    {
        $this->toolTopName = Item::find($value)->item_name ?? ''; // Ambil nama satuan berdasarkan ID
        $this->toolName= $value; // Sinkronkan satuanText dengan ID yang dipilih
    }


    #[On('initEditLabTool')]
    public function initEditLabTool($key) {
        try {
            $this->id = Crypt::decrypt($key);
            // dd($key);
        } catch (DecryptException $de) {
            return response()->json(['status' => 'error', 'message' => 'Invalid decryption key']);
        }

        try {
            if ($this->id) {
                $labTool = LabItem::findOrFail($this->id);
                $this->editItemIdTool = $labTool->item_id;
                $this->editStockTool = $labTool->stock;
                $this->toolTopName = $labTool->item->item_name;

            }
        } catch (DecryptException $de) {
            return response()->json(['status' => 'error', 'message' => 'Invalid decryption key']);
        }
    }

    public function edit() {
        $this->validate();
        try {
            $labTool = LabItem::findOrFail($this->id);
            $labTool->stock = $this->editStockTool;
            $labTool->item_id = $this->editItemIdTool;

            if ($labTool->isDirty('stock','item_id')) {
                $labTool->update();
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

    public function mount()
    {
        $this->authorize('hasPermissionTo', 'inventaris-alat-edit');
        $this->editItemIdTool = ''; // Default kosong atau isi dengan ID tertentu
        $this->toolName = $this->editItemIdTool; // Menyinkronkan dengan unit_id
    }

    public function render()
    {
        return view('livewire.pages.tool-inventory.edit',[
            'items' => Item::where("item_type_id", 1)->get(),
        ]);
    }
}
