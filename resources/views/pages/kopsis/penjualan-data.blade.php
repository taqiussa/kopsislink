<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Penjualan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('penjualan') }}">Transaki</a></div>
            <div class="breadcrumb-item"><a href="#">penjualan</a></div>
            <div class="breadcrumb-item"><a href="{{ route('penjualan') }}">Data penjualan</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.tablepenjualan name="penjualan" :model="$penjualan" />
    </div>
</x-app-layout>
