<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Penjualan;
use App\Models\Barang;



class DetailPenjualan extends Model
{
    use HasFactory;

    protected $table = 'detail_penjualan';

    protected $fillable = [
        'penjualan_id',
        'barang_id',
        'qty',
        'harga',
        'subtotal',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
}
