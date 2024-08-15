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
            //Indentitas calon santri
            'nama_pendaftar' => 'Adam Farizi',
            'no_identitas' => '3578511354923',
            'tempat_tanggal_lahir_pendaftar' => 'Madiun, 2000-01-01',
            'jenis_kelamin_pendaftar' => 'laki-laki',
            'rt' => '01',
            'rw' => '10',
            'dusun' => 'Dusun',
            'desa' => 'Desa',
            'kecamatan' => 'Kecamatan',
            'kab_kota' => 'Kabupaten',
            'provinsi' => 'Jawa Timur',
            'kode_pos' => '63557',
            'no_hp_pendaftar' => '081234567892',
            'email_pendaftar' => 'adamfarizi@example.com',
            'mulai_masuk_tanggal' => now(),
            'jumlah_saudara_kandung' => '2',
            'anak_ke' => '1',

            //Identitas orang tua calon santri
            //Ayah
            'nama_ayah_pendaftar' => 'Ayah',
            'pendidikan_ayah' => 'Pendidikan',
            'pekerjaan_ayah' => 'Guru',
            'pendapatan_ayah_perbulan' => '2500000',

            //Ibu
            'nama_ibu_pendaftar' => 'Ibu',
            'pendidikan_ibu' => 'Pendidikan',
            'pekerjaan_ibu' => 'Wiraswasta',
            'pendapatan_ibu_perbulan' => '2000000',

            //Identitas wali calon santri
            'nama_wali_pendaftar' => 'Nathan Joe Doe',
            'no_identitas_wali' => '3578511354923',
            'tempat_tanggal_lahir_wali' => 'Madiun, 1993-03-03',
            'rt_wali' => '01',
            'rw_wali' => '10',
            'dusun_wali' => 'Dusun',
            'desa_wali' => 'Desa',
            'kecamatan_wali' => 'Kecamatan',
            'kab_kota_wali' => 'Kabupaten',
            'provinsi_wali' => 'Jawa Timur',
            'kode_pos_wali' => '63557',
            'status_wali' => 'Wali',
            'no_hp_wali_pendaftar' => '081234567891',
            'email_wali_pendaftar' => 'nathan.doe@example.com',
            'pendidikan_wali' => 'SMA',
            'pekerjaan_wali' => 'Guru',
            'pendapatan_wali_perbulan' => '2500000',

            //Berkas-berkas
            'ktp_pendaftar' => 'ktp.png',
            'kk_pendaftar' => 'kk.png',
            'akta_pendaftar' => 'akta.png',
            'pas_foto_pendaftar' => 'pasfoto.png',
            'status' => 'belum_verifikasi',
            'created_at' => now(),
            'updated_at' => now(),
            // Anda dapat menambahkan lebih banyak data contoh di sini
        ]);
    }
}
