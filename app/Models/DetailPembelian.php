<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
use App\Models\Pembelian;

class DetailPembelian extends Model
{
    use HasFactory;

    protected $table = 'detail_pembelian';

    protected $fillable = [
        'pembelian_id',
        'barang_id',
        'qty',
        'harga',
        'subtotal'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }
}
