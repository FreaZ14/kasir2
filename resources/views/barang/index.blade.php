@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Barang</h2>

        <a href="{{ route('barang.create') }}" style="margin-bottom: 10px;" class="btn btn-primary">Tambah Barang</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
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

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Masukkan File Excel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action={{ url('barang/import') }} method="post" enctype="multipart/form-data">
                            <div class="modal-body">

                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="file" name="file" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-primary">Masukkan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endsection
