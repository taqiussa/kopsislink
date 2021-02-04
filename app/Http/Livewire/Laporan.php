<?php

namespace App\Http\Livewire;

use App\Models\Pembelian;
use App\Models\Penjualan;
use Livewire\Component;

class Laporan extends Component
{
    public $laporan;
    public $bulan;
    public $pilih;
    public $tanggal1;
    public $tanggal2;
    public $jumlah;
    public $total;
    public $laba;

    public function render()
    {
        if (($this->pilih) == "Penjualan") {
            $this->jumlah =  Penjualan::whereBetween('tanggal', [$this->tanggal1, $this->tanggal2])->sum('jumlah');
            $this->total =  Penjualan::whereBetween('tanggal', [$this->tanggal1, $this->tanggal2])->sum('total');
            $this->laba = $this->total * (10 / 100);
        } elseif (($this->pilih) == "Pembelian") {
            $this->jumlah =  Pembelian::whereBetween('tanggal', [$this->tanggal1, $this->tanggal2])->sum('jumlah');
            $this->total =  Pembelian::whereBetween('tanggal', [$this->tanggal1, $this->tanggal2])->sum('total');
        };
        return view('livewire.laporan');
    }
}
