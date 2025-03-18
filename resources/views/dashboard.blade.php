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
    <h5>Hello {{ auth()->user()->name ?? '-' }}</h5>

    {{-- <a href="{{ route('barang.index') }}" class="btn btn-primary">Barang</a>
    <a href="{{ route('penjualan.index') }}" class="btn btn-primary">Penjualan</a>
    <a href="{{ route('pembelian.index') }}" class="btn btn-primary">Pembelian</a> --}}
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

@endsection
