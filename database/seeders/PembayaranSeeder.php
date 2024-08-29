<?php

namespace Database\Seeders;

use App\Models\Santri;
use App\Models\MasterAdmin;
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

        $daftar_ulang = MasterAdmin::where('jenis_pembayaran', 'pendaftaran')
            ->where('keterangan_pembayaran', 'Pendaftaran Ulang')
            ->pluck('jumlah_pembayaran')
            ->first();
        $iuran_bulanan = MasterAdmin::where('jenis_pembayaran', 'iuran')
            ->sum('jumlah_pembayaran');
        $tamrin = MasterAdmin::where('jenis_pembayaran', 'semester')
            ->where('keterangan_pembayaran', 'Semester')
            ->pluck('jumlah_pembayaran')
            ->first();

        $jenisPembayaran = [
            'daftar_ulang' => $daftar_ulang,
            'iuran_bulanan' => $iuran_bulanan,
            'tamrin' => $tamrin,
        ];
        $currentSemester = SemesterHelper::getCurrentSemester();

        foreach ($santriIds as $santriId) {
            foreach ($jenisPembayaran as $jenis => $jumlah) {
                Pembayaran::factory()->create([
                    'id_santri' => $santriId,
                    'jenis_pembayaran' => $jenis,
                    'jumlah_pembayaran' => $jumlah,
                    'jumlah_bayar' => 0,
                    'tahun_ajaran' => $currentSemester['tahun'],
                    'semester_ajaran' => $currentSemester['semester'],
                ]);
            }
        }
    }
}
