@extends('layouts.app')

@section('title', 'Barang')

@section('breadcrumb')
    <div class="pagetitle">
        <h1>Data Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Barang</li>
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
                        <h3 class="card-title m-0">Data Barang</h3>
                        <a href = "{{ route('barang.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang as $b)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $b->nama }}</td>
                                    <td>{{ $b->stok }}</td>
                                    <td>{{ $b->harga }}</td>
                                    <td><img src="{{ asset('storage/' . $b->gambar) }}" alt="Gambar Barang" width="100">
                                    </td>

                                    <td>
                                        <a href="{{ route('barang.edit', $b) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ route('barang.show', $b) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteData({{ $b->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <form action="{{ route('barang.destroy', $b) }}" method="POST"
                                            id="deleteForm{{ $b->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function deleteData(id) {
            if (confirm("Apakah anda yakin?")) {
                document.getElementById('deleteForm' + id).submit()
            }
            return false;
        }
    </script>
@endsection
