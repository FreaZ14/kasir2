@extends('layouts.app')

@section('title', 'Barang')

@section('breadcrumb')
    <div class="pagetitle">
        <h1>Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Barang</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="container">
        <h2>Daftar Barang</h2>

        <a href="{{ route('barang.create') }}" style="margin-bottom: 10px;" class="btn btn-primary">Tambah Barang</a>


        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <form action="/barang" method="GET">
                    <input type="search" value="{{ request('search') }}" id="inputPassword6" name="search"
                        class="form-control border border-dark" aria-describedby="passwordHelpInline">
                </form>
            </div>
        </div>

        <table class="table table-bordered mt-3">
            <thead>
                <tr class="table-dark">
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Harga Jual</th>
                    <th>Satuan</th>
                    <th>Keterangan</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->stok }}</td>
                        <td>{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $item->satuan }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>
                            @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" width="50">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus barang ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-3"><a class="btn btn-success" href='{{ url('barang/export/excel') }}'>Export Excel</a>
            <a class="btn btn-danger" href='{{ url('barang/download/pdf') }}'>Export PDF</a>

            <a href class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Import Excel</a>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Masukkan File Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('barang/import') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="file" class="form-control" accept =".xlsx, .xls, .csv" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Masukkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    <img src="https://media.tenor.com/7lHdnabfyTQAAAAj/herta-kurukuru.gif" width="40" height="20" alt="">
@endsection
