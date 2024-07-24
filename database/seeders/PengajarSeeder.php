<?php

namespace Database\Seeders;

use App\Models\Pengajar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PengajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pengajars = [
            ['nama_pengajar' => 'Ustadz Ahmad', 'nomor_hp_pengajar' => '081234567890', 'mata_pelajaran' => 'al_quran_tajwid'],
            ['nama_pengajar' => 'Ustadzah Aisyah', 'nomor_hp_pengajar' => '081234567891', 'mata_pelajaran' => 'bahasa_arab'],
            ['nama_pengajar' => 'Ustadz Ibrahim', 'nomor_hp_pengajar' => '081234567892', 'mata_pelajaran' => 'fiqh'],
            ['nama_pengajar' => 'Ustadz Yusuf', 'nomor_hp_pengajar' => '081234567893', 'mata_pelajaran' => 'hadist'],
            ['nama_pengajar' => 'Ustadzah Fatimah', 'nomor_hp_pengajar' => '081234567894', 'mata_pelajaran' => 'aqidah'],
            ['nama_pengajar' => 'Ustadz Ali', 'nomor_hp_pengajar' => '081234567895', 'mata_pelajaran' => 'sirah_nabawiyyah'],
            ['nama_pengajar' => 'Ustadzah Maryam', 'nomor_hp_pengajar' => '081234567896', 'mata_pelajaran' => 'tazkiyatun_nafs'],
            ['nama_pengajar' => 'Ustadz Usman', 'nomor_hp_pengajar' => '081234567897', 'mata_pelajaran' => 'tarikh'],
        ];

        foreach ($pengajars as $pengajarData) {
            Pengajar::create($pengajarData);
        }
    }
}
