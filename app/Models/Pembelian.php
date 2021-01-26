<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelian';
    protected $guarded = [];
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('namabarang', 'like', '%' . $query . '%');
    }
    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}
