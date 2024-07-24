<?php

namespace App\Http\Controllers\Wali;

use App\Models\Santri;
use App\Models\PointSantri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers\SemesterHelper;

class WaliCekPointController extends Controller
{
    public function index()
    {
        $data['title'] = 'Cek Point';

        $id_santri = Auth::user()->id_santri;

        $santri = Santri::where('id_santri', $id_santri)->first();

        $currentSemester = SemesterHelper::getCurrentSemester();

        $point_santris = PointSantri::where('id_santri', $id_santri)
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->orderBy('tanggal_point_santri', 'desc')
            ->get();

        return view('wali.progres_santri.cek_point', [
            'santri' => $santri,
            'point_santris' => $point_santris,
            'currentSemester' => $currentSemester
        ], $data);
    }
}
