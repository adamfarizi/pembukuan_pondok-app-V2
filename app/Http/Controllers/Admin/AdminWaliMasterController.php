<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminWaliMasterController extends Controller
{
    public function index()
    {
        $data['title'] = 'Master Wali';
        return view ('admin.master.master_wali', $data);
    }
}
