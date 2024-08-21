<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WaliSantri>
 */
class WaliSantriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $lastIdSantri = 0;
    
    public function definition()
    {
        return [
            'id_santri' => $this->getNextIdSantri(),

            
            // Identitas Wali
            'nama_wali' => $this->faker->name,
            'no_identitas_wali' => $this->faker->numerify('###############'), // 15 digit random numeric
            'tempat_lahir_wali' => $this->faker->city ,
            'tanggal_lahir_wali' => $this->faker->date('Y-m-d'),
            'rt_wali' => $this->faker->numerify('###'), // contoh format RT, bisa disesuaikan
            'rw_wali' => $this->faker->numerify('###'), // contoh format RW, bisa disesuaikan
            'dusun_wali' => $this->faker->word,
            'desa_wali' => $this->faker->citySuffix,
            'kecamatan_wali' => $this->faker->city,
            'kab_kota_wali' => $this->faker->city,
            'provinsi_wali' => $this->faker->state,
            'kode_pos_wali' => $this->faker->postcode,
            'status_wali' => $this->faker->randomElement(['Ayah', 'Ibu', 'Paman', 'Bibi', 'Lainnya']),
            'no_hp' => $this->faker->numerify('###########'),
            'pendidikan_wali' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3']),
            'pekerjaan_wali' => $this->faker->jobTitle,
            'pendapatan_wali_perbulan' => $this->faker->randomDigitNotNull,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password123'),
            'role' => 'wali',
        ];
    }

    protected function getNextIdSantri()
    {
        $this->lastIdSantri++;
        return $this->lastIdSantri;
    }
}
