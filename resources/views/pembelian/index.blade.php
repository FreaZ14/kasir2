@extends('layouts.app')

@section('title', 'Pembelian')

@section('breadcrumb')
    <div class="pagetitle">
        <h1>Pembelian</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Pembelian</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container">
        <h2>Daftar Pembelian</h2>
        <a href="{{ route('pembelian.create') }}" style="margin-bottom: 40px;" class="btn btn-primary">Tambah Pembelian</a>

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
                @foreach ($pembelian as $item)
                    <tr class="text-center">
                        <td>{{ $item->no_faktur }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ number_format($item->total, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('pembelian.show', $item->id) }}" class="btn bit btn-info btn-sm">Detail</a>

                            <a href="{{ route('pembelian.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('pembelian.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus pembelian ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
