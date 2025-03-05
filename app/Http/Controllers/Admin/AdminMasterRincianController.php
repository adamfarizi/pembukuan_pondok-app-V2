<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin;
use App\Models\MasterAdminRincian;
use Illuminate\Http\Request;

class AdminMasterRincianController extends Controller
{
    public function indexRincianDaftarBaru()
    {
        $data['title'] = 'Master Admin';

        // Umum
        $pendaftaran_baru = MasterAdminRincian::where('jenis_pembayaran', 'pendaftaran_baru')
            ->get();

        // Mukim
        $mukim_pria = MasterAdminRincian::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'pendaftaran_baru')
            ->whereIn('jenis_santri', values: ['l', 'c'])
            ->get();
        $total_mukim_pria = MasterAdmin::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'pendaftaran_baru')
            ->where('jenis_santri', 'l')
            ->pluck('total_pembayaran')
            ->first();
        $mukim_perempuan = MasterAdminRincian::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'pendaftaran_baru')
            ->whereIn('jenis_santri', values: ['p', 'c'])
            ->get();
        $total_mukim_perempuan = MasterAdmin::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'pendaftaran_baru')
            ->where('jenis_santri', 'p')
            ->pluck('total_pembayaran')
            ->first();

        // Non Mukim
        $non_mukim_pria = MasterAdminRincian::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'pendaftaran_baru')
            ->whereIn('jenis_santri', values: ['l', 'c'])
            ->get();
        $total_non_mukim_pria = MasterAdmin::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'pendaftaran_baru')
            ->where('jenis_santri', 'l')
            ->pluck('total_pembayaran')
            ->first();
        $non_mukim_perempuan = MasterAdminRincian::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'pendaftaran_baru')
            ->whereIn('jenis_santri', values: ['p', 'c'])
            ->get();
        $total_non_mukim_perempuan = MasterAdmin::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'pendaftaran_baru')
            ->where('jenis_santri', 'p')
            ->pluck('total_pembayaran')
            ->first();

        return view('admin.master.rincian.rincian_daftar_baru', [
            'pendaftaran_baru' => $pendaftaran_baru,

            'mukim_pria' => $mukim_pria,
            'total_mukim_pria' => $total_mukim_pria,
            'mukim_perempuan' => $mukim_perempuan,
            'total_mukim_perempuan' => $total_mukim_perempuan,
            'non_mukim_pria' => $non_mukim_pria,
            'total_non_mukim_pria' => $total_non_mukim_pria,
            'non_mukim_perempuan' => $non_mukim_perempuan,
            'total_non_mukim_perempuan' => $total_non_mukim_perempuan,
        ], $data);
    }

    public function indexRincianDaftarUlang()
    {
        $data['title'] = 'Master Admin';

        // Umum
        $pendaftaran_ulang = MasterAdminRincian::where('jenis_pembayaran', 'pendaftaran_ulang')
            ->get();

        // Mukim
        $mukim_pria = MasterAdminRincian::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'pendaftaran_ulang')
            ->whereIn('jenis_santri', values: ['l', 'c'])
            ->get();
        $total_mukim_pria = MasterAdmin::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'pendaftaran_ulang')
            ->where('jenis_santri', 'l')
            ->pluck('total_pembayaran')
            ->first();
        $mukim_perempuan = MasterAdminRincian::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'pendaftaran_ulang')
            ->whereIn('jenis_santri', values: ['p', 'c'])
            ->get();
        $total_mukim_perempuan = MasterAdmin::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'pendaftaran_ulang')
            ->where('jenis_santri', 'p')
            ->pluck('total_pembayaran')
            ->first();

        // Non Mukim
        $non_mukim_pria = MasterAdminRincian::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'pendaftaran_ulang')
            ->whereIn('jenis_santri', values: ['l', 'c'])
            ->get();
        $total_non_mukim_pria = MasterAdmin::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'pendaftaran_ulang')
            ->where('jenis_santri', 'l')
            ->pluck('total_pembayaran')
            ->first();
        $non_mukim_perempuan = MasterAdminRincian::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'pendaftaran_ulang')
            ->whereIn('jenis_santri', values: ['p', 'c'])
            ->get();
        $total_non_mukim_perempuan = MasterAdmin::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'pendaftaran_ulang')
            ->where('jenis_santri', 'p')
            ->pluck('total_pembayaran')
            ->first();

        return view('admin.master.rincian.rincian_daftar_ulang', [
            'pendaftaran_ulang' => $pendaftaran_ulang,

            'mukim_pria' => $mukim_pria,
            'total_mukim_pria' => $total_mukim_pria,
            'mukim_perempuan' => $mukim_perempuan,
            'total_mukim_perempuan' => $total_mukim_perempuan,
            'non_mukim_pria' => $non_mukim_pria,
            'total_non_mukim_pria' => $total_non_mukim_pria,
            'non_mukim_perempuan' => $non_mukim_perempuan,
            'total_non_mukim_perempuan' => $total_non_mukim_perempuan,
        ], $data);
    }

    public function indexRincianSemester()
    {
        $data['title'] = 'Master Admin';

        // Umum
        $semester = MasterAdminRincian::where('jenis_pembayaran', 'semester')
            ->get();

        // Mukim
        $mukim_pria = MasterAdminRincian::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'semester')
            ->whereIn('jenis_santri', values: ['l', 'c'])
            ->get();
        $total_mukim_pria = MasterAdmin::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'semester')
            ->where('jenis_santri', 'l')
            ->pluck('total_pembayaran')
            ->first();
        $mukim_perempuan = MasterAdminRincian::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'semester')
            ->whereIn('jenis_santri', values: ['p', 'c'])
            ->get();
        $total_mukim_perempuan = MasterAdmin::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'semester')
            ->where('jenis_santri', 'p')
            ->pluck('total_pembayaran')
            ->first();

        // Non Mukim
        $non_mukim_pria = MasterAdminRincian::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'semester')
            ->whereIn('jenis_santri', values: ['l', 'c'])
            ->get();
        $total_non_mukim_pria = MasterAdmin::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'semester')
            ->where('jenis_santri', 'l')
            ->pluck('total_pembayaran')
            ->first();
        $non_mukim_perempuan = MasterAdminRincian::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'semester')
            ->whereIn('jenis_santri', values: ['p', 'c'])
            ->get();
        $total_non_mukim_perempuan = MasterAdmin::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'semester')
            ->where('jenis_santri', 'p')
            ->pluck('total_pembayaran')
            ->first();

        return view('admin.master.rincian.rincian_semester', [
            'semester' => $semester,

            'mukim_pria' => $mukim_pria,
            'total_mukim_pria' => $total_mukim_pria,
            'mukim_perempuan' => $mukim_perempuan,
            'total_mukim_perempuan' => $total_mukim_perempuan,
            'non_mukim_pria' => $non_mukim_pria,
            'total_non_mukim_pria' => $total_non_mukim_pria,
            'non_mukim_perempuan' => $non_mukim_perempuan,
            'total_non_mukim_perempuan' => $total_non_mukim_perempuan,
        ], $data);
    }

    public function indexRincianIuran()
    {
        $data['title'] = 'Master Admin';

        // Umum
        $iuran_bulanan = MasterAdminRincian::where('jenis_pembayaran', 'iuran')
            ->get();

        // Mukim
        $mukim_pria = MasterAdminRincian::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'iuran')
            ->whereIn('jenis_santri', values: ['l', 'c'])
            ->get();
        $total_mukim_pria = MasterAdmin::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'iuran')
            ->where('jenis_santri', 'l')
            ->pluck('total_pembayaran')
            ->first();
        $mukim_perempuan = MasterAdminRincian::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'iuran')
            ->whereIn('jenis_santri', values: ['p', 'c'])
            ->get();
        $total_mukim_perempuan = MasterAdmin::where('jenis_mukim', 'mukim')
            ->where('jenis_pembayaran', 'iuran')
            ->where('jenis_santri', 'p')
            ->pluck('total_pembayaran')
            ->first();

        // Non Mukim
        $non_mukim_pria = MasterAdminRincian::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'iuran')
            ->whereIn('jenis_santri', values: ['l', 'c'])
            ->get();
        $total_non_mukim_pria = MasterAdmin::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'iuran')
            ->where('jenis_santri', 'l')
            ->pluck('total_pembayaran')
            ->first();
        $non_mukim_perempuan = MasterAdminRincian::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'iuran')
            ->whereIn('jenis_santri', values: ['p', 'c'])
            ->get();
        $total_non_mukim_perempuan = MasterAdmin::where('jenis_mukim', 'tdk_mukim')
            ->where('jenis_pembayaran', 'iuran')
            ->where('jenis_santri', 'p')
            ->pluck('total_pembayaran')
            ->first();

        return view('admin.master.rincian.rincian_iuran_bulanan', [
            'iuran_bulanan' => $iuran_bulanan,

            'mukim_pria' => $mukim_pria,
            'total_mukim_pria' => $total_mukim_pria,
            'mukim_perempuan' => $mukim_perempuan,
            'total_mukim_perempuan' => $total_mukim_perempuan,
            'non_mukim_pria' => $non_mukim_pria,
            'total_non_mukim_pria' => $total_non_mukim_pria,
            'non_mukim_perempuan' => $non_mukim_perempuan,
            'total_non_mukim_perempuan' => $total_non_mukim_perempuan,
        ], $data);
    }

    private function updateMasterAdmin($jenis_pembayaran, $jenis_mukim)
    {
        $total_keperluan_daftar_baru_umum = MasterAdminRincian::where([
            ['jenis_mukim', $jenis_mukim],
            ['jenis_pembayaran', $jenis_pembayaran],
            ['jenis_santri', 'c']
        ])->sum('jumlah_pembayaran');

        // Total Keperluan Berdasarkan Jenis Santri
        $total_keperluan_laki_laki = MasterAdminRincian::where([
            ['jenis_mukim', $jenis_mukim],
            ['jenis_pembayaran', $jenis_pembayaran],
            ['jenis_santri', 'l']
        ])->sum('jumlah_pembayaran');
        $total_keperluan_perempuan = MasterAdminRincian::where([
            ['jenis_mukim', $jenis_mukim],
            ['jenis_pembayaran', $jenis_pembayaran],
            ['jenis_santri', 'p']
        ])->sum('jumlah_pembayaran');

        // Master Admin Berdasarkan Jenis Santri
        $master_admin_laki_laki = MasterAdmin::where([
            ['jenis_mukim', $jenis_mukim],
            ['jenis_pembayaran', $jenis_pembayaran],
            ['jenis_santri', 'l']
        ])->first();
        $master_admin_perempuan = MasterAdmin::where([
            ['jenis_mukim', $jenis_mukim],
            ['jenis_pembayaran', $jenis_pembayaran],
            ['jenis_santri', 'p']
        ])->first();

        if ($master_admin_laki_laki && $master_admin_perempuan) {
            $master_admin_laki_laki->update([
                'total_pembayaran' => $total_keperluan_laki_laki + $total_keperluan_daftar_baru_umum
            ]);
            $master_admin_perempuan->update([
                'total_pembayaran' => $total_keperluan_perempuan + $total_keperluan_daftar_baru_umum
            ]);
        }

        // If else jika setiap pembayaran master admin kategorinya berbeda-beda
        // if ($jenis_pembayaran == 'pendaftaran_baru') {
        //     dd("Pendaftaran Baru");

        // } elseif ($jenis_pembayaran == 'pendaftaran_ulang') {
        //     dd("Pendaftaran Ulang");

        // } elseif ($jenis_pembayaran == 'semester') {
        //     dd("Semester");

        // } elseif ($jenis_pembayaran == 'iuran') {
        //     dd("Iuran");

        // } else {
        //     return;
        // }
    }

    public function createRincian(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_mukim' => 'required|in:mukim,tdk_mukim',
            'jenis_pembayaran' => 'required|string',
            'jenis_santri' => 'required|in:l,p,c',
            'keterangan_pembayaran' => 'required|string',
            'jumlah_pembayaran' => 'required|numeric|min:0',
        ]);

        try {
            // Buat data baru di tabel MasterAdminRincian
            MasterAdminRincian::create([
                'jenis_mukim' => $validatedData['jenis_mukim'],
                'jenis_pembayaran' => $validatedData['jenis_pembayaran'],
                'jenis_santri' => $validatedData['jenis_santri'],
                'keterangan_pembayaran' => $validatedData['keterangan_pembayaran'],
                'jumlah_pembayaran' => $validatedData['jumlah_pembayaran'],
            ]);

            $this->updateMasterAdmin($validatedData['jenis_pembayaran'], $validatedData['jenis_mukim']);

            return redirect()->back()->with('success', 'Data rincian berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }

    }

    public function editRincian(Request $request, $id_rincian)
    {
        $jenis_pembayaran = $request->input('jenis_pembayaran');
        $jenis_mukim = $request->input('jenis_mukim');
        $jumlah_pembayaran = $request->input('jumlah_pembayaran');

        try {
            $rincian = MasterAdminRincian::where('id_master_admin_rincian', $id_rincian)->first();

            // dd($rincian, $jumlah_pembayaran, $jenis_mukim);
            if ($rincian) {
                $rincian->update([
                    'jumlah_pembayaran' => $jumlah_pembayaran,
                ]);
            }

            if (in_array($jenis_mukim, ['mukim', 'tdk_mukim'])) {
                $this->updateMasterAdmin($jenis_pembayaran, $jenis_mukim);
                return redirect()->back()->with('success', 'Data berhasil diubah.');
            }

            return redirect()->back()->with('error', 'Data gagal diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function deleteRincian($id_rincian)
    {
        try {
            $rincian = MasterAdminRincian::where('id_master_admin_rincian', $id_rincian)->first();

            if ($rincian) {
                $rincian->delete();
            }

            if (in_array($rincian->jenis_mukim, ['mukim', 'tdk_mukim'])) {
                $this->updateMasterAdmin($rincian->jenis_pembayaran, $rincian->jenis_mukim);
                return redirect()->back()->with('success', 'Data berhasil dihapus.');
            }

            return redirect()->back()->with('error', 'Data gagal dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
}
