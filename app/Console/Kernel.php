<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\Santri;
use App\Models\Pembayaran;
use App\Models\WaliSantri;
use App\Models\MasterAdmin;
use App\Helpers\TagihanHelper;
use App\Helpers\SemesterHelper;
use App\Mail\TagihanNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
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
            $tagihanExists = Pembayaran::where('jenis_pembayaran', 'daftar_ulang')
                ->whereYear('created_at', now()->year)
                ->exists();

            if (!$tagihanExists) {
                $this->createPembayaranDaftarUlangAndSendEmails();
                //Log::info('Pembayaran Daftar Ulang berhasil dibuat.');
            } else {
                //Log::info('Pembayaran Daftar Ulang sudah ada untuk tahun ini.');
            }
        })->yearlyOn(1, 1)->name('pembayaran_daftar_ulang'); // Setiap tahun pada 1 Januari

        // Tamrin: Setiap tahun pada bulan Januari
        $schedule->call(function () {
            $tagihanExists = Pembayaran::where('jenis_pembayaran', 'tamrin')
                ->whereYear('created_at', now()->year)
                ->where('semester_ajaran', 'genap')
                ->exists();

            if (!$tagihanExists) {
                $this->createPembayaranTamrinAndSendEmails();
                //Log::info('Pembayaran Tamrin untuk semester Genap berhasil dibuat.');
            } else {
                //Log::info('Pembayaran Tamrin untuk semester Genap sudah ada.');
            }
        })->yearlyOn(1, 1)->name('pembayaran_semester_genap'); // Setiap tahun pada 1 Januari

        // Tamrin: Setiap tahun pada bulan Juni
        $schedule->call(function () {
            $tagihanExists = Pembayaran::where('jenis_pembayaran', 'tamrin')
                ->whereYear('created_at', now()->year)
                ->where('semester_ajaran', 'ganjil')
                ->exists();

            if (!$tagihanExists) {
                $this->createPembayaranTamrinAndSendEmails();
                //Log::info('Pembayaran Tamrin untuk semester Ganjil berhasil dibuat.');
            } else {
                //Log::info('Pembayaran Tamrin untuk semester Ganjil sudah ada.');
            }
        })->yearlyOn(6, 1)->name('pembayaran_semester_ganjil'); // Setiap tahun pada 1 Juni

        // Iuran: Setiap bulan
        $schedule->call(function () {
            $currentMonth = now()->format('Y-m');
            $tagihanExists = Pembayaran::where('jenis_pembayaran', 'iuran_bulanan')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->exists();

            if (!$tagihanExists) {
                $this->createPembayaranIuranAndSendEmails();
                //Log::info('Pembayaran Iuran untuk bulan ' . $currentMonth . ' berhasil dibuat.');
            } else {
                //Log::info('Pembayaran Iuran untuk bulan ' . $currentMonth . ' sudah ada.');
            }
        })->monthly()->name('pembayaran_iuran_bulanan'); // Setiap bulan
    }


    public function createPembayaranDaftarUlangAndSendEmails()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $currentSemester = SemesterHelper::getCurrentSemester();

        // Ambil hanya ID santri beserta status mukim dan jenis kelamin
        $santriList = Santri::get(['id_santri', 'status_santri', 'jenis_kelamin_santri'])
            ->mapWithKeys(function ($santri) {
                return [
                    $santri->id_santri => [
                        'status_santri' => $santri->status_santri,
                        'jenis_kelamin_santri' => $santri->jenis_kelamin_santri
                    ]
                ];
            })->toArray();

        foreach ($santriList as $id_santri => $santri) {
            // Konversi nilai status santri agar sesuai dengan MasterAdmin
            $jenis_mukim = ($santri['status_santri'] === 'mukim') ? 'mukim' : 'tdk_mukim';
            $jenis_santri = ($santri['jenis_kelamin_santri'] === 'laki-laki') ? 'l' : 'p';

            // Cek apakah tagihan sudah ada, sesuai dengan jenis pembayaran
            $existingPembayaran = Pembayaran::where('id_santri', $id_santri)
                ->where('jenis_pembayaran', 'daftar_ulang')
                ->where('tahun_ajaran', $currentYear)
                ->exists();

            if ($existingPembayaran) {
                Log::info("Tagihan pendaftaran ulang untuk santri ID $id_santri sudah ada.");
                continue;
            }

            // Jika belum ada tagihan, buat tagihan baru
            if (!$existingPembayaran) {
                TagihanHelper::createPembayaranPendaftaranUlang($id_santri, $jenis_mukim, $jenis_santri);
            }
        }

        Log::info('Executing Create Daftar Ulang');
    }

    public function createPembayaranTamrinAndSendEmails()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $currentSemester = SemesterHelper::getCurrentSemester();

        // Ambil hanya ID santri beserta status mukim dan jenis kelamin
        $santriList = Santri::get(['id_santri', 'status_santri', 'jenis_kelamin_santri'])
            ->mapWithKeys(function ($santri) {
                return [
                    $santri->id_santri => [
                        'status_santri' => $santri->status_santri,
                        'jenis_kelamin_santri' => $santri->jenis_kelamin_santri
                    ]
                ];
            })->toArray();

        foreach ($santriList as $id_santri => $santri) {
            // Konversi nilai status santri agar sesuai dengan MasterAdmin
            $jenis_mukim = ($santri['status_santri'] === 'mukim') ? 'mukim' : 'tdk_mukim';
            $jenis_santri = ($santri['jenis_kelamin_santri'] === 'laki-laki') ? 'l' : 'p';

            // Cek apakah tagihan sudah ada, sesuai dengan jenis pembayaran
            $existingPembayaran = Pembayaran::where('id_santri', $id_santri)
                ->where('jenis_pembayaran', 'tamrin')
                ->where('tahun_ajaran', $currentYear)
                ->where('semester_ajaran', $currentSemester['semester'])
                ->exists();

            if ($existingPembayaran) {
                Log::info("Tagihan semester untuk santri ID $id_santri sudah ada.");
                continue;
            }

            // Jika belum ada tagihan, buat tagihan baru
            if (!$existingPembayaran) {
                TagihanHelper::createPembayaranSemester($id_santri, $jenis_mukim, $jenis_santri);
            }
        }

        Log::info('Executing Create Tamrin');
    }

    public function createPembayaranIuranAndSendEmails()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $currentSemester = SemesterHelper::getCurrentSemester();

        // Ambil hanya ID santri beserta status mukim dan jenis kelamin
        $santriList = Santri::get(['id_santri', 'status_santri', 'jenis_kelamin_santri'])
            ->mapWithKeys(function ($santri) {
                return [
                    $santri->id_santri => [
                        'status_santri' => $santri->status_santri,
                        'jenis_kelamin_santri' => $santri->jenis_kelamin_santri
                    ]
                ];
            })->toArray();

        foreach ($santriList as $id_santri => $santri) {
            // Konversi nilai status santri agar sesuai dengan MasterAdmin
            $jenis_mukim = ($santri['status_santri'] === 'mukim') ? 'mukim' : 'tdk_mukim';
            $jenis_santri = ($santri['jenis_kelamin_santri'] === 'laki-laki') ? 'l' : 'p';

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
                TagihanHelper::createPembayaranIuran($id_santri, $jenis_mukim, $jenis_santri);
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
