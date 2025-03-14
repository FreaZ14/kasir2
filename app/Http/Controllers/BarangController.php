<?php

namespace App\Http\Controllers;

use App\Exports\ExportBarang;
use App\Imports\BarangImport;
use App\Models\Barang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    function export_excel()
    {
        return Excel::download(new ExportBarang, "barang.xlsx");
    }
    function import_excel(Request $request)
    {
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('barang', $namaFile);
        Excel::import(new BarangImport, public_path('/barang/' . $namaFile));
        return back();
    }

    function download_pdf()
    {
        $mpdf = new \Mpdf\Mpdf();
        $barang = Barang::all();
        $mpdf->WriteHTML(view('barang.export', compact('barang')));
        $mpdf->Output('barang.pdf', 'D');
    }


    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'stok' => 'required|integer',
            'harga_jual' => 'required|numeric',
            'satuan' => 'required',
            'keterangan' => 'nullable',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        Barang::create($data);
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama' => 'required',
            'stok' => 'required|integer',
            'harga_jual' => 'required|numeric',
            'satuan' => 'required',
            'keterangan' => 'nullable',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        $barang->update($data);
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
