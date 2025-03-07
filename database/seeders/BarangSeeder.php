<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barang')->insert([
            'nama' => 'Sapu Lidi',
            'harga' => '10000',
            'stok' => '10',
            'gambar' => 'img/sapu.jpg'
        ]);
    }
}
