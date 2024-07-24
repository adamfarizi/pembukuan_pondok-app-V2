<?php

namespace App\Http\Controllers\Wali;

use App\Models\Santri;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Helpers\SemesterHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WaliTagihanController extends Controller
{
    public function index()
    {
        $data['title'] = 'Tagihan';

        $currentSemester = SemesterHelper::getCurrentSemester();

        $id_santri = Auth::user()->id_santri;

        $santri = Santri::where('id_santri', $id_santri)->first();
        
        $TagihanPembayaran = Pembayaran::where('id_santri', $id_santri)
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->with(['santri', 'user'])
            ->orderBy('tahun_ajaran', 'asc')
            ->get();
        
        $totaltagihan = Pembayaran::where('id_santri', $id_santri)
            ->where('status_pembayaran', 'belum_lunas')
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->pluck('jumlah_pembayaran')
            ->sum();

        return view('wali.tagihan.tagihan', [
            'currentSemester' => $currentSemester,
            'santri' => $santri,
            'TagihanPembayaran' => $TagihanPembayaran,
            'totaltagihan' => $totaltagihan,
        ], $data);
    }
}
