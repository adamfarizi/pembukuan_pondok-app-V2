<?php

namespace App\Helpers;

use App\Models\Pembayaran;
use App\Models\MasterAdmin;
use App\Helpers\SemesterHelper;

class TagihanHelper
{
    public static function createPembayaranPendaftaranBaru($id_santri, $jenis_mukim, $jenis_santri)
    {
        $currentSemester = SemesterHelper::getCurrentSemester();

        $master = MasterAdmin::get();

        // Create Pembayaran Daftar Baru
        $total_pembayaran = $master->where('jenis_pembayaran', 'pendaftaran_baru')
            ->where('jenis_mukim', $jenis_mukim)
            ->where('jenis_santri', $jenis_santri)
            ->pluck('total_pembayaran')
            ->first();
        if ($total_pembayaran > 0) {
            Pembayaran::create([
                'id_santri' => $id_santri,
                'id_admin' => null,
                'tanggal_pembayaran' => null,
                'jumlah_pembayaran' => $total_pembayaran,
                'jumlah_bayar' => 0,
                'jenis_pembayaran' => 'daftar_ulang',
                'status_pembayaran' => 'belum_lunas',
                'tahun_ajaran' => $currentSemester['tahun'],
                'semester_ajaran' => $currentSemester['semester'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }

    public static function createPembayaranPendaftaranUlang($id_santri, $jenis_mukim, $jenis_santri)
    {
        $currentSemester = SemesterHelper::getCurrentSemester();

        $master = MasterAdmin::get();

        // Create Pembayaran Daftar Baru
        $total_pembayaran = $master->where('jenis_pembayaran', 'pendaftaran_ulang')
            ->where('jenis_mukim', $jenis_mukim)
            ->where('jenis_santri', $jenis_santri)
            ->pluck('total_pembayaran')
            ->first();
        if ($total_pembayaran > 0) {
            Pembayaran::create([
                'id_santri' => $id_santri,
                'id_admin' => null,
                'tanggal_pembayaran' => null,
                'jumlah_pembayaran' => $total_pembayaran,
                'jumlah_bayar' => 0,
                'jenis_pembayaran' => 'daftar_ulang',
                'status_pembayaran' => 'belum_lunas',
                'tahun_ajaran' => $currentSemester['tahun'],
                'semester_ajaran' => $currentSemester['semester'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }

    public static function createPembayaranSemester($id_santri, $jenis_mukim, $jenis_santri)
    {
        $currentSemester = SemesterHelper::getCurrentSemester();

        $master = MasterAdmin::get();

        // Create Pembayaran Semester
        $total_pembayaran_semester = $master->where('jenis_pembayaran', 'semester')
            ->where('jenis_mukim', $jenis_mukim)
            ->where('jenis_santri', $jenis_santri)
            ->pluck('total_pembayaran')
            ->first();
        if ($total_pembayaran_semester > 0) {
            Pembayaran::create([
                'id_santri' => $id_santri,
                'id_admin' => null,
                'tanggal_pembayaran' => null,
                'jumlah_pembayaran' => $total_pembayaran_semester,
                'jumlah_bayar' => 0,
                'jenis_pembayaran' => 'tamrin',
                'status_pembayaran' => 'belum_lunas',
                'tahun_ajaran' => $currentSemester['tahun'],
                'semester_ajaran' => $currentSemester['semester'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public static function createPembayaranIuran($id_santri, $jenis_mukim, $jenis_santri)
    {
        $currentSemester = SemesterHelper::getCurrentSemester();

        $master = MasterAdmin::get();

        // Create Pembayaran Iuran
        $total_pembayaran_iuran = $master->where('jenis_pembayaran', 'iuran')
            ->where('jenis_mukim', $jenis_mukim)
            ->where('jenis_santri', $jenis_santri)
            ->sum('total_pembayaran');
        if ($total_pembayaran_iuran > 0) {
            Pembayaran::create([
                'id_santri' => $id_santri,
                'id_admin' => null,
                'tanggal_pembayaran' => null,
                'jumlah_pembayaran' => $total_pembayaran_iuran,
                'jumlah_bayar' => 0,
                'jenis_pembayaran' => 'iuran_bulanan',
                'status_pembayaran' => 'belum_lunas',
                'tahun_ajaran' => $currentSemester['tahun'],
                'semester_ajaran' => $currentSemester['semester'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
