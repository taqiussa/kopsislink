<div>
    <x-data-table2 :data="$data" :model="$pembelians">
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
                    Jumlah pembelian
                    @include('components.sort-icon', ['field' => 'jumlah'])
                </a></th>
                <th><a wire:click.prevent="sortBy('hargabeli')" role="button" href="#">
                    Harga Beli
                    @include('components.sort-icon', ['field' => 'hargabeli'])
                </a></th>
                <th><a wire:click.prevent="sortBy('hargajual')" role="button" href="#">
                    Harga Jual
                    @include('components.sort-icon', ['field' => 'hargajual'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($pembelians as $key => $pembelian)
                <tr x-data="window.__controller.dataTableController({{ $pembelian->id }})">
                    <td>{{ $pembelians->firstItem() + $key }}</td>
                    <td>{{ $pembelian->namabarang }}</td>
                    <td>{{ $pembelian->jumlah }}</td>
                    <td>{{ $pembelian->hargabeli }}</td>
                    <td>{{ $pembelian->hargajual }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" wire:click="edit({{ $p->id }})" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table2>
    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
    @if ($isOpen)
    @include('livewire.modal.modal-pembelian')
    @endif
</div>