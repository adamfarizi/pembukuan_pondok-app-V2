<?php

namespace Database\Seeders;

use App\Models\NilaiSantri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Helpers\SemesterHelper;


class NilaiSantriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            'al_quran_tajwid',
            'bahasa_arab',
            'fiqh',
            'hadist',
            'aqidah',
            'sirah_nabawiyyah',
            'tazkiyatun_nafs',
            'tarikh'
        ];

        $santriIds = \App\Models\Santri::pluck('id_santri');

        $currentSemester = SemesterHelper::getCurrentSemester();

        foreach ($santriIds as $santriId) {
            foreach ($subjects as $subject) {
                NilaiSantri::create([
                    'id_santri' => $santriId,
                    'semester_ajaran' => 'ganjil',
                    'tahun_ajaran' => '2023',
                    'mata_pelajaran' => $subject,
                    'nilai' => rand(60, 100),
                ]);

                NilaiSantri::create([
                    'id_santri' => $santriId,
                    'semester_ajaran' => 'genap',
                    'tahun_ajaran' => '2024',
                    'mata_pelajaran' => $subject,
                    'nilai' => rand(60, 100),
                ]);
            }
        }
    }
}
