<div>
    <x-data-table :data="$data" :model="$barangs">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('namabarang')" role="button" href="#">
                    Nama Barang
                    @include('components.sort-icon', ['field' => 'namabarang'])
                </a></th>
                <th><a wire:click.prevent="sortBy('keterangan')" role="button" href="#">
                    Keterangan
                    @include('components.sort-icon', ['field' => 'keterangan'])
                </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($barangs as $barang)
                <tr x-data="window.__controller.dataTableController({{ $barang->id }})">
                    <td>{{ $barang->id }}</td>
                    <td>{{ $barang->namabarang }}</td>
                    <td>{{ $barang->keterangan }}</td>
                    <td>{{ $barang->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/barang/edit/{{ $barang->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
