<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WaliBerandaController extends Controller
{
    public function index()
    {
        $data['title'] = 'Beranda';

        return view('wali.beranda.beranda', [

        ], $data);
    }
}
