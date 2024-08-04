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
            'nama_santri' => $this->faker->name,
            'no_identitas' => $this->faker->numerify('###############'), // 15 digit random numeric
            'tempat_tanggal_lahir_santri' => $this->faker->city . ', ' . $this->faker->date('d-m-Y'),
            'no_hp_santri' => $this->faker->numerify('###########'), // 13 digit random numeric
            'email_santri' => $this->faker->unique()->safeEmail,
            'jenis_kelamin_santri' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'status_santri' => $this->faker->randomElement(['menetap', 'pulang']),
            'rt' => $this->faker->numerify('###'), // contoh format RT, bisa disesuaikan
            'rw' => $this->faker->numerify('###'), // contoh format RW, bisa disesuaikan
            'dusun' => $this->faker->word,
            'desa' => $this->faker->citySuffix,
            'kecamatan' => $this->faker->city,
            'kab_kota' => $this->faker->city,
            'propinsi' => $this->faker->state,
            'kode_pos' => $this->faker->postcode,
            'mulai_masuk_tanggal' => Carbon::parse($this->faker->date('Y-m-d'))->format('d-m-Y'),
            'ktp_santri' => 'ktp.png',
            'kk_santri' => 'kk.png',
            'akta_santri' => 'akta.png',
            'pas_foto_santri' => 'pasfoto.png',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
