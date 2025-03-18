<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Penjualan;

class DashboardController extends Controller
{
    public function index()
    {
        $pembelian = Pembelian::latest()->take(5)->get();
        $penjualan = Penjualan::latest()->take(5)->get();

        return view('dashboard', compact('pembelian', 'penjualan'));
    }
}
