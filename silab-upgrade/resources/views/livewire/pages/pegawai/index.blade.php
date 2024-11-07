<div class="p-4 bg-white rounded-4">
    <div class="d-flex justify-content-between align-items-center">
        <span class="fs-5 fw-semibold">
            Table Data Pegawai
        </span>
        <a wire:navigate href="{{ route('pegawai.tambah') }}" class="btn btn-secondary btn-border rounded-3">Tambah Data</a>
    </div>

    <div>
        <table class="table table-striped" id="tabel-pegawai">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Gambar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>test</td>
                    <td>user</td>
                    <td>img</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>waeraw</td>
                    <td>admin</td>
                    <td>img</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


@pushOnce('scripts')
    @script
        <script>
            $wire.on('initialize-table', () => {
                $('#tabel-pegawai').DataTable();
            })
        </script>
        {{-- <script wire:ignore>
        </script> --}}
    @endscript
@endPushOnce
