@extends('layouts.app')

@section('title', 'Contoh 1')

@section('breadcrumb')
    <div class="pagetitle">
        <h1>Contoh 1</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Contoh 1</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <h5>Hello Contoh 1</h5>
@endsection
