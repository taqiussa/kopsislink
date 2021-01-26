<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;

class Konversi extends Component
{
    public static function rupiah($angka)
    {
        $hasil = 'Rp ' . number_format($angka, 0, '', '.');
        return $hasil;
    }
    public static function angka($str)
    {
        $hasil = preg_replace("/[^0-9]/", "", $str);
        return $hasil;
    }
}
