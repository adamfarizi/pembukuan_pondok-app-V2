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
            'nama_wali_santri' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password123'),
            'role' => 'wali',
            'no_hp' => $this->faker->numerify('###########'), // 13 digit random numeric
            'alamat_wali_santri' => $this->faker->address,
        ];
    }

    protected function getNextIdSantri()
    {
        $this->lastIdSantri++;
        return $this->lastIdSantri;
    }
}
