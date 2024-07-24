<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use App\Models\Pengajar;
use Illuminate\Http\Request;

class WaliDaftarPengajarController extends Controller
{
    public function index()
    {
        $data['title'] = 'Daftar Pengajar';

        $pengajars = Pengajar::all();

        return view('wali.informasi.daftar_pengajar', [
            'pengajars' => $pengajars,
        ], $data);
    }
}
