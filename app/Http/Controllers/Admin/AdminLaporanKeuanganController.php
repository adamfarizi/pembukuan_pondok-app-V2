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

        // Mengambil data pembayaran dengan status lunas
        $pembayarans = Pembayaran::where('status_pembayaran', 'lunas')
            ->orderBy('tanggal_pembayaran', 'desc')
            ->with('santri', 'user')
            ->get()
            ->map(function ($pembayaran) {
                return [
                    'santri_nama' => $pembayaran->santri->nama_santri ?? 'Sumbangan',
                    'jumlah_pemasukan' => $pembayaran->jumlah_pembayaran,
                    'tanggal_pemasukan' => $pembayaran->tanggal_pembayaran,
                    'jenis_pemasukan' => $pembayaran->jenis_pembayaran ?? 'lainnya',
                    'user_nama' => $pembayaran->user->nama_admin ?? 'Lainnya',
                ];
            });

        // Mengambil data pemasukan
        $pemasukans = Pemasukan::with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($pemasukan) {
                return [
                    'santri_nama' => 'Sumbangan', // Misalkan ini default untuk pemasukan
                    'jumlah_pemasukan' => $pemasukan->jumlah_pemasukan,
                    'tanggal_pemasukan' => $pemasukan->tanggal_pemasukan,
                    'jenis_pemasukan' => 'lainnya', // Misalkan default ini untuk pemasukan
                    'user_nama' => $pemasukan->user->nama_admin ?? 'Lainnya',
                ];
            });

        // Gabungkan data dari dua tabel
        $data = $pembayarans->merge($pemasukans);
        // dd($data);
        return DataTables::of($data)
            ->addColumn('santri_nama', function($item) {
                return $item['santri_nama'];
            })
            ->addColumn('jumlah_pemasukan', function($item) {
                return $item['jumlah_pemasukan'];
            })
            ->addColumn('tanggal_pemasukan', function($item) {
                return $item['tanggal_pemasukan'];
            })
            ->addColumn('user_nama', function($item) {
                return $item['user_nama'];
            })
            ->addColumn('jenis_pemasukan', function($item) {
                return $item['jenis_pemasukan'];
            })
            ->make(true);
    }
}
