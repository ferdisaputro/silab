<div>
    <x-text.page-title class="mb-5">Ubah Jurusan</x-text.page-title>
{{-- x-data="ubahPegawai" x-on:submit.prevent="ubah" --}}
    <form wire:submit='submitHandle' class="space-y-4">
    <form action="">
        <x-forms.input wire:model.live.debounce="code" name="code" label="Kode Jurusan" value="{{ $code?? '' }}" />
        <x-forms.input wire:model.live.debounce="department" name="department" label="Nama Jurusan" value="{{ $department?? '' }}" />

        <x-forms.select-advanced model="headOfDepartmentEdit" name="headOfDepartmentEdit" label="Pilih Ketua Jurusan" wire:key='{{ now() }}'>
            @foreach ($lecturers as $lecturer)
                @if ($lecturer->user->id == $headOfDepartmentEdit)
                    <x-forms.option value="{{ $lecturer->user->id }}" selected="true">{{ $lecturer->user->name }}</x-forms.option>
                @else
                    <x-forms.option value="{{ $lecturer->user->id }}">{{ $lecturer->user->name }}</x-forms.option>
                @endif
            @endforeach
        </x-forms.select-advanced>

        <div class="text-center">
            <x-buttons.outline type="submit" class="w-full max-w-xs">Ubah</x-buttons.outline>
        </div>
    </form>
</div>
