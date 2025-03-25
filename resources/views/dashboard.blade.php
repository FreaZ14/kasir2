@extends('layouts.app')
@section('title', 'Dashboard')
@section('css')
    <style>
        h4 {
            color: red !important;
        }

        h5 {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif !important;
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
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Kasir</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Barang</h5>
                            <p class="card-text">{{ $barang->count() }}</p>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->id != 2)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Pembelian</h5>
                                <p class="card-text">{{ $pembelian->count() }}</p>
                            </div>
                        </div>
                @endif
                @if (auth()->user()->id != 2)
                    <div style="margin-left:-160px; margin-right: 160px;">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Pembelian</h5>
                                <p class="card-text">Rp.{{ number_format($pembelian->sum('total'), 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Penjualan</h5>
                        <p class="card-text">{{ $penjualan->count() }}</p>
                    </div>
                </div>
                @if (auth()->user()->id != 2)
                    <div style="margin-left:-160px; margin-right: 160px;">
                @endif
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Penjualan</h5>
                        <p class="card-text">Rp.{{ number_format($penjualan->sum('total'), 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <img src="https://media.tenor.com/7lHdnabfyTQAAAAj/herta-kurukuru.gif" width="40" height="20" alt="">

    </div>
@endsection
