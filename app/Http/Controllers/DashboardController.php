<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Barang;

class DashboardController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        $pembelian = Pembelian::all();
        $penjualan = Penjualan::all();
        return view('dashboard', compact('pembelian', 'penjualan', 'barang'));
    }
}
