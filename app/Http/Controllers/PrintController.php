<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Log;

class PrintController extends Controller
{
    public function printStruk($id)
    {
        $penjualan = Penjualan::with('detail_penjualan.barang')->findOrFail($id);


        $itemCount = count($penjualan->detail_penjualan);
        $paperHeight = 150 + ($itemCount * 15);

        $pdf = Pdf::loadView('penjualan.struk', compact('penjualan'))
            ->setPaper([0, 0, 220, $paperHeight], 'portrait');

        return $pdf->stream('struk-penjualan.pdf');
    }

    public function printStrukBaru(Penjualan $penjualan)

    {

        $penjualan->load('detail_penjualan.barang');
        //dd($penjualan);
        $namaToko = 'MyMart';

        $tanggal = $penjualan->tanggal;
        $noFaktur = $penjualan->no_faktur;

        try {
            $connector = new WindowsPrintConnector("thermal");
            $printer = new Printer($connector);

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text($namaToko . "\n");
            $printer->text($noFaktur . "\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Tanggal : " . $tanggal . "\n");
            $printer->text("--------------------------------\n");

            foreach ($penjualan->detail_penjualan as $item) {
                //dd($item);
                $printer->text($item->barang->nama . "\n");
                $printer->text($item->qty . ' x ' . $item->harga . ' = ' . $item->subtotal . "\n");
            }
            $printer->text("--------------------------------\n");
            $printer->text("Total : " . $penjualan->total . "\n");
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("================================\n");
            $printer->text("Terimakasih Sudah Berbelanja!");
            $printer->feed(3);
            $printer->cut();
            $printer->pulse();

            $printer->close();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back();
    }
}
