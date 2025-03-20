@extends('layouts.app')

@section('title', 'Penjualan')

@section('breadcrumb')
    <div class="pagetitle">
        <h1>Penjualan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Penjualan</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="container">
        <h2>Daftar Penjualan</h2>
        <a href="{{ route('penjualan.create') }}" style="margin-bottom: 40px;" class="btn btn-primary">Tambah Penjualan</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped table-responsive mt-1">
            <thead>
                <tr class="text-center table-dark">
                    <th>No. Faktur</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan as $item)
                    <tr class="text-center">
                        <td>{{ $item->no_faktur }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ number_format($item->total, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('penjualan.show', $item->id) }}" class="btn bit btn-info btn-sm">Detail</a>

                            <a href="{{ route('penjualan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('penjualan.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus penjualan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <img src="https://media.tenor.com/7lHdnabfyTQAAAAj/herta-kurukuru.gif" width="40" height="20" alt="">
    </div>
@endsection
