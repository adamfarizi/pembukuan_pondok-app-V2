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
            'tempat_tanggal_lahir_santri' => $this->faker->city . ', ' . $this->faker->date('d-m-Y'),
            'jenis_kelamin_santri' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'alamat_santri' => $this->faker->address,
            'no_hp_santri' => $this->faker->numerify('###########'), // 13 digit random numeric
            'email_santri' => $this->faker->unique()->safeEmail,
            'ktp_santri' => 'ktp.png',
            'kk_santri' => 'kk.png',
            'akta_santri' => 'akta.png',
            'pas_foto_santri' => 'pasfoto.png',
            'status_santri' => $this->faker->randomElement(['menetap', 'pulang']),
            'tahun_masuk' => $year,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
