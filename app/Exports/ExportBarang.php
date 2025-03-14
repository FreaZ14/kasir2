<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Collection;

class ExportBarang implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('barang.export', [
            'barang' => Barang::select('nama', 'stok', 'harga_jual', 'satuan', 'keterangan')->get()
        ]);
    }
}
