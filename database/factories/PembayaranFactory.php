<?php

namespace Database\Factories;

use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembayaran>
 */
class PembayaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Pembayaran::class;

    public function definition()
    {
        return [
            'id_santri' => $this->faker->numberBetween(1, 20),
            'id_admin' => null,
            'tanggal_pembayaran' => null,
            'jumlah_pembayaran' => 0,
            'jenis_pembayaran' => '',
            'status_pembayaran' => 'belum_lunas',
            'tahun_ajaran' => 2024,
            'semester_ajaran' => 'genap',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
