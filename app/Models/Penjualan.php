<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'pembeli_id',
        'barang_id',
        'jumlah_barang',
        'total_harga',
    ];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
