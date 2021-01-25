<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Stok;

class KopsisController extends Controller
{
    public function barang()
    {
        return view('pages.kopsis.barang-data', [
            'barang' => Barang::class
        ]);
    }
    public function stok()
    {
        return view('pages.kopsis.stok-data', [
            'stok' => Stok::class
        ]);
    }
    public function pembelian()
    {
        return view('pages.kopsis.pembelian-data', [
            'pembelian' => Stok::class
        ]);
    }
}
