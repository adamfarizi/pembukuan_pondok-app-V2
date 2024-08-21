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
            'no_induk' => $this->faker->numerify('####'), // 15 digit random numeric
            'status_santri' => 'mukim', // 15 digit random numeric
            'no_identitas' => $this->faker->numerify('###############'), // 15 digit random numeric
            'tempat_lahir_santri' => $this->faker->city,
            'tanggal_lahir_santri' => $this->faker->date('Y-m-d'),
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
            'tahun_masuk' => now()->year,
            'tingkatan' => '1_TSA',
            'jumlah_saudara_kandung' => $this->faker->randomDigitNotNull, // random number for sibling count
            'anak_ke' => $this->faker->randomDigitNotNull, // random number for child position
        
            // Identitas Ayah
            'nama_ayah' => $this->faker->name,
            'pendidikan_ayah' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3']),
            'pekerjaan_ayah' => $this->faker->jobTitle,
            'pendapatan_ayah_perbulan' => $this->faker->randomDigitNotNull,
        
            // Identitas Ibu
            'nama_ibu' => $this->faker->name,
            'pendidikan_ibu' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3']),
            'pekerjaan_ibu' => $this->faker->jobTitle,
            'pendapatan_ibu_perbulan' => $this->faker->randomDigitNotNull,
        
            // Berkas-berkas
            'ktp_santri' => 'ktp.png',
            'kk_santri' => 'kk.png',
            'akta_santri' => 'akta.png',
            'pas_foto_santri' => 'pasfoto.png',
        
            // Timestamp
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
    }

}
