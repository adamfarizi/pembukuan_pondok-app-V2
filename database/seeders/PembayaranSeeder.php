<?php

namespace Database\Seeders;

use App\Models\Santri;
use App\Models\Pembayaran;
use Illuminate\Database\Seeder;
use App\Helpers\SemesterHelper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $santriIds = Santri::pluck('id_santri')->toArray();
        $jenisPembayaran = [
            'daftar_ulang' => 50000,
            'iuran_bulanan' => 100000,
            'tamrin' => 50000,
        ];
        $currentSemester = SemesterHelper::getCurrentSemester();

        foreach ($santriIds as $santriId) {
            foreach ($jenisPembayaran as $jenis => $jumlah) {
                Pembayaran::factory()->create([
                    'id_santri' => $santriId,
                    'jenis_pembayaran' => $jenis,
                    'jumlah_pembayaran' => $jumlah,
                    'tahun_ajaran' => $currentSemester['tahun'],
                    'semester_ajaran' => $currentSemester['semester'],
                ]);
            }
        }
    }
}
