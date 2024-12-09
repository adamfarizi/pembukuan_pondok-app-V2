<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\MasterAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Helpers\SemesterHelper;
use App\Models\Santri;

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
        Carbon::setLocale('id');
        $currentMonth = Carbon::now()->translatedFormat('F');
        $currentSemester = SemesterHelper::getCurrentSemester();
        $total_daftar_ulang = Pembayaran::where('jenis_pembayaran', 'daftar_ulang')
                                ->count('id_santri');
        $total_tamrin = Pembayaran::where('jenis_pembayaran', 'tamrin')
                                ->count('id_santri');
        $total_iuran_bulanan = Pembayaran::where('jenis_pembayaran', 'iuran_bulanan')
                                ->count('id_santri');
        $tag_daftar_ulang = Pembayaran::where('jenis_pembayaran', 'daftar_ulang')
                                ->where('status_pembayaran', 'belum_lunas')
                                ->count('id_santri');
        $tag_tamrin = Pembayaran::where('jenis_pembayaran', 'tamrin')
                                ->where('status_pembayaran', 'belum_lunas')
                                ->count('id_santri');
        $tag_iuran_bulanan = Pembayaran::where('jenis_pembayaran', 'iuran_bulanan')
                                ->where('status_pembayaran', 'belum_lunas')
                                ->count('id_santri');
        $daftar_ulang_baru = MasterAdmin::where('jenis_pembayaran', 'pendaftaran')->where('keterangan_pembayaran', 'Pendaftaran Baru')->first();
        $daftar_ulang = MasterAdmin::where('jenis_pembayaran', 'pendaftaran')->where('keterangan_pembayaran', 'Pendaftaran Ulang')->first();
        $semester = MasterAdmin::where('jenis_pembayaran', 'semester')->first();
        $iurans = MasterAdmin::where('jenis_pembayaran', 'iuran')->get();

        $admins = User::orderBy('created_at', 'desc')->get();

        return view('admin.master.master_admin', [
            'admins' => $admins,
            'daftar_ulang_baru' => $daftar_ulang_baru,
            'daftar_ulang' => $daftar_ulang,
            'semester' => $semester,
            'iurans' => $iurans,
            'tagihan_daftar_ulang' => $tag_daftar_ulang,
            'tagihan_semester' => $tag_tamrin,
            'tagihan_bulanan' => $tag_iuran_bulanan,
            'tagihan_total_daftar_ulang' => $total_daftar_ulang,
            'tagihan_total_semester' => $total_tamrin,
            'tagihan_total_bulanan' => $total_iuran_bulanan,
            'year' => $currentYear,
            'month' => $currentMonth,
            'smt' => $currentSemester['semester'],
        ], $data);
    }

    public function edit_pembayaran(Request $request)
    {
        $daftar_ulang_baru = $request->input('daftar_ulang_baru');
        $daftar_ulang = $request->input('daftar_ulang');
        $semester = $request->input('semester');
        $jenis_iuran = $request->input('jenis_iuran');
        $jumlah_iuran = $request->input('jumlah_iuran');

        try {
            if ($daftar_ulang !== null) {
                MasterAdmin::where('jenis_pembayaran', 'pendaftaran_ulang')->first()->update([
                    'jumlah_pembayaran' => $daftar_ulang,
                ]);
            }

            if ($daftar_ulang_baru !== null) {
                MasterAdmin::where('jenis_pembayaran', 'pendaftaran_baru')->first()->update([
                    'jumlah_pembayaran' => $daftar_ulang_baru,
                ]);
            }

            if ($semester !== null) {
                MasterAdmin::where('jenis_pembayaran', 'semester')->first()->update([
                    'jumlah_pembayaran' => $semester,
                ]);
            }

            if ($jumlah_iuran !== null) {
                MasterAdmin::where('jenis_pembayaran', 'iuran')
                    ->where('keterangan_pembayaran', $jenis_iuran)
                    ->first()->update([
                    'jumlah_pembayaran' => $jumlah_iuran,
                ]);
            }

            return redirect()->back()->with('success', 'Data berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function create_iuran(Request $request)
    {
        try {
            // Validasi input
            $this->validate($request, [
                'jenis_iuran' => 'required',
                'pembayaran_jenis_iuran' => 'required',
            ]);

            $jenis_iuran = MasterAdmin::create([
                'jenis_pembayaran' => 'iuran',
                'keterangan_pembayaran' => $request->input('jenis_iuran'),
                'jumlah_pembayaran' => $request->input('pembayaran_jenis_iuran'),
            ]);

            return redirect()->back()->with('success', 'Jenis Iuran berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function delete_iuran(Request $request)
    {   
        $jenis_iuran = $request->input('jenis_iuran');
        $master_admin = MasterAdmin::where('jenis_pembayaran', 'iuran')->where( 'keterangan_pembayaran',$jenis_iuran)->first();
        $master_admin->delete();

        return redirect()->back()->with('success', 'Iuran berhasil dihapus.');
    }

    public function create_admin(Request $request)
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

    public function edit_admin(Request $request, $id_admin)
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

    public function delete_admin($id_admin)
    {
        $admin = User::findOrFail($id_admin);
        $admin->delete();

        return redirect()->back()->with('success', 'Admin berhasil dihapus.');
    }

    public function createTagihanDaftarUlang()
    {
        // Get the current year for the current semester
        $currentYear = Carbon::now()->year;
        $currentSemester = SemesterHelper::getCurrentSemester();

        // Get the MasterAdmin data and determine the amount for daftar ulang
        $master = MasterAdmin::get();
        $jenisPembayaran = [
            'daftar_ulang' => $master->where('jenis_pembayaran', 'pendaftaran')
                ->where('keterangan_pembayaran', 'Pendaftaran Ulang')
                ->pluck('jumlah_pembayaran')
                ->first(),
        ];

        // Get the list of santri IDs
        $santriIds = Santri::pluck('id_santri')->toArray();

        // Flag to track if any tagihan is created
        $tagihanCreated = false;

        // Loop through the santri IDs and create pembayaran records
        foreach ($santriIds as $santriId) {
            // Check if the pembayaran for the previous year exists based on created_at
            $existingPembayaranCurrentYear = Pembayaran::where('id_santri', $santriId)
                ->where('jenis_pembayaran', 'daftar_ulang')
                ->where('tahun_ajaran', $currentYear)
                ->exists();

            // If the pembayaran for the current year does not exist, create a new one
            if (!$existingPembayaranCurrentYear) {
                foreach ($jenisPembayaran as $jenis => $jumlah) {
                    Pembayaran::create([
                        'id_santri' => $santriId,
                        'jenis_pembayaran' => $jenis,
                        'jumlah_pembayaran' => $jumlah,
                        'jumlah_bayar' => 0,
                        'tahun_ajaran' => $currentYear,
                        'semester_ajaran' => $currentSemester['semester'],
                    ]);
                }
                $tagihanCreated = true;
            }
        }

        if (!$tagihanCreated) {
            return redirect()->back()->withErrors([
                'error' => 'Tagihan daftar ulang sudah ada untuk santri di tahun ajaran ' . $currentYear
            ]);
        }

        return redirect()->back()->with('success', 'Tagihan Daftar Ulang berhasil dibuat untuk santri yang belum memiliki tagihan di tahun ajaran ini.');
    }

    public function createTagihanIuranBulanan()
    {
        $currentYear = Carbon::now()->year;
        Carbon::setLocale('id');
        $currentMonth = Carbon::now()->translatedFormat('F');
        $currentSemester = SemesterHelper::getCurrentSemester();
        $month = carbon::now()->month;
        // Get the MasterAdmin data and determine the amount for iuran bulanan
        $master = MasterAdmin::get();
        $total_iuran = $master->where('jenis_pembayaran', 'iuran')
            ->sum('jumlah_pembayaran');

        $jenisPembayaran = [
            'iuran_bulanan' => $total_iuran,
        ];

        // Get the list of santri IDs
        $santriIds = Santri::pluck('id_santri')->toArray();

        // Flag to track if any tagihan is created
        $tagihanCreated = false;

        // Loop through the santri IDs and create pembayaran records
        foreach ($santriIds as $santriId) {
            // Check if the pembayaran for the previous month exists based on created_at
            $existingPembayaranCurrentMonth = Pembayaran::where('id_santri', $santriId)
                ->where('jenis_pembayaran', 'iuran_bulanan')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->exists();

            // If the pembayaran for the current month does not exist, create a new one
            if (!$existingPembayaranCurrentMonth) {
                foreach ($jenisPembayaran as $jenis => $jumlah) {
                    Pembayaran::create([
                        'id_santri' => $santriId,
                        'jenis_pembayaran' => $jenis,
                        'jumlah_pembayaran' => $jumlah,
                        'jumlah_bayar' => 0,
                        'tahun_ajaran' => $currentYear,
                        'semester_ajaran' => $currentSemester['semester'],
                    ]);
                }
                $tagihanCreated = true;
            }
        }

        if (!$tagihanCreated) {
            return redirect()->back()->withErrors([
                'error' => 'Tagihan iuran bulanan sudah ada untuk santri di bulan ' . $currentMonth . ' tahun ajaran ' . $currentYear
            ]);
        }

        return redirect()->back()->with('success', 'Tagihan Iuran Bulanan berhasil dibuat untuk santri yang belum memiliki tagihan di bulan ini.');
    }

    public function createTagihanSemester()
    {
        $currentYear = Carbon::now()->year;
        $currentSemester = SemesterHelper::getCurrentSemester();

        // Get the MasterAdmin data and determine the amount for tagihan semester
        $master = MasterAdmin::get();
        $jenisPembayaran = [
            'tamrin' => $master->where('jenis_pembayaran', 'semester')
                ->where('keterangan_pembayaran', 'Semester')
                ->pluck('jumlah_pembayaran')
                ->first(),
        ];

        // Get the list of santri IDs
        $santriIds = Santri::pluck('id_santri')->toArray();

        // Flag to track if any tagihan is created
        $tagihanCreated = false;

        // Loop through the santri IDs and create pembayaran records
        foreach ($santriIds as $santriId) {
            // Check if the pembayaran for the current semester exists
            $existingPembayaranForCurrentSemester = Pembayaran::where('id_santri', $santriId)
                ->where('jenis_pembayaran', 'tamrin')
                ->where('tahun_ajaran', $currentYear)
                ->where('semester_ajaran', $currentSemester['semester'])
                ->exists();

            // If the pembayaran for the current semester does not exist, create a new one
            if (!$existingPembayaranForCurrentSemester) {
                foreach ($jenisPembayaran as $jenis => $jumlah) {
                    Pembayaran::create([
                        'id_santri' => $santriId,
                        'jenis_pembayaran' => $jenis,
                        'jumlah_pembayaran' => $jumlah,
                        'jumlah_bayar' => 0,
                        'tahun_ajaran' => $currentYear,
                        'semester_ajaran' => $currentSemester['semester'],
                    ]);
                }
                $tagihanCreated = true;
            }
        }

        if (!$tagihanCreated) {
            return redirect()->back()->withErrors([
                'error' => 'Tagihan semester sudah ada untuk semua santri di semester ' . $currentSemester['semester'] . ' tahun ajaran ' . $currentYear
            ]);
        }

        return redirect()->back()->with('success', 'Tagihan Semester berhasil dibuat untuk santri yang belum memiliki tagihan di semester ini.');
    }

}
