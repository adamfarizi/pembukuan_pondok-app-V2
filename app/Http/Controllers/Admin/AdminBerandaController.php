<?php

namespace App\Http\Controllers\Admin;

use App\Models\Santri;
use App\Models\Pemasukan;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminBerandaController extends Controller
{
    public function index()
    {
        $data['title'] = 'Beranda';

        //* total pemasukan
        $pembayaran = Pembayaran::where('status_pembayaran', 'lunas')->pluck('jumlah_pembayaran')->sum();
        $pemasukan = Pemasukan::pluck('jumlah_pemasukan')->sum();
        $totalpemasukan = $pembayaran + $pemasukan;

        //* total pengeluaran
        $totalpengeluaran = Pengeluaran::pluck('jumlah_pengeluaran')->sum();

        //* total keuangan
        $totalkeuangan = $totalpemasukan - $totalpengeluaran;

        //*total santri
        $totalsantri = Santri::count();

        //* Buat keterangan berdasarkan data yang dihasilkan
        $keteranganPemasukan = "Pemasukan pondok bulan ini telah mencapai target bulanan.";
        $keteranganPengeluaran = "Pengeluaran bulan ini lebih rendah dari bulan sebelumnya.";
        $keteranganKeuangan = "Keuangan total stabil dengan pemasukan dan pengeluaran seimbang.";
        $keteranganSantri = "Jumlah santri stabil tanpa ada penurunan.";

        //* chart keuangan
        // Ambil data pemasukan
        $chartDataPemasukan = Pembayaran::where('status_pembayaran', 'lunas')
            ->whereYear('tanggal_pembayaran', now()->year)
            ->select(
                Pembayaran::raw('YEAR(tanggal_pembayaran) as tahun'),
                Pembayaran::raw('MONTH(tanggal_pembayaran) as bulan'),
                Pembayaran::raw('SUM(jumlah_pembayaran) as total_pemasukan')
            )
            ->groupBy('tahun', 'bulan')
            ->unionAll(
                Pemasukan::select(
                    Pemasukan::raw('YEAR(tanggal_pemasukan) as tahun'),
                    Pemasukan::raw('MONTH(tanggal_pemasukan) as bulan'),
                    Pemasukan::raw('SUM(jumlah_pemasukan) as total_pemasukan')
                )
                    ->whereYear('tanggal_pemasukan', now()->year)
                    ->groupBy('tahun', 'bulan')
                    ->getQuery()
            )
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get();

        // Ambil data pengeluaran
        $chartDataPengeluaran = Pengeluaran::select(
            Pengeluaran::raw('YEAR(tanggal_pengeluaran) as tahun'),
            Pengeluaran::raw('MONTH(tanggal_pengeluaran) as bulan'),
            Pengeluaran::raw('SUM(jumlah_pengeluaran) as total_pengeluaran')
        )
            ->whereYear('tanggal_pengeluaran', now()->year)
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get();

        // Gabungkan data pemasukan dan pengeluaran
        $mergedData = [];

        // Proses penggabungan data pemasukan dan pengeluaran dalam 1 array berdasarkan bulan dan tahun
        foreach ($chartDataPemasukan as $pemasukan) {
            $key = $pemasukan->tahun . '-' . $pemasukan->bulan;

            // Jika data untuk bulan dan tahun ini belum ada, inisialisasi
            if (!isset($mergedData[$key])) {
                $mergedData[$key] = [
                    'tahun' => $pemasukan->tahun,
                    'bulan' => $pemasukan->bulan,
                    'total_pemasukan' => $pemasukan->total_pemasukan,
                    'total_pengeluaran' => 0,
                ];
            } else {
                // Tambahkan total pemasukan jika sudah ada entry untuk bulan dan tahun ini
                $mergedData[$key]['total_pemasukan'] += $pemasukan->total_pemasukan;
            }
        }

        foreach ($chartDataPengeluaran as $pengeluaran) {
            $key = $pengeluaran->tahun . '-' . $pengeluaran->bulan;

            // Jika data untuk bulan dan tahun ini sudah ada, tambahkan total pengeluaran
            if (isset($mergedData[$key])) {
                $mergedData[$key]['total_pengeluaran'] += $pengeluaran->total_pengeluaran;
            } else {
                // Jika data belum ada, inisialisasi dengan data pengeluaran
                $mergedData[$key] = [
                    'tahun' => $pengeluaran->tahun,
                    'bulan' => $pengeluaran->bulan,
                    'total_pemasukan' => 0,
                    'total_pengeluaran' => $pengeluaran->total_pengeluaran,
                ];
            }
        }

        // Ubah ke format array yang diurutkan berdasarkan tahun dan bulan
        $mergedData = collect($mergedData)->sort(function ($a, $b) {
            return $a['tahun'] == $b['tahun'] ? $a['bulan'] - $b['bulan'] : $a['tahun'] - $b['tahun'];
        })->values()->all();

        //* chart santri
        $totalMaleSantri = Santri::where('jenis_kelamin_santri', 'laki-laki')->count();
        $totalFemaleSantri = Santri::where('jenis_kelamin_santri', 'perempuan')->count();

        return view('admin.beranda.beranda', [
            'totalpemasukan' => $totalpemasukan,
            'totalpengeluaran' => $totalpengeluaran,
            'totalkeuangan' => $totalkeuangan,
            'totalsantri' => $totalsantri,
            'chartDataKeuangan' => $mergedData,
            'totalMaleSantri' => $totalMaleSantri,
            'totalFemaleSantri' => $totalFemaleSantri,
            'keteranganPemasukan' => $keteranganPemasukan,
            'keteranganPengeluaran' => $keteranganPengeluaran,
            'keteranganKeuangan' => $keteranganKeuangan,
            'keteranganSantri' => $keteranganSantri,
        ], $data);
        
    }
}
