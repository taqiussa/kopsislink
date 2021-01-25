<div>
    <x-data-table2 :data="$data" :model="$barangs">
        <x-slot name="head">
            <tr>
                <th><a role="button" href="#">
                    #
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('namabarang')" role="button" href="#">
                    Nama Barang
                    @include('components.sort-icon', ['field' => 'namabarang'])
                </a></th>
                <th><a wire:click.prevent="sortBy('hargabeli')" role="button" href="#">
                    Harga Beli
                    @include('components.sort-icon', ['field' => 'hargabeli'])
                </a></th>
                <th><a wire:click.prevent="sortBy('hargajual')" role="button" href="#">
                    Harga Jual
                    @include('components.sort-icon', ['field' => 'hargajual'])
                </a></th>
                <th><a wire:click.prevent="sortBy('keterangan')" role="button" href="#">
                    Keterangan
                    @include('components.sort-icon', ['field' => 'keterangan'])
                </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th><a wire:click.prevent="sortBy('user')" role="button" href="#">
                    Dibuat Oleh
                    @include('components.sort-icon', ['field' => 'user'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($barangs as $key => $barang)
                <tr x-data="window.__controller.dataTableController({{ $barang->id }})">
                    <td>{{ $barangs->firstItem() + $key }}</td>
                    <td>{{ $barang->namabarang }}</td>
                    <td>Rp. {{ number_format($barang->hargabeli, 0, ".", ".") . ",-" }}</td>
                    <td>Rp. {{ number_format($barang->hargajual, 0, ".", ".") . ",-" }}</td>
                    <td>{{ $barang->keterangan }}</td>
                    <td>{{ $barang->created_at->format('d M Y H:i') }}</td>
                    <td>{{ $barang->user }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" wire:click="edit({{ $barang->id }})" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table2>
    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
    @if ($isOpen)
    @include('livewire.modal.modal-barang')
    @endif
</div>
