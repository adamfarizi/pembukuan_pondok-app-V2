<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hafalan;
use App\Models\Santri;
use App\Enums\Surah;
use Faker\Factory as Faker;

class HafalanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $faker = Faker::create();

        // Ambil semua ID santri
        $santriIds = Santri::pluck('id_santri')->toArray();

        foreach ($santriIds as $santriId) {
            $surahs = Surah::getValues();
            
            foreach ($surahs as $surah) {
                $totalAyat = Surah::$totalAyat[$surah];

                Hafalan::create([
                    'id_santri' => $santriId,
                    'surah' => $surah,
                    'total_ayat' => $totalAyat,
                    'progress_ayat' => 0,
                ]);
            }
        }
    }
}
