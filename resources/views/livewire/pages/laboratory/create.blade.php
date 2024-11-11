<div>
    <form action="" x-ref='form'>
        <x-text.page-title class="mb-6">
            Tambah Data Laboratorium
        </x-text.page-title>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-forms.select name="jurusan" label="Pilih Jurusan">
                @for ($i = 1; $i <= 10; $i++)
                    <option value="jurusan-{{ $i }}">Jurusan - {{ $i }}</option>
                @endfor
            </x-forms.select>
            <x-forms.input name="kode_lab" label="Kode Laboratorium"></x-forms.input>
            <x-forms.input name="nama_lab" label="Nama Laboratorium"></x-forms.input>
            <x-forms.input name="singkatan_lab" label="Singkatan Laboratorium"></x-forms.input>
            <x-forms.input name="singkatan_lab" label="Singkatan Laboratorium" type="color"></x-forms.input>
            <x-forms.select name="ketua_lab" label="Pilih Ketua Lab">
                @for ($i = 1; $i <= 10; $i++)
                    <option value="ketua_lab-{{ $i }}">Ketua Lab - {{ $i }}</option>
                @endfor
            </x-forms.select>

            <div class="text-center md:col-span-2">
                <x-buttons.fill class="w-full max-w-xs">
                    Tambah
                </x-buttons.fill>
            </div>
        </div>
    </form>
</div>
