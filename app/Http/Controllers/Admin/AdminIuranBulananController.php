<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Helpers\SemesterHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AdminIuranBulananController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Iuran Bulanan';

        $currentSemester = SemesterHelper::getCurrentSemester();
        $currentMonth = Carbon::now()->locale('id')->translatedFormat('F');
        
        $startOfMonth = Carbon::now()->startOfMonth()->startOfDay()->toDateTimeString(); // Awal bulan, pukul 00:00:00
        $endOfMonth = Carbon::now()->endOfMonth()->endOfDay()->toDateTimeString();       // Akhir bulan, pukul 23:59:59

        if ($request->ajax()) {
            $data = Pembayaran::orderBy('created_at', 'desc')
                ->where('semester_ajaran', $currentSemester['semester'])
                ->where('tahun_ajaran', $currentSemester['tahun'])
                ->where('jenis_pembayaran', 'iuran_bulanan')
                ->where('status_pembayaran', 'lunas')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->with(['santri', 'user'])
                ->get();
            return DataTables::of($data)
                ->make(true);
        }

        $pembayarans = Pembayaran::orderBy('created_at', 'desc')
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->where('jenis_pembayaran', 'iuran_bulanan')
            ->where('status_pembayaran', 'belum_lunas')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->with(['santri', 'user'])
            ->get();

        return view('admin.pembayaran.iuran_bulanan', [
            'currentSemester' => $currentSemester,
            'currentMonth' => $currentMonth,
            'pembayarans' => $pembayarans,
        ], $data);
    }

    public function select2(Request $request)
    {
        $currentSemester = SemesterHelper::getCurrentSemester();

        $startOfMonth = Carbon::now()->startOfMonth()->startOfDay()->toDateTimeString(); // Awal bulan, pukul 00:00:00
        $endOfMonth = Carbon::now()->endOfMonth()->endOfDay()->toDateTimeString();       // Akhir bulan, pukul 23:59:59

        $data = Pembayaran::orderBy('created_at', 'desc')
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->where('jenis_pembayaran', 'iuran_bulanan')
            ->where('status_pembayaran', 'belum_lunas')
            ->where('jumlah_bayar', 0)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->whereHas('santri', function ($query) use ($request) {
                if ($request->has('q') && !empty($request->q)) {
                    $query->where('nama_santri', 'like', '%' . $request->q . '%');
                }
            })
            ->with(['santri', 'user'])
            ->get();

        return response()->json($data);
    }

    public function edit(Request $request, $id_santri)
    {
        $currentSemester = SemesterHelper::getCurrentSemester();
        $pembayaran = Pembayaran::where('id_santri', $id_santri)
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->where('jenis_pembayaran', 'iuran_bulanan')
            ->where('status_pembayaran', 'belum_lunas')
            ->first();

        if ($pembayaran) {
            $pembayaran->tanggal_pembayaran = now();
            $pembayaran->id_admin = Auth::user()->id_admin;
            $pembayaran->status_pembayaran = 'lunas';
            $pembayaran->jumlah_bayar = $pembayaran->jumlah_pembayaran;
            $pembayaran->save();

            return redirect()->route('iuran_bulanan')->with('success', 'Data pembayaran berhasil ditambahkan.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Error: Data tidak ditemukan']);
        }
    }
}
