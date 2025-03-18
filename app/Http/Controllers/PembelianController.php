<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\DetailPembelian;
use App\Models\Barang;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelian = Pembelian::all();
        return view('pembelian.index', compact('pembelian'));
    }

    public function create()
    {
        $barang = Barang::all();
        $noFaktur = 'PB-' . date('YmdHis');
        $tanggal = date('Y-m-d');
        return view('pembelian.create', compact('barang', 'noFaktur', 'tanggal'));
    }

    public function show(Pembelian $pembelian)
    {
        $pembelian->load('detail_pembelian.barang');
        return view('pembelian.show', compact('pembelian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_faktur' => 'required|unique:pembelian',
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

        $pembelian = Pembelian::create([
            'no_faktur' => $request->no_faktur,
            'tanggal' => $request->tanggal,
            'jumlah' => array_sum($request->qty),
            'total' => $total
        ]);

        foreach ($request->barang_id as $key => $barang_id) {
            DetailPembelian::create([
                'pembelian_id' => $pembelian->id,
                'barang_id' => $barang_id,
                'qty' => $request->qty[$key],
                'harga' => $request->harga[$key],
                'subtotal' => $request->qty[$key] * $request->harga[$key]
            ]);

            $barang = Barang::find($barang_id);
            if ($barang) {
                $barang->stok += $request->qty[$key];
                $barang->save();
            }
        }

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil ditambahkan');
    }

    public function edit(Pembelian $pembelian)
    {
        $barang = Barang::all();
        return view('pembelian.edit', compact('pembelian', 'barang'));
    }

    public function update(Request $request, Pembelian $pembelian)
    {
        $request->validate([
            'no_faktur' => 'required|unique:pembelian,no_faktur,' . $pembelian->id,
            'tanggal' => 'required|date',
            'barang_id' => 'required|array',
            'qty' => 'required|array',
            'harga' => 'required|array',
            'total' => 'required'
        ]);

        $total = 0;
        $existingDetails = $pembelian->detail_pembelian->keyBy('barang_id');


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
                DetailPembelian::create([
                    'pembelian_id' => $pembelian->id,
                    'barang_id' => $barang_id,
                    'qty' => $request->qty[$key],
                    'harga' => $request->harga[$key],
                    'subtotal' => $subtotal
                ]);
            }


            $barang = Barang::find($barang_id);
            if ($barang) {
                $barang->stok += $request->qty[$key];
                $barang->save();
            }
        }


        foreach ($existingDetails as $detail) {
            $barang = Barang::find($detail->barang_id);
            if ($barang) {
                $barang->stok -= $detail->qty;
                $barang->save();
            }
            $detail->delete();
        }


        $pembelian->update([
            'no_faktur' => $request->no_faktur,
            'tanggal' => $request->tanggal,
            'jumlah' => array_sum($request->qty),
            'total' => $total
        ]);

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil diperbarui dan stok diperbarui');
    }


    public function destroy(Pembelian $pembelian)
    {
        foreach ($pembelian->detail_pembelian as $detail) {
            $barang = Barang::find($detail->barang_id);
            if ($barang) {
                $barang->stok -= $detail->qty;
                $barang->save();
            }
        }
        $pembelian->detail_pembelian()->delete();
        $pembelian->delete();

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil dihapus');
    }
}
