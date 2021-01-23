<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Stok') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Kopsis</a></div>
            <div class="breadcrumb-item"><a href="{{ route('stok') }}">Data Stok</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.kopsis name="stok" :model="$stok" />
    </div>
</x-app-layout>
