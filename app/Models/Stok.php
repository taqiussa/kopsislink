<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $guarded = [];
    // public function barang()
    // {
    //     return $this->belongsTo(Barang::class);
    // }
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('namabarang', 'like', '%' . $query . '%')
            ->orWhere('keterangan', 'like', '%' . $query . '%');
    }
}
