<x-app-layout>
    <x-slot name="header_content">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Layout</a></div>
            <div class="breadcrumb-item">Default Layout</div>
        </div>
    </x-slot>

    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        {{-- <x-jet-welcome /> --}}
        <div class="text-lg text-justify card-body">
            Selamat Datang di Kopsis Binus
        <ul>
            <li>Untuk Menambahkan Nama Barang Silahkan Masuk ke Menu Data -> Barang</li>
            <li>Untuk Melihat Jumlah Stok Barang Silahkan Masuk ke Menu Data -> Stok</li>
            <li>Untuk Menambah / Pembelian Barang Silahkan Masuk ke Menu Transaksi -> Pembelian</li>
            <li>Untuk Melakukan Penjualan Barang Silahkan Masuk ke Menu Transaksi -> Penjualan</li>
            <li>Untuk Melihat Laporan Harian Silahkan Masuk ke Menu Laporan</li>
        </ul>
        </div>
    </div>
</x-app-layout>
