<?php

namespace App\Http\Controllers\Guest;

use App\Models\Pengajar;
use App\Models\Santri;
use App\Models\MasterGuest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GuestBerandaController extends Controller
{
    public function index()
    {
        $data['title'] = 'Beranda';

        $imageFiles = glob(public_path('gambar_pondok/*'));
        $imageFiles = array_diff($imageFiles, ['.', '..']);
        $imageNames = [];
        foreach ($imageFiles as $imageFile) {
            $imageNames[] = basename($imageFile);
        }

        $total_santri = Santri::count();
        $total_guru = Pengajar::count();
        $guests = MasterGuest::with(['misi'])->get();

        return view('guest.beranda.beranda', [
            'imageNames' => $imageNames,
            'total_santri' => $total_santri,
            'total_guru' => $total_guru,
            'guests' => $guests,
        ], $data);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Authenticate admin
        if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password], $request->filled('remember'))) {
            return redirect()->route('admin-beranda');
        }

        // Authenticate wali
        if (Auth::guard('wali_santri')->attempt(['email' => $email, 'password' => $password], $request->filled('remember'))) {
            return redirect()->route('wali-beranda');
        }

        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout()
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } elseif (Auth::guard('wali_santri')->check()) {
            Auth::guard('wali_santri')->logout();
        }

        return redirect()->route('login');
    }
}
