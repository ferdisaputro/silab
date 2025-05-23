<?php

namespace App\Livewire\Pages\HandoverPracticalResult;

use App\Models\Item;
use App\Models\LabItem;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Illuminate\Support\Str;

class TablePracticumResult extends Component
{
    public $laboratoryId;
    public $code;

    // Array untuk menyimpan opsi per baris
    public $availableItemsPerRow = [];

    // Data form
    public $items = [
        ['praktikum' => '', 'jumlah' => '']
    ];

    public function mount($laboratoryId)
    {
        $this->laboratoryId = $laboratoryId;
        $this->code        = Str::random(8);
        // Inisialisasi opsi untuk baris pertama
        $this->availableItemsPerRow[0] = $this->getFilteredItems(0);
    }

    public function addBahanItem()
    {
        $index = count($this->items);
        $this->items[] = ['praktikum' => '', 'jumlah' => ''];
        // Buat opsi baru untuk row ini
        $this->availableItemsPerRow[$index] = $this->getFilteredItems($index);
    }

    public function removeBahanItem($index)
    {
        array_splice($this->items, $index, 1);
        array_splice($this->availableItemsPerRow, $index, 1);
    }

    // Helper untuk memfilter opsi di baris ke-$index
    protected function getFilteredItems(int $index)
    {
        $allItems = Item::where('item_type_id', 3)->get();

        // ID yang sudah dipilih di baris lain
        $selectedIds = collect($this->items)
            ->except($index)
            ->pluck('praktikum')
            ->filter()
            ->unique();

        // ID yang sudah tercatat di lab_items
        $labItemIds = LabItem::where('laboratory_id', $this->laboratoryId)
            ->pluck('item_id');

        return $allItems
            ->filter(fn($i) =>
                !$selectedIds->contains($i->id)
                && !$labItemIds->contains($i->id)
            )
            ->values(); // reindex
    }

    public function create()
    {
        $this->validate([
            'items.*.praktikum' => 'required|exists:items,id',
            'items.*.jumlah'    => 'required|integer|min:1',
        ]);

        try {
            foreach ($this->items as $item) {
                LabItem::create([
                    'code'          => $this->code,
                    'item_id'       => $item['praktikum'],
                    'stock'         => $item['jumlah'],
                    'laboratory_id' => $this->laboratoryId,
                    'is_active'     => 1,
                ]);

                // update stok master
                $master = Item::find($item['praktikum']);
                $master->quantity += $item['jumlah'];
                $master->save();
            }

            // reset form
            $this->items = [['praktikum' => '', 'jumlah' => '']];
            $this->availableItemsPerRow = [ $this->getFilteredItems(0) ];
            $this->code = Str::random(8);

            return response()->json(['message'=>'Berhasil','status'=>'success']);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(),'status'=>'error']);
        }
    }

    public function render()
    {
        return view('livewire.pages.handover-practical-result.table-practicum-result');
    }
}
