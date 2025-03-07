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
@endsection
