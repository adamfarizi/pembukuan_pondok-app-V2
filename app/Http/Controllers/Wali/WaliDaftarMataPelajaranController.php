<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WaliDaftarMataPelajaranController extends Controller
{
    public function index()
    {
        $data['title'] = 'Daftar Mata Pelajaran';

        return view('wali.informasi.daftar_mata_pelajaran', [

        ], $data);
    }
}
