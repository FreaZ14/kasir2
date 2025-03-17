<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsertableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role_id' => 'admin',
            'password' => Hash::make('password')
        ]);

        DB::table('users')->insert([
            'name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'role_id' => 'operator',
            'password' => Hash::make('password')

        ]);
    }
}
