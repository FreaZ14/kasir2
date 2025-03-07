@extends('layouts.app')

@section('title', 'Detail Barang')

@section('breadcrumb')
    <div class="pagetitle">
        <h1>Detail Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('barang.index') }}">Barang</a></li>
                <li class="breadcrumb-item active">Detail Barang</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="card-title">Detail Barang</h3>
                        <a href = "{{ route('barang.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Nama Barang</th>
                            <td>: {{ $barang->nama }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>: {{ $barang->harga }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>: {{ $barang->stok }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
