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
        $pembayaran = Pembayaran::where('status_pembayaran', 'lunas')->pluck('jumlah_pembayaran')->sum();
        $pemasukan = Pemasukan::pluck('jumlah_pemasukan')->sum();
        $totalpemasukan = $pembayaran + $pemasukan;

        //* total pengeluaran
        $totalpengeluaran = Pengeluaran::pluck('jumlah_pengeluaran')->sum();

        //* total keuangan
        $totalkeuangan = $totalpemasukan - $totalpengeluaran;

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

        $pengeluarans = Pengeluaran::all();

        return view('admin.laporan_keuangan.laporan_keuangan', [
            'totalpemasukan' => $totalpemasukan,
            'totalpengeluaran' => $totalpengeluaran,
            'totalkeuangan' => $totalkeuangan,
            'chartDataKeuangan' => $mergedData,
            'pengeluarans' => $pengeluarans,
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
                    'user_nama' => $pembayaran->user->nama_admin ?? 'Tidak ada',
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
                    'user_nama' => $pemasukan->user->nama_admin ?? 'Tidak ada',
                ];
            });

        // Pilih data untuk ditampilkan
        if ($pembayarans->isEmpty() && $pemasukans->isEmpty()) {
            // Jika kedua data kosong
            $data = collect(); // Kosong
        } elseif ($pembayarans->isEmpty()) {
            // Jika pembayaran kosong, tampilkan hanya pemasukan
            $data = $pemasukans;
        } elseif ($pemasukans->isEmpty()) {
            // Jika pemasukan kosong, tampilkan hanya pembayaran
            $data = $pembayarans;
        } else {
            // Jika keduanya ada, gabungkan data dari dua tabel
            $data = $pembayarans->merge($pemasukans);
        }

        return DataTables::of($data)
            ->addColumn('santri_nama', function ($item) {
                return $item['santri_nama'];
            })
            ->addColumn('jumlah_pemasukan', function ($item) {
                return $item['jumlah_pemasukan'];
            })
            ->addColumn('tanggal_pemasukan', function ($item) {
                return $item['tanggal_pemasukan'];
            })
            ->addColumn('user_nama', function ($item) {
                return $item['user_nama'];
            })
            ->addColumn('jenis_pemasukan', function ($item) {
                return $item['jenis_pemasukan'];
            })
            ->make(true);
    }

    public function getPengeluaran()
    {
        $data = Pengeluaran::orderBy('tanggal_pengeluaran', 'desc')->get();

        return DataTables::of($data)
                ->make(true);
    }

}
