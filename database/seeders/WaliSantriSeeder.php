<?php

namespace Database\Seeders;

use App\Models\WaliSantri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class WaliSantriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WaliSantri::create([
            'nama_wali_santri' => 'Super Wali',
            'email' => 'wali@example.com',
            'password' => Hash::make('password123'),
            'role' => 'wali',
            'no_hp' => '089123456789',
            'alamat_wali_santri' => 'Jl. Example',
            'id_santri' => null,
        ]);
    }
}
