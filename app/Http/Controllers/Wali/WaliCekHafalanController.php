<?php

namespace App\Http\Controllers\Wali;

use App\Models\Santri;
use App\Models\Hafalan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WaliCekHafalanController extends Controller
{
    public function index()
    {
        $data['title'] = 'Cek Hafalan';

        $id_santri = Auth::user()->id_santri;

        $santri = Santri::where('id_santri', $id_santri)->first();

        $hafalans = Hafalan::where('id_santri', $id_santri)
            ->orderBy('surah', 'asc')
            ->get();

        return view('wali.progres_santri.cek_hafalan', [
            'santri' => $santri,
            'hafalans' => $hafalans
        ], $data);
    }

}
