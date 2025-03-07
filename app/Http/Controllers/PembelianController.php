<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
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
        return view('pembelian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_faktur' => 'required|unique:pembelian',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer',
            'total' => 'required|numeric'
        ]);

        Pembelian::create($request->all());
        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil ditambahkan');
    }

    public function edit(Pembelian $pembelian)
    {
        return view('pembelian.edit', compact('pembelian'));
    }

    public function update(Request $request, Pembelian $pembelian)
    {
        $request->validate([
            'no_faktur' => 'required|unique:pembelian,no_faktur,' . $pembelian->id,
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer',
            'total' => 'required|numeric'
        ]);

        $pembelian->update($request->all());
        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil diperbarui');
    }

    public function destroy(Pembelian $pembelian)
    {
        $pembelian->delete();
        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil dihapus');
    }
}
