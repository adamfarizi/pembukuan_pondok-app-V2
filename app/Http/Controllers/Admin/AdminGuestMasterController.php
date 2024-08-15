<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterGuest;

class AdminGuestMasterController extends Controller
{
    public function index()
    {
        $data['title'] = 'Master Guest';
        $guests = MasterGuest::all();
        return view('admin.master.master_guest', [
            'guests' => $guests
        ], $data);
    }
}
