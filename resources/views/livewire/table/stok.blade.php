<div>
    <x-data-table :data="$data" :model="$stoks">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('jumlah')" role="button" href="#">
                    Nama stok
                    @include('components.sort-icon', ['field' => 'jumlah'])
                </a></th>
                <th><a wire:click.prevent="sortBy('hargabeli')" role="button" href="#">
                    hargabeli
                    @include('components.sort-icon', ['field' => 'hargabeli'])
                </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($stoks as $stok)
                <tr x-data="window.__controller.dataTableController({{ $stok->id }})">
                    <td>{{ $stok->id }}</td>
                    <td>{{ $stok->hargabeli }}</td>
                    <td>{{ $stok->jumlah }}</td>
                    <td>{{ $stok->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/stok/edit/{{ $stok->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
