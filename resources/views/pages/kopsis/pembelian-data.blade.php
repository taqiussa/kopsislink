<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Pembelian') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('pembelian') }}">Transaki</a></div>
            <div class="breadcrumb-item"><a href="#">Pembelian</a></div>
            <div class="breadcrumb-item"><a href="{{ route('pembelian') }}">Data Pembelian</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.tablepembelian name="pembelian" :model="$pembelian" />
    </div>
</x-app-layout>
