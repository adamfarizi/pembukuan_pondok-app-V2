<?php

namespace App\Console;

use App\Models\Santri;
use App\Models\Pembayaran;
use App\Helpers\TagihanHelper;
use App\Helpers\SemesterHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Daftar Ulang: Setiap tahun di bulan Januari
        $schedule->call(function () {
            $this->createPembayaranDaftarUlangAndSendEmails();
        })->yearlyOn(1, 1)->name('pembayaran_daftar_ulang'); // Setiap tahun pada 1 Januari
        // })->everyMinute()->name('pembayaran_daftar_ulang');

        // Tamrin: Setiap tahun pada bulan Januari
        $schedule->call(function () {
            $this->createPembayaranTamrinAndSendEmails();
        })->yearlyOn(1, 1)->name('pembayaran_semester_genap'); // Setiap tahun pada 1 Januari
        // })->everyMinute()->name('pembayaran_semester_genap');

        // Tamrin: Setiap tahun pada bulan Juli
        $schedule->call(function () {
            $this->createPembayaranTamrinAndSendEmails();
        })->yearlyOn(7, 1)->name('pembayaran_semester_ganjil'); // Setiap tahun pada 1 Juli

        // Iuran: Setiap bulan
        $schedule->call(function () {
            $this->createPembayaranIuranAndSendEmails();
        })->monthly()->name('pembayaran_iuran_bulanan'); // Setiap bulan
        // })->everyMinute()->name('pembayaran_iuran_bulanan');
    }


    public function createPembayaranDaftarUlangAndSendEmails()
    {
        $currentYear = now()->year;

        // Ambil hanya ID santri beserta status mukim dan jenis kelamin
        $santriList = Santri::where('status_aktif_santri', 'aktif')
            ->get(['id_santri', 'status_santri', 'jenis_kelamin_santri', 'bebas_daftar_ulang'])
            ->mapWithKeys(function ($santri) {
                return [
                    $santri->id_santri => [
                        'status_santri' => $santri->status_santri,
                        'jenis_kelamin_santri' => $santri->jenis_kelamin_santri,
                        'bebas_daftar_ulang' => $santri->bebas_daftar_ulang
                    ]
                ];
            })->toArray();

        foreach ($santriList as $id_santri => $santri) {
            // Konversi nilai status santri agar sesuai dengan MasterAdmin
            $jenis_mukim = ($santri['status_santri'] === 'mukim') ? 'mukim' : 'tdk_mukim';
            $jenis_santri = ($santri['jenis_kelamin_santri'] === 'laki-laki') ? 'l' : 'p';

            //status pembayaran
            $status_pembayaran = ($santri['bebas_daftar_ulang'] === 'true') ? 'bebas_tagihan' : 'belum_lunas';

            // Cek apakah tagihan sudah ada, sesuai dengan jenis pembayaran
            $existingPembayaran = Pembayaran::where('id_santri', $id_santri)
                ->where('jenis_pembayaran', 'daftar_ulang')
                ->whereYear('created_at', now()->year)
                ->where('tahun_ajaran', $currentYear)
                ->exists();

            if ($existingPembayaran) {
                Log::info("Tagihan pendaftaran ulang untuk santri ID $id_santri sudah ada.");
                continue;
            }

            // Jika belum ada tagihan, buat tagihan baru
            if (!$existingPembayaran) {
                TagihanHelper::createPembayaranPendaftaranUlang($id_santri, $jenis_mukim, $jenis_santri, $status_pembayaran);
            }
        }

        Log::info('Executing Create Daftar Ulang');
    }

    public function createPembayaranTamrinAndSendEmails()
    {
        $currentYear = now()->year;
        $currentSemester = SemesterHelper::getCurrentSemester();

        // Ambil hanya ID santri beserta status mukim dan jenis kelamin
        $santriList = Santri::where('status_aktif_santri', 'aktif')
            ->get(['id_santri', 'status_santri', 'jenis_kelamin_santri', 'bebas_semester'])
            ->mapWithKeys(function ($santri) {
                return [
                    $santri->id_santri => [
                        'status_santri' => $santri->status_santri,
                        'jenis_kelamin_santri' => $santri->jenis_kelamin_santri,
                        'bebas_semester' => $santri->bebas_semester
                    ]
                ];
            })->toArray();

        foreach ($santriList as $id_santri => $santri) {
            // Konversi nilai status santri agar sesuai dengan MasterAdmin
            $jenis_mukim = ($santri['status_santri'] === 'mukim') ? 'mukim' : 'tdk_mukim';
            $jenis_santri = ($santri['jenis_kelamin_santri'] === 'laki-laki') ? 'l' : 'p';

            //status pembayaran
            $status_pembayaran = ($santri['bebas_semester'] === 'true') ? 'bebas_tagihan' : 'belum_lunas';

            // Cek apakah tagihan sudah ada, sesuai dengan jenis pembayaran
            $existingPembayaran = Pembayaran::where('id_santri', $id_santri)
                ->where('jenis_pembayaran', 'tamrin')
                ->whereYear('created_at', now()->year)
                ->where('tahun_ajaran', $currentYear)
                ->where('semester_ajaran', $currentSemester['semester'])
                ->exists();

            if ($existingPembayaran) {
                Log::info("Tagihan semester untuk santri ID $id_santri sudah ada.");
                continue;
            }

            // Jika belum ada tagihan, buat tagihan baru
            if (!$existingPembayaran) {
                TagihanHelper::createPembayaranSemester($id_santri, $jenis_mukim, $jenis_santri, $status_pembayaran);
            }
        }

        Log::info('Executing Create Tamrin');
    }

    public function createPembayaranIuranAndSendEmails()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        // Ambil hanya ID santri beserta status mukim dan jenis kelamin
        $santriList = Santri::where('status_aktif_santri', 'aktif')
            ->get(['id_santri', 'status_santri', 'jenis_kelamin_santri', 'bebas_iuran'])
            ->mapWithKeys(function ($santri) {
                return [
                    $santri->id_santri => [
                        'status_santri' => $santri->status_santri,
                        'jenis_kelamin_santri' => $santri->jenis_kelamin_santri,
                        'bebas_iuran' => $santri->bebas_iuran
                    ]
                ];
            })->toArray();

        foreach ($santriList as $id_santri => $santri) {
            // Konversi nilai status santri agar sesuai dengan MasterAdmin
            $jenis_mukim = ($santri['status_santri'] === 'mukim') ? 'mukim' : 'tdk_mukim';
            $jenis_santri = ($santri['jenis_kelamin_santri'] === 'laki-laki') ? 'l' : 'p';

            //status pembayaran
            $status_pembayaran = ($santri['bebas_iuran'] === 'true') ? 'bebas_tagihan' : 'belum_lunas';

            // Cek apakah tagihan sudah ada, sesuai dengan jenis pembayaran
            $existingPembayaran = Pembayaran::where('id_santri', $id_santri)
                ->where('jenis_pembayaran', 'iuran_bulanan')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->exists();

            if ($existingPembayaran) {
                Log::info("Tagihan iuran bulanan untuk santri ID $id_santri sudah ada.");
                continue;
            }

            // Jika belum ada tagihan, buat tagihan baru
            if (!$existingPembayaran) {
                TagihanHelper::createPembayaranIuran($id_santri, $jenis_mukim, $jenis_santri, $status_pembayaran);
            }
        }

        Log::info('Executing Create Iuran');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
