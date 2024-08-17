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
            'nama_wali' => 'Super Wali',
            'no_identitas_wali' => '12345678987654',
            'tempat_tanggal_lahir_wali' => 'Dumai, 18 - 02 - 1991',
            'rt_wali' => '10',
            'rw_wali' => '11',
            'dusun_wali' => 'Jahug',
            'desa_wali' => 'Betek',
            'kecamatan_wali' => 'Ruut',
            'kab_kota_wali' => 'Malang',
            'provinsi_wali' => 'Jawa Timur',
            'kode_pos_wali' => '124924',
            'status_wali' => 'Keluarga',
            'no_hp' => '08912365432',
            'pendidikan_wali' => 'SMA',
            'pekerjaan_wali' => 'Petani',
            'pendapatan_wali_perbulan' => '1500000',
            'email' => 'wali@example.com',
            'password' => Hash::make('password123'),
            'role' => 'wali',
            'id_santri' => null,
        ]);
    }
}
