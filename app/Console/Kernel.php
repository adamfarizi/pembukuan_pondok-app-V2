<?php

namespace App\Console;

use App\Models\MasterAdmin;
use Carbon\Carbon;
use App\Models\Santri;
use App\Models\Pembayaran;
use App\Models\WaliSantri;
use App\Helpers\SemesterHelper;
use App\Mail\TagihanNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;


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
        })->yearlyOn(1, 1); // Setiap tahun pada 1 Januari

        // Tamrin: Setiap tahun pada bulan Januari
        $schedule->call(function () {
            $tagihanExists = Pembayaran::where('jenis_pembayaran', 'tamrin')
                ->whereYear('created_at', now()->year)
                ->where('semester_ajaran', 'Genap')
                ->exists();

            if (!$tagihanExists) {
                $this->createPembayaranTamrinAndSendEmails();
                //Log::info('Pembayaran Tamrin untuk semester Genap berhasil dibuat.');
            } else {
                //Log::info('Pembayaran Tamrin untuk semester Genap sudah ada.');
            }
        })->yearlyOn(1, 1); // Setiap tahun pada 1 Januari

        // Tamrin: Setiap tahun pada bulan Juni
        $schedule->call(function () {
            $tagihanExists = Pembayaran::where('jenis_pembayaran', 'tamrin')
                ->whereYear('created_at', now()->year)
                ->where('semester_ajaran', 'Ganjil')
                ->exists();

            if (!$tagihanExists) {
                $this->createPembayaranTamrinAndSendEmails();
                //Log::info('Pembayaran Tamrin untuk semester Ganjil berhasil dibuat.');
            } else {
                //Log::info('Pembayaran Tamrin untuk semester Ganjil sudah ada.');
            }
        })->yearlyOn(6, 1); // Setiap tahun pada 1 Juni

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
        })->monthly(); // Setiap bulan
    }


    public function createPembayaranDaftarUlangAndSendEmails()
    {
        $santriIds = Santri::pluck('id_santri')->toArray();
        $master = MasterAdmin::get();
        $jenisPembayaran = [
            'daftar_ulang' => $master->where('jenis_pembayaran', 'pendaftaran')
                ->where('keterangan_pembayaran', 'Pendaftaran Ulang')
                ->pluck('jumlah_pembayaran')
                ->first(),
        ];
        $currentSemester = SemesterHelper::getCurrentSemester();

        foreach ($santriIds as $santriId) {
            foreach ($jenisPembayaran as $jenis => $jumlah) {
                $existingTagihan = Pembayaran::where('id_santri', $santriId)
                    ->where('jenis_pembayaran', $jenis)
                    ->where('tahun_ajaran', $currentSemester['tahun'])
                    ->where('semester_ajaran', $currentSemester['semester'])
                    ->exists();

                if ($existingTagihan) {
                    //Log::info("Tagihan $jenis untuk santri ID $santriId sudah ada.");
                    continue;
                }

                Pembayaran::create([
                    'id_santri' => $santriId,
                    'jenis_pembayaran' => $jenis,
                    'jumlah_pembayaran' => $jumlah,
                    'jumlah_bayar' => 0,
                    'tahun_ajaran' => $currentSemester['tahun'],
                    'semester_ajaran' => $currentSemester['semester'],
                ]);
            }
        }

        //Log::info('Executing Create Daftar Ulang');
    }

    public function createPembayaranTamrinAndSendEmails()
    {
        $santriIds = Santri::pluck('id_santri')->toArray();
        $master = MasterAdmin::get();
        $jenisPembayaran = [
            'tamrin' => $master->where('jenis_pembayaran', 'semester')
                ->where('keterangan_pembayaran', 'Semester')
                ->pluck('jumlah_pembayaran')
                ->first(),
        ];
        $currentSemester = SemesterHelper::getCurrentSemester();

        foreach ($santriIds as $santriId) {
            foreach ($jenisPembayaran as $jenis => $jumlah) {
                $existingTagihan = Pembayaran::where('id_santri', $santriId)
                    ->where('jenis_pembayaran', $jenis)
                    ->where('tahun_ajaran', $currentSemester['tahun'])
                    ->where('semester_ajaran', $currentSemester['semester'])
                    ->exists();

                if ($existingTagihan) {
                    //Log::info("Tagihan $jenis untuk santri ID $santriId sudah ada.");
                    continue;
                }

                Pembayaran::create([
                    'id_santri' => $santriId,
                    'jenis_pembayaran' => $jenis,
                    'jumlah_pembayaran' => $jumlah,
                    'jumlah_bayar' => 0,
                    'tahun_ajaran' => $currentSemester['tahun'],
                    'semester_ajaran' => $currentSemester['semester'],
                ]);
            }
        }

        //Log::info('Executing Create Tamrin');
    }

    public function createPembayaranIuranAndSendEmails()
    {
        $santriIds = Santri::pluck('id_santri')->toArray();
        $master = MasterAdmin::get();
        $total_iuran = $master->where('jenis_pembayaran', 'iuran')
            ->sum('jumlah_pembayaran');
        $jenisPembayaran = [
            'iuran_bulanan' => $total_iuran,
        ];
        $currentSemester = SemesterHelper::getCurrentSemester();

        foreach ($santriIds as $santriId) {
            foreach ($jenisPembayaran as $jenis => $jumlah) {
                $existingTagihan = Pembayaran::where('id_santri', $santriId)
                    ->where('jenis_pembayaran', $jenis)
                    ->where('tahun_ajaran', $currentSemester['tahun'])
                    ->where('semester_ajaran', $currentSemester['semester'])
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->exists();

                if ($existingTagihan) {
                    //Log::info("Tagihan $jenis untuk santri ID $santriId sudah ada bulan ini.");
                    continue;
                }

                Pembayaran::create([
                    'id_santri' => $santriId,
                    'jenis_pembayaran' => $jenis,
                    'jumlah_pembayaran' => $jumlah,
                    'jumlah_bayar' => 0,
                    'tahun_ajaran' => $currentSemester['tahun'],
                    'semester_ajaran' => $currentSemester['semester'],
                ]);
            }
        }

        //Log::info('Executing Create Iuran');
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
