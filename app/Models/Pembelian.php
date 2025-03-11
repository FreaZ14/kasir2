<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailPembelian;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    protected $fillable = [
        'no_faktur',
        'tanggal',
        'jumlah',
        'qty',
        'total',
    ];

    public function detail_pembelian()
    {
        return $this->hasMany(DetailPembelian::class);
    }

    public function barang()
    {
        return $this->belongsToMany(Barang::class);
    }
}
