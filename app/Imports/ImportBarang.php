<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportBarang implements ToModel
{
    public function model(array $row)
    {
        //dd($row);

        return new Barang([
            'nama' => $row[0],
            'stok' => $row[1],
            'harga_jual' => $row[2],
            'satuan' => $row[3],
            'keterangan' => $row[4]
        ]);
    }
}
