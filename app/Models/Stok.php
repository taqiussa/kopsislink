<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;
    protected $table = 'stok';
    protected $guarded = [];
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('barang.namabarang', 'like', '%' . $query . '%')
            ->orWhere('barang.keterangan', 'like', '%' . $query . '%');
    }
}
