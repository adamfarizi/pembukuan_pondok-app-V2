<?php

namespace Database\Factories;

use App\Models\Pengeluaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengeluaran>
 */
class PengeluaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Pengeluaran::class;

    public function definition()
    {
        return [
            'id_admin' => 1,
            'jumlah_pengeluaran' => $this->faker->numberBetween(10000, 1000000),
            'tanggal_pengeluaran' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'deskripsi_pengeluaran' => $this->faker->sentence(),
            'nama_pengeluar' => $this->faker->name(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
