<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminMasterController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Master Admin';

        if ($request->ajax()) {
            $data = User::orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
            ->make(true);
        }
        
        $admins = User::orderBy('created_at', 'desc')->get();

        return view('admin.master.master_admin', [
            'admins' => $admins
        ], $data);
    }

    public function create(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama_admin' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'role' => 'required|in:super_admin,admin_pembayaran,admin_penilaian',
            'password' => 'required|string|min:8|confirmed',
            'no_hp_admin' => 'required|max:13',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Buat data admin baru
        User::create([
            'nama_admin' => $request->nama_admin,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'no_hp_admin' => $request->no_hp_admin,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Admin berhasil ditambahkan.');
    }

    public function edit(Request $request, $id_admin)
    {
        $admin = User::findOrFail($id_admin);

        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama_admin' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id_admin . ',id_admin',
            'role' => 'required|in:super_admin,admin_pembayaran,admin_penilaian',
            'password_lama' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
            'no_hp_admin' => 'required|max:13',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update data admin
        $admin->nama_admin = $request->nama_admin;
        $admin->email = $request->email;
        $admin->role = $request->role;
        $admin->no_hp_admin = $request->no_hp_admin;

        // Jika password lama dan password baru diisi, update password
        if ($request->filled('password_lama') && $request->filled('password')) {
            if (Hash::check($request->password_lama, $admin->password)) {
                $admin->password = Hash::make($request->password);
            } else {
                return redirect()->back()->withErrors(['password_lama' => 'Password lama salah'])->withInput();
            }
        }

        $admin->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Admin berhasil diperbarui.');
    }
    
    public function delete($id_admin)
    {
        $admin = User::findOrFail($id_admin);
        $admin->delete();

        return redirect()->back()->with('success', 'Admin berhasil dihapus.');
    }
}
