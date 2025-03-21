<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Mpdf\Mpdf;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printStruk($id)
    {
        $penjualan = Penjualan::with('detail_penjualan.barang')->findOrFail($id);

        $mpdf = new \Mpdf\Mpdf();
        $html = view('penjualan.struk', compact('penjualan'))->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output('struk_penjualan.pdf', 'I');
    }
}
