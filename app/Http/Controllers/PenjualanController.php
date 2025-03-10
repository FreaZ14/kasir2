<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use App\Models\Detailpenjualan;
use App\Models\Barang;
use Illuminate\Http\Request;

class penjualanController extends Controller
{
    public function index()
    {
        $penjualan = penjualan::all();
        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $barang = Barang::all();
        $noFaktur = 'PB-' . date('YmdHis');
        return view('penjualan.create', compact('barang', 'noFaktur'));
    }

    public function show(penjualan $penjualan)
    {
        $penjualan->load('detail_penjualan.barang');
        return view('penjualan.show', compact('penjualan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'no_faktur' => 'required|unique:penjualan',
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

        $penjualan = penjualan::create([
            'no_faktur' => $request->no_faktur,
            'tanggal' => $request->tanggal,
            'jumlah' => array_sum($request->qty),
            'total' => $total
        ]);

        foreach ($request->barang_id as $key => $barang_id) {
            Detailpenjualan::create([
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

    public function edit(penjualan $penjualan)
    {
        return view('penjualan.edit', compact('penjualan'));
    }

    public function update(Request $request, penjualan $penjualan)
    {
        $request->validate([
            'no_faktur' => 'required|unique:penjualan,no_faktur,' . $penjualan->id,
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer',
            'total' => 'required|numeric'
        ]);

        $total = $request->jumlah * $request->total;
        $penjualan->update([
            'no_faktur' => $request->no_faktur,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'total' => $total
        ]);

        if (isset($request->barang_id)) {
            foreach ($request->barang_id as $key => $barang_id) {
                $detailpenjualan = $penjualan->detail_penjualan->where('barang_id', $barang_id)->first();
                if ($detailpenjualan) {
                    $detailpenjualan->update([
                        'qty' => $request->qty[$key],
                        'harga' => $request->harga[$key],
                        'subtotal' => $request->qty[$key] * $request->harga[$key]
                    ]);
                } else {
                    Detailpenjualan::create([
                        'penjualan_id' => $penjualan->id,
                        'barang_id' => $barang_id,
                        'qty' => $request->qty[$key],
                        'harga' => $request->harga[$key],
                        'subtotal' => $request->qty[$key] * $request->harga[$key]
                    ]);
                }
            }
        }

        $penjualan->update($request->all());
        return redirect()->route('penjualan.index')->with('success', 'penjualan berhasil diperbarui');
    }

    public function destroy(penjualan $penjualan)
    {
        $penjualan->detail_penjualan()->delete();
        $penjualan->delete();
        return redirect()->route('penjualan.index')->with('success', 'penjualan berhasil dihapus');
    }
}
