<?php

namespace App\Http\Controllers\Wali;

use App\Models\Santri;
use App\Models\Pembayaran;
use App\Models\WaliSantri;
use Illuminate\Http\Request;
use App\Helpers\SemesterHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WaliDataPribadiSantriController extends Controller
{
    public function index()
    {
        $data['title'] = 'Data Pribadi Santri';

        $id_santri = Auth::user()->id_santri;

        $santri = Santri::where('id_santri', $id_santri)->first();

        $wali = WaliSantri::where('id_santri', $id_santri)->first();

        $currentSemester = SemesterHelper::getCurrentSemester();
        $RiwayatPembayaran = Pembayaran::where('id_santri', $id_santri)
            ->where('status_pembayaran', 'lunas')
            ->with(['santri', 'user'])
            ->orderBy('tanggal_pembayaran', 'desc')
            ->get();

        return view('wali.data_pribadi_santri.data_pribadi_santri', [
            'santri' => $santri,
            'wali' => $wali,
            'RiwayatPembayaran' => $RiwayatPembayaran,
        ], $data);
    }
}
