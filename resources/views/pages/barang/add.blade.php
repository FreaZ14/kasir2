<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Barang</title>
</head>

<body>
    <h1>Tambah Data Barang</h1>
    <form action="/barang" method="post">
        @csrf
        <input type="text" name="nama" placeholder="Nama Barang" />
        @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <br>
        <input type="text" name="harga" placeholder="Harga Barang" />
        @error('harga')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <br>
        <input type="text" name="stok" placeholder="Stok Barang" />
        @error('stok')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <br>
        <button type="submit">Simpan</button>
    </form>
</body>

</html>
