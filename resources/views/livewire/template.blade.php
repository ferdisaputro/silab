<div>
    <div>
        <x-tables.datatable :data="{{-- data from model(pagination) --}}" eventTarget="{{-- folder name of this file --}}">
            {{-- data will receive a paginated data from class that will be used to make a pagination --}}
            <thead>
                <tr>
                    <th data-sortby="id">#</i></th> {{-- using data-sortby will automaticly make that column sortable --}}
                    <th>Foto</th>
                    <th data-sortby="name">Nama</i></th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </x-tables.datatable>
    </div>
</div>
