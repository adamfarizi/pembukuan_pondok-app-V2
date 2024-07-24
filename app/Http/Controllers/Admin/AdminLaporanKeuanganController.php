<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pemasukan;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Helpers\SemesterHelper;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AdminLaporanKeuanganController extends Controller
{
    public function index()
    {
        $data['title'] = 'Laporan Keuangan';

        //* pemasukan pondok
        $pembayaran = Pembayaran::pluck('jumlah_pembayaran')->sum();
        $pemasukan = Pemasukan::pluck('jumlah_pemasukan')->sum();
        $totalpemasukan = $pembayaran + $pemasukan;

        //* total pengeluaran
        $totalpengeluaran = Pengeluaran::pluck('jumlah_pengeluaran')->sum();

        //* total keuangan
        $totalkeuangan = $totalpemasukan - $totalpengeluaran;

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

        return view('admin.laporan_keuangan.laporan_keuangan', [
            'totalpemasukan' => $totalpemasukan,
            'totalpengeluaran' => $totalpengeluaran,
            'totalkeuangan' => $totalkeuangan,
            'chartDataKeuangan' => $mergedData,
        ], $data);
    }
    

    public function getPemasukan()
    {
        $currentSemester = SemesterHelper::getCurrentSemester();

        $pembayarans = Pembayaran::where('status_pembayaran', 'lunas')
            ->orderBy('tanggal_pembayaran', 'desc')
            ->with('santri', 'user')
            ->get();
        $pemasukans = Pemasukan::with('user')
            ->orderBy('created_at', 'desc')    
            ->get();

        // Gabungkan data dari dua tabel
        $data = $pembayarans->merge($pemasukans);

        return DataTables::of($data)
            ->addColumn('santri.nama_santri', function($item) {
                return $item->santri->nama_santri ?? 'Sumbangan';
            })
            ->addColumn('jumlah_pemasukan', function($item) {
                return $item->jumlah_pemasukan ?? $item->jumlah_pembayaran;
            })
            ->addColumn('tanggal_pemasukan', function($item) {
                return $item->tanggal_pembayaran ?? $item->tanggal_pemasukan;
            })
            ->addColumn('jenis_pemasukan', function($item) {
                return isset($item->jenis_pembayaran) ? $item->jenis_pembayaran : 'lainnya';
            })
            ->addColumn('user.nama_admin', function($item) {
                return $item->user->nama_admin ?? 'Lainnya';
            })
            ->make(true);
    }
}
