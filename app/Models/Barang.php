<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $guarded = [];

    public function stok()
    {
        return $this->hasOne(Stok::class, 'barang_id');
    }
    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'barang_id');
    }
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('namabarang', 'like', '%' . $query . '%')
            ->orWhere('keterangan', 'like', '%' . $query . '%');
    }
}
