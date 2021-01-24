<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Barang') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Kopsis</a></div>
            <div class="breadcrumb-item"><a href="{{ route('barang') }}">Data Barang</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.tablebarang name="barang" :model="$barang" />
    </div>
</x-app-layout>
