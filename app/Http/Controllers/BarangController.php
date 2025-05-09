<?php

namespace App\Http\Controllers;

use App\Exports\ExportBarang;
use App\Imports\ImportBarang;
use App\Models\Barang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


class BarangController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('search')) {
            $barang = Barang::where('nama', 'like', '%' . $request->search . '%')->get();
        } else {
            $barang = Barang::all();
        }


        // $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }
    function export_excel()
    {
        return Excel::download(new ExportBarang, "barang.xlsx");
    }



    public function import_excel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new ImportBarang, $request->file('file'));

        return redirect()->route('barang.index')->with('success', 'Data berhasil diimport!');
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
