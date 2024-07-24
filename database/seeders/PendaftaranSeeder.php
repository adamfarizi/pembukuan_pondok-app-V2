<?php

namespace Database\Seeders;

use App\Models\Pendaftaran;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pendaftaran::create([
            'kode_pendaftaran' => strtoupper(Str::random(10)),
            'nama_pendaftar' => 'Adam Farizi',
            'tempat_tanggal_lahir_pendaftar' => 'Madiun, 2000-01-01',
            'jenis_kelamin_pendaftar' => 'laki-laki',
            'alamat_pendaftar' => 'Jl. Mawar No. 1, Jakarta',
            'no_hp_pendaftar' => '081234567890',
            'email_pendaftar' => 'adamfarizi@example.com',
            'ktp_pendaftar' => 'ktp.png',
            'kk_pendaftar' => 'kk.png',
            'akta_pendaftar' => 'akta.png',
            'pas_foto_pendaftar' => 'pasfoto.png',
            'nama_wali_pendaftar' => 'Nathan Joe Doe',
            'no_hp_wali_pendaftar' => '081234567891',
            'email_wali_pendaftar' => 'nathan.doe@example.com',
            'alamat_wali_santri' => 'Jl. Mawar No. 1, Jakarta',
            'status' => 'belum_verifikasi',
            'created_at' => now(),
            'updated_at' => now(),
            // Anda dapat menambahkan lebih banyak data contoh di sini
        ]);
    }
}
