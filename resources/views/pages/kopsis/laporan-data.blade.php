<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Laporan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('laporan') }}">Laporan</a></div>
            <div class="breadcrumb-item"><a href="{{ route('laporan') }}">Laporan Penjualan</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:laporan/>
    </div>
</x-app-layout>
