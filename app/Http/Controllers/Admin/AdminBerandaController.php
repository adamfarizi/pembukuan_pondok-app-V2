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
        $pembayaran = Pembayaran::pluck('jumlah_pembayaran')->sum();
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
        $chartDataPemasukan = Pembayaran::where('status_pembayaran', 'lunas')
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
                    ->groupBy('tahun', 'bulan')
                    ->getQuery()
            )
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->limit(6)
            ->get();

        $chartDataPengeluaran = Pengeluaran::select(
                Pengeluaran::raw('YEAR(tanggal_pengeluaran) as tahun'),
                Pengeluaran::raw('MONTH(tanggal_pengeluaran) as bulan'),
                Pengeluaran::raw('SUM(jumlah_pengeluaran) as total_pengeluaran')
            )
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->limit(6)
            ->get();

        $mergedData = [];
        foreach ($chartDataPemasukan as $pemasukan) {
            $pengeluaran = $chartDataPengeluaran->first(function ($pengeluaran) use ($pemasukan) {
                return $pengeluaran->tahun == $pemasukan->tahun && $pengeluaran->bulan == $pemasukan->bulan;
            });

            $mergedData[] = [
                'tahun' => $pemasukan->tahun,
                'bulan' => $pemasukan->bulan,
                'total_pemasukan' => $pemasukan->total_pemasukan,
                'total_pengeluaran' => $pengeluaran ? $pengeluaran->total_pengeluaran : 0,
            ];
        }

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
