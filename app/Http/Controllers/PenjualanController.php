<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Barang;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::all();
        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $barang = Barang::all();
        $noFaktur = 'PB-' . date('YmdHis');
        return view('penjualan.create', compact('barang', 'noFaktur'));
    }

    public function show(Penjualan $penjualan)
    {
        $penjualan->load('detail_Penjualan.barang');
        return view('penjualan.show', compact('penjualan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_faktur' => 'required|unique:Penjualan',
            'tanggal' => 'required|date',
            'barang_id' => 'required|array',
            'qty' => 'required|array',
            'harga' => 'required|array'
        ]);

        $total = 0;
        foreach ($request->barang_id as $key => $barang_id) {
            $subtotal = $request->qty[$key] * $request->harga[$key];
            $total += $subtotal;
        }

        $penjualan = Penjualan::create([
            'no_faktur' => $request->no_faktur,
            'tanggal' => $request->tanggal,
            'jumlah' => array_sum($request->qty),
            'total' => $total
        ]);

        foreach ($request->barang_id as $key => $barang_id) {
            DetailPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'barang_id' => $barang_id,
                'qty' => $request->qty[$key],
                'harga' => $request->harga[$key],
                'subtotal' => $request->qty[$key] * $request->harga[$key]
            ]);

            $barang = Barang::find($barang_id);
            if ($barang) {
                $barang->stok -= $request->qty[$key];
                $barang->save();
            }
        }

        return redirect()->route('penjualan.index')->with('success', 'penjualan berhasil ditambahkan');
    }

    public function edit(Penjualan $penjualan)
    {
        $barang = Barang::all();
        return view('penjualan.edit', compact('penjualan', 'barang'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'no_faktur' => 'required|unique:Penjualan,no_faktur,' . $penjualan->id,
            'tanggal' => 'required|date',
            'barang_id' => 'required|array',
            'qty' => 'required|array',
            'harga' => 'required|array',
            'total' => 'required'
        ]);

        $total = 0;
        $existingDetails = $penjualan->detail_Penjualan->keyBy('barang_id');


        foreach ($existingDetails as $detail) {
            $barang = Barang::find($detail->barang_id);
            if ($barang) {
                $barang->stok -= $detail->qty;
                $barang->save();
            }
        }

        foreach ($request->barang_id as $key => $barang_id) {
            $subtotal = $request->qty[$key] * $request->harga[$key];
            $total += $subtotal;

            $detail = $existingDetails->get($barang_id);
            if ($detail) {
                $detail->update([
                    'qty' => $request->qty[$key],
                    'harga' => $request->harga[$key],
                    'subtotal' => $subtotal
                ]);
                $existingDetails->forget($barang_id);
            } else {
                DetailPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'barang_id' => $barang_id,
                    'qty' => $request->qty[$key],
                    'harga' => $request->harga[$key],
                    'subtotal' => $subtotal
                ]);
            }


            $barang = Barang::find($barang_id);
            if ($barang) {
                $barang->stok -= $request->qty[$key];
                $barang->save();
            }
        }


        foreach ($existingDetails as $detail) {
            $barang = Barang::find($detail->barang_id);
            if ($barang) {
                $barang->stok += $detail->qty;
                $barang->save();
            }
            $detail->delete();
        }


        $penjualan->update([
            'no_faktur' => $request->no_faktur,
            'tanggal' => $request->tanggal,
            'jumlah' => array_sum($request->qty),
            'total' => $total
        ]);

        return redirect()->route('penjualan.index')->with('success', 'penjualan berhasil diperbarui dan stok diperbarui');
    }


    public function destroy(Penjualan $penjualan)
    {
        foreach ($penjualan->detail_Penjualan as $detail) {
            $barang = Barang::find($detail->barang_id);
            if ($barang) {
                $barang->stok += $detail->qty;
                $barang->save();
            }
        }
        $penjualan->detail_Penjualan()->delete();
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'penjualan berhasil dihapus');
    }
}
