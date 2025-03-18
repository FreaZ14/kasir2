@extends('layouts.app')
@section('title', 'Dashboard')
@section('css')
    <style>
        h5 {
            color: red !important;
        }
    </style>
@section('breadcrumb')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="row">
        <!-- Pembelian Terakhir -->
        <div class="col-md-6">
            <h5>Pembelian Terakhir</h5>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center table-primary">
                        <th>No Faktur</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembelian as $item)
                        <tr>
                            <td>{{ $item->no_faktur }}</td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Penjualan Terakhir -->
        <div class="col-md-6">
            <h5>Penjualan Terakhir</h5>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center table-primary">
                        <th>No Faktur</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan as $item)
                        <tr>
                            <td>{{ $item->no_faktur }}</td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
