<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemasukan>
 */
class PemasukanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Pemasukan::class;

    public function definition()
    {
        return [
            'id_admin' => 1,
            'nama_pengirim' => $this->faker->name(),
            'jumlah_pemasukan' => $this->faker->numberBetween(1000, 1000000),
            'tanggal_pemasukan' => $this->faker->dateTimeBetween('now'),
            'deskripsi_pemasukan' => $this->faker->sentence(),
            'bukti_pemasukan' => 'transfer.png',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
