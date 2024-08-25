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
        // $schedule->call(function () {
        //     $this->createPembayaranDaftarUlangAndSendEmails();
        // })->yearlyOn(1, 1); // Setiap tahun pada 1 Januari

        // // Iuran: Setiap tahun pada bulan Januari
        // $schedule->call(function () {
        //     $this->createPembayaranIuranAndSendEmails();
        // })->yearlyOn(1, 1); // Setiap tahun pada 1 Januari

        // // Iuran: Setiap tahun pada bulan Juni
        // $schedule->call(function () {
        //     $this->createPembayaranIuranAndSendEmails();
        // })->yearlyOn(6, 1); // Setiap tahun pada 1 Juni

        // // Tamrin: Setiap bulan
        // $schedule->call(function () {
        //     $this->createPembayaranTamrinAndSendEmails();
        // })->monthly(); // Setiap bulan


        // Test mengirim email
        $schedule->call(function () {
            $this->createPembayaranDaftarUlangAndSendEmails();
        })->everyMinute();
        $schedule->call(function () {
            $this->createPembayaranIuranAndSendEmails();
        })->everyMinute();
        $schedule->call(function () {
            $this->createPembayaranTamrinAndSendEmails();
        })->everyMinute();
    }

    public function createPembayaranDaftarUlangAndSendEmails()
    {
        $currentMonth = Carbon::now()->month;
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
            $tagihans = [];
            foreach ($jenisPembayaran as $jenis => $jumlah) {
                $pembayaran = Pembayaran::create([
                    'id_santri' => $santriId,
                    'jenis_pembayaran' => $jenis,
                    'jumlah_pembayaran' => $jumlah,
                    'jumlah_bayar' => 0,
                    'tahun_ajaran' => $currentSemester['tahun'],
                    'semester_ajaran' => $currentSemester['semester'],
                ]);

                $tagihans[] = $pembayaran;
            }

            // Kirim email ke wali santri
            $waliSantri = WaliSantri::where('id_santri', $santriId)->first();
            if ($waliSantri) {
                Mail::to($waliSantri->email)->send(new TagihanNotification($tagihans));
            }
        }
    }
    public function createPembayaranTamrinAndSendEmails()
    {
        $currentMonth = Carbon::now()->month;
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
            $tagihans = [];
            foreach ($jenisPembayaran as $jenis => $jumlah) {
                $pembayaran = Pembayaran::create([
                    'id_santri' => $santriId,
                    'jenis_pembayaran' => $jenis,
                    'jumlah_pembayaran' => $jumlah,
                    'jumlah_bayar' => 0,
                    'tahun_ajaran' => $currentSemester['tahun'],
                    'semester_ajaran' => $currentSemester['semester'],
                ]);

                $tagihans[] = $pembayaran;
            }

            // Kirim email ke wali santri
            $waliSantri = WaliSantri::where('id_santri', $santriId)->first();
            if ($waliSantri) {
                Mail::to($waliSantri->email)->send(new TagihanNotification($tagihans));
            }
        }
    }
    public function createPembayaranIuranAndSendEmails()
    {
        $currentMonth = Carbon::now()->month;
        $santriIds = Santri::pluck('id_santri')->toArray();

        $master = MasterAdmin::get();

        $total_iuran = $master->where('jenis_pembayaran', 'iuran')
            ->sum('jumlah_pembayaran');

        $jenisPembayaran = [
            'iuran_bulanan' => $total_iuran,
        ];
        $currentSemester = SemesterHelper::getCurrentSemester();

        foreach ($santriIds as $santriId) {
            $tagihans = [];
            foreach ($jenisPembayaran as $jenis => $jumlah) {
                $pembayaran = Pembayaran::create([
                    'id_santri' => $santriId,
                    'jenis_pembayaran' => $jenis,
                    'jumlah_pembayaran' => $jumlah,
                    'jumlah_bayar' => 0,
                    'tahun_ajaran' => $currentSemester['tahun'],
                    'semester_ajaran' => $currentSemester['semester'],
                ]);

                $tagihans[] = $pembayaran;
            }

            // Kirim email ke wali santri
            $waliSantri = WaliSantri::where('id_santri', $santriId)->first();
            if ($waliSantri) {
                Mail::to($waliSantri->email)->send(new TagihanNotification($tagihans));
            }
        }
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
