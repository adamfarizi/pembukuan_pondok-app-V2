<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Santri;
use App\Models\Pembayaran;
use App\Models\MasterAdmin;
use Illuminate\Http\Request;
use App\Helpers\TagihanHelper;
use Illuminate\Support\Carbon;
use App\Helpers\SemesterHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
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

        $currentYear = Carbon::now()->year;
        $month = carbon::now()->month;

        Carbon::setLocale('id');
        $currentMonth = Carbon::now()->translatedFormat('F');
        $currentSemester = SemesterHelper::getCurrentSemester();

        // Total Tagihan Santri
        $total_daftar_ulang = Pembayaran::where('jenis_pembayaran', 'daftar_ulang')
            ->where('tahun_ajaran', $currentYear)
            ->count('id_santri');
        $total_tamrin = Pembayaran::where('jenis_pembayaran', 'tamrin')
            ->where('tahun_ajaran', $currentYear)
            ->where('semester_ajaran', $currentSemester['semester'])
            ->count('id_santri');
        $total_iuran_bulanan = Pembayaran::where('jenis_pembayaran', 'iuran_bulanan')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $month)
            ->count('id_santri');

        // Total Tagihan Santri Belum Lunas
        $tag_daftar_ulang = Pembayaran::where('jenis_pembayaran', 'daftar_ulang')
            ->where('status_pembayaran', 'belum_lunas')
            ->where('tahun_ajaran', $currentYear)
            ->count('id_santri');
        $tag_tamrin = Pembayaran::where('jenis_pembayaran', 'tamrin')
            ->where('status_pembayaran', 'belum_lunas')
            ->where('tahun_ajaran', $currentYear)
            ->where('semester_ajaran', $currentSemester['semester'])
            ->count('id_santri');
        $tag_iuran_bulanan = Pembayaran::where('jenis_pembayaran', 'iuran_bulanan')
            ->where('status_pembayaran', 'belum_lunas')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $month)
            ->count('id_santri');

        // Total Pembayaran Setiap Jenis Pembayaran
        $daftar_baru = MasterAdmin::where('jenis_pembayaran', 'pendaftaran_baru')
            ->whereIn('jenis_mukim', ['tdk_mukim', 'mukim'])
            ->whereIn('jenis_santri', ['l', 'p'])
            ->get();
        $daftar_ulang = MasterAdmin::where('jenis_pembayaran', 'pendaftaran_ulang')
            ->whereIn('jenis_mukim', ['tdk_mukim', 'mukim'])
            ->whereIn('jenis_santri', ['l', 'p'])
            ->get();
        $semester = MasterAdmin::where('jenis_pembayaran', 'semester')
            ->whereIn('jenis_mukim', ['tdk_mukim', 'mukim'])
            ->whereIn('jenis_santri', ['l', 'p'])
            ->get();
        $iuran = MasterAdmin::where('jenis_pembayaran', 'iuran')
            ->whereIn('jenis_mukim', ['tdk_mukim', 'mukim'])
            ->whereIn('jenis_santri', ['l', 'p'])
            ->get();

        $admins = User::orderBy('created_at', 'desc')->get();

        return view('admin.master.master_admin', [
            'year' => $currentYear,
            'month' => $currentMonth,
            'smt' => $currentSemester['semester'],

            'tagihan_daftar_ulang' => $tag_daftar_ulang,
            'tagihan_semester' => $tag_tamrin,
            'tagihan_bulanan' => $tag_iuran_bulanan,
            'tagihan_total_daftar_ulang' => $total_daftar_ulang,
            'tagihan_total_semester' => $total_tamrin,
            'tagihan_total_bulanan' => $total_iuran_bulanan,

            'daftar_baru' => $daftar_baru,
            'daftar_ulang' => $daftar_ulang,
            'semester' => $semester,
            'iuran' => $iuran,

            'admins' => $admins,
        ], $data);
    }

    public function create_admin(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama_admin' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'role' => 'required|in:super_admin,admin_pembayaran,admin_penilaian',
            'akses_santri' => 'required|in:semua,putra,putri',
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
            'akses_santri' => $request->akses_santri,
            'password' => Hash::make($request->password),
            'no_hp_admin' => $request->no_hp_admin,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Admin berhasil ditambahkan.');
    }

    public function edit_admin(Request $request, $id_admin)
    {
        $admin = User::findOrFail($id_admin);

        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama_admin' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id_admin . ',id_admin',
            'role' => 'required|in:super_admin,admin_pembayaran,admin_penilaian',
            'akses_santri' => 'required|in:semua,putra,putri',
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
        $admin->akses_santri = $request->akses_santri;

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

    public function delete_admin($id_admin)
    {
        $admin = User::findOrFail($id_admin);
        $admin->delete();

        return redirect()->back()->with('success', 'Admin berhasil dihapus.');
    }

    public function createTagihan(Request $request)
    {   
        $request->validate([
            'jenis_pembayaran' => 'required|in:daftar_ulang,iuran_bulanan,tamrin'
        ]);

        $jenis_pembayaran = $request->jenis_pembayaran;

        $currentYear = now()->year;
        $currentMonth = now()->month;
        $currentSemester = SemesterHelper::getCurrentSemester();

        // Ambil hanya ID santri beserta status mukim dan jenis kelamin
        $santriList = Santri::get(['id_santri', 'status_santri', 'jenis_kelamin_santri', 'bebas_daftar_ulang', 'bebas_semester', 'bebas_iuran'])
            ->mapWithKeys(function ($santri) {
                return [
                    $santri->id_santri => [
                        'status_santri' => $santri->status_santri,
                        'jenis_kelamin_santri' => $santri->jenis_kelamin_santri,
                        'bebas_daftar_ulang' => $santri->bebas_daftar_ulang,
                        'bebas_semester' => $santri->bebas_semester,
                        'bebas_iuran' => $santri->bebas_iuran
                    ]
                ];
            })->toArray();

        $tagihanCreated = false;

        foreach ($santriList as $id_santri => $santri) {
            // Konversi nilai status santri agar sesuai dengan MasterAdmin
            $jenis_mukim = ($santri['status_santri'] === 'mukim') ? 'mukim' : 'tdk_mukim';
            $jenis_santri = ($santri['jenis_kelamin_santri'] === 'laki-laki') ? 'l' : 'p';

            //status pembayaran
            $status_bebas_daftar_ulang = ($santri['bebas_daftar_ulang'] === 'true') ? 'bebas_tagihan' : 'belum_lunas';
            $status_bebas_iuran = ($santri['bebas_iuran'] === 'true') ? 'bebas_tagihan' : 'belum_lunas';
            $status_bebas_semester = ($santri['bebas_semester'] === 'true') ? 'bebas_tagihan' : 'belum_lunas';

            // Cek apakah tagihan sudah ada, sesuai dengan jenis pembayaran
            $existingPembayaran = match ($jenis_pembayaran) {
                'daftar_ulang' => Pembayaran::where('id_santri', $id_santri)
                    ->where('jenis_pembayaran', 'daftar_ulang')
                    ->where('tahun_ajaran', $currentYear)
                    ->exists(),
                'iuran_bulanan' => Pembayaran::where('id_santri', $id_santri)
                    ->where('jenis_pembayaran', 'iuran_bulanan')
                    ->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $currentMonth)
                    ->exists(),
                'tamrin' => Pembayaran::where('id_santri', $id_santri)
                    ->where('jenis_pembayaran', 'tamrin')
                    ->where('tahun_ajaran', $currentYear)
                    ->where('semester_ajaran', $currentSemester['semester'])
                    ->exists(),
                default => null
            };

            // Jika jenis pembayaran tidak dikenal, langsung return error
            if ($existingPembayaran === null) {
                return redirect()->back()->withErrors([
                    'error' => 'Jenis pembayaran "' . $jenis_pembayaran . '" tidak ditemukan.'
                ]);
            }

            // Jika belum ada tagihan, buat tagihan baru
            if (!$existingPembayaran) {
                match ($jenis_pembayaran) {
                    'daftar_ulang' => TagihanHelper::createPembayaranPendaftaranUlang($id_santri, $jenis_mukim, $jenis_santri, $status_bebas_daftar_ulang) ,
                    'iuran_bulanan' => TagihanHelper::createPembayaranIuran($id_santri, $jenis_mukim, $jenis_santri, $status_bebas_iuran),
                    'tamrin' => TagihanHelper::createPembayaranSemester($id_santri, $jenis_mukim, $jenis_santri, $status_bebas_semester),
                };
                $tagihanCreated = true;
            }
        }

        if (!$tagihanCreated) {
            return redirect()->back()->withErrors([
                'error' => 'Tagihan ' . ucfirst(str_replace('_', ' ', $jenis_pembayaran)) . ' sudah ada untuk santri di tahun ajaran / semester ini.'
            ]);
        }
        
        return redirect()->back()->with('success', 'Tagihan ' . ucfirst(str_replace('_', ' ', $jenis_pembayaran)) . ' berhasil dibuat untuk santri yang belum memiliki tagihan.');
    }
}
