<div>
    <x-data-table2 :data="$data" :model="$stoks">
        <x-slot name="head">
            <tr>
                <th>
                    #
                </th>
                <th><a wire:click.prevent="sortBy('namabarang')" role="button" href="#">
                    Nama Barang
                    @include('components.sort-icon', ['field' => 'namabarang'])
                </a></th>
                <th><a wire:click.prevent="sortBy('jumlah')" role="button" href="#">
                    Jumlah Stok
                    @include('components.sort-icon', ['field' => 'jumlah'])
                </a></th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($stoks as $key => $stok)
                <tr x-data="window.__controller.dataTableController({{ $stok->id }})">
                    <td>{{ $stoks->firstItem() + $key }}</td>
                    <td>{{ $stok->namabarang }}</td>
                    <td>{{ $stok->jumlah }}</td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table2>
</div>