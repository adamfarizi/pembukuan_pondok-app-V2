<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Santri>
 */
class SantriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {   
        $year = Carbon::parse('2023-03-03')->year;

        return [
            // Data Santri
            'nama_santri' => $this->faker->name,
            'no_identitas' => $this->faker->numerify('###############'), // 15 digit random numeric
            'tempat_tanggal_lahir_santri' => $this->faker->city . ', ' . $this->faker->date('d-m-Y'),
            'jenis_kelamin_santri' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'rt' => $this->faker->numerify('###'), // contoh format RT, bisa disesuaikan
            'rw' => $this->faker->numerify('###'), // contoh format RW, bisa disesuaikan
            'dusun' => $this->faker->word,
            'desa' => $this->faker->citySuffix,
            'kecamatan' => $this->faker->city,
            'kab_kota' => $this->faker->city,
            'provinsi' => $this->faker->state,
            'kode_pos' => $this->faker->postcode,
            'no_hp_santri' => $this->faker->numerify('###########'), // 13 digit random numeric
            'email_santri' => $this->faker->unique()->safeEmail,
            'mulai_masuk_tanggal' => Carbon::parse($this->faker->date('Y-m-d'))->format('d-m-Y'),
            'jumlah_saudara_kandung' => $this->faker->randomDigitNotNull, // random number for sibling count
            'anak_ke' => $this->faker->randomDigitNotNull, // random number for child position
        
            // Identitas Ayah
            'nama_ayah' => $this->faker->name,
            'pendidikan_ayah' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3']),
            'pekerjaan_ayah' => $this->faker->jobTitle,
            'pendapatan_ayah_perbulan' => $this->faker->randomElement(['< 1 juta', '1-3 juta', '3-5 juta', '5-10 juta', '> 10 juta']),
        
            // Identitas Ibu
            'nama_ibu' => $this->faker->name,
            'pendidikan_ibu' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3']),
            'pekerjaan_ibu' => $this->faker->jobTitle,
            'pendapatan_ibu_perbulan' => $this->faker->randomElement(['< 1 juta', '1-3 juta', '3-5 juta', '5-10 juta', '> 10 juta']),
        
            // Identitas Wali
            'nama_wali' => $this->faker->name,
            'no_identitas_wali' => $this->faker->numerify('###############'), // 15 digit random numeric
            'tempat_tanggal_lahir_wali' => $this->faker->city . ', ' . $this->faker->date('d-m-Y'),
            'rt_wali' => $this->faker->numerify('###'), // contoh format RT, bisa disesuaikan
            'rw_wali' => $this->faker->numerify('###'), // contoh format RW, bisa disesuaikan
            'dusun_wali' => $this->faker->word,
            'desa_wali' => $this->faker->citySuffix,
            'kecamatan_wali' => $this->faker->city,
            'kab_kota_wali' => $this->faker->city,
            'provinsi_wali' => $this->faker->state,
            'kode_pos_wali' => $this->faker->postcode,
            'status_wali' => $this->faker->randomElement(['Keluarga', 'Orang Lain']),
            'no_hp_wali' => $this->faker->numerify('###########'), // 13 digit random numeric
            'email_wali' => $this->faker->unique()->safeEmail,
            'pendidikan_wali' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3']),
            'pekerjaan_wali' => $this->faker->jobTitle,
            'pendapatan_wali_perbulan' => $this->faker->randomElement(['< 1 juta', '1-3 juta', '3-5 juta', '5-10 juta', '> 10 juta']),
        
            // Berkas-berkas
            'ktp_santri' => 'ktp.png',
            'kk_santri' => 'kk.png',
            'akta_santri' => 'akta.png',
            'pas_foto_santri' => 'pasfoto.png',
            'status_santri' => $this->faker->randomElement(['sudah_verifikasi', 'belum_verifikasi']),
        
            // Timestamp
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
    }

}
