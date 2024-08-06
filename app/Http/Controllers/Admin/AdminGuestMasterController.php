<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminGuestMasterController extends Controller
{
    public function index()
    {
        $data['title'] = 'Master Guest';
        return view ('admin.master.master_guest', $data);
    }
}
