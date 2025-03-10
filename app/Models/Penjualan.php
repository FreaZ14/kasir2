<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailPenjualan;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $fillable = [
        'no_faktur',
        'tanggal',
        'jumlah',
        'total',
    ];


    public function barang()
    {
        return $this->belongsToMany(Barang::class);
    }

    public function detail_penjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}
