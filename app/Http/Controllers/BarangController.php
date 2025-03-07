<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use App\Models\BarangCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::query();

        $barang = $barang->orderBy('created_at', 'DESC')->paginate(10);

        return view('pages.barang.list', [
            'barang' => $barang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // return $request->all();
        // return $request->all();
        $rules = [
            'nama' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'gambar' => 'required'
        ];
        $messages = [
            'nama.required' => 'Nama wajib diisi',
            'stok.required' => 'Stok Wajib Diisi',
            'harga.required' => 'Harga Wajib Diisi',
            'gambar.required' => 'Gambar Wajib Diisi',
        ];

        $request->validate($rules, $messages);

        //dd("proses validasi berhasil");

        $datarow = $request->all();

        $barang = Barang::create($datarow);

        return redirect('barang')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        return view('pages.barang.show', [
            'barang' => $barang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        return view('pages.barang.edit', [
            'barang' => $barang
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        //dd($request->all());
        // return $request->all();
        // return $request->all();
        $rules = [
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ];
        $messages = [
            'nama.required' => 'Nama wajib diisi',
            'harga.required' => 'Harga Wajib Diisi',
            'stok.required' => 'Stok Wajib Diisi',
        ];

        $request->validate($rules, $messages);

        //dd("proses validasi berhasil");

        $datarow = $request->all();

        $barang->update($datarow);

        return redirect('barang')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        // return "Ini method hapus";
        $barang->delete();
        return redirect('barang');
    }
}
