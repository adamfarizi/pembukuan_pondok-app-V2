<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Surah;
use App\Models\Santri;
use App\Models\Hafalan;
use App\Models\Pembayaran;
use App\Models\WaliSantri;
use App\Models\MasterAdmin;
use App\Models\NilaiSantri;
use App\Models\PointSantri;
use Illuminate\Http\Request;
use App\Helpers\SemesterHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminSantriController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Santri';

        $santris = Santri::with('waliSantri')->get();

        if ($request->ajax()) {
            $data = Santri::orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->addColumn('tempat_tanggal_lahir_santri', function ($row) {
                    return $row->tempat_tanggal_lahir_santri; // Menggunakan accessor dari model
                })
                ->addColumn('alamat_santri', function ($row) {
                    return $row->alamat_santri; // Menggunakan accessor dari model
                })
                ->make(true);
        }        

        $wali_santris = WaliSantri::get();

        return view('admin.santri.santri', [
            'santris' => $santris,
            'wali_santris' => $wali_santris,
        ], $data);
    }

    public function index_create()
    {
        $data['title'] = 'Santri';
        return view('admin.santri.create.create', $data);
    }

    public function create(Request $request)
    {
        try {
            // Validasi input
            $this->validate($request, [
                //? Identitas Santri
                'nama_santri' => 'required',
                'status_santri' => 'required',
                'tempat_lahir_santri' => 'required',
                'tanggal_lahir_santri' => 'required',
                'jenis_kelamin_santri' => 'required',
                'rt' => 'required',
                'rw' => 'required',
                'kecamatan' => 'required',
                'kab_kota' => 'required',
                'provinsi' => 'required',
                'kode_pos' => 'required',
                'email_santri' => 'required|email',
                'tingkatan' => 'required',

                //? Identitas Orang tua
                //Identitas Ayah
                'nama_ayah' => 'required',
                //Identitas Ibu
                'nama_ibu' => 'required',
                
                //? Identitas Wali
                'nama_wali' => 'required',
                'no_identitas_wali' => 'required',
                'tempat_lahir_wali' => 'required',
                'tanggal_lahir_wali' => 'required',
                // Alamat
                'rt_wali' => 'required',
                'rw_wali' => 'required',
                'kecamatan_wali' => 'required',
                'kab_kota_wali' => 'required',
                'provinsi_wali' => 'required',
                'kode_pos_wali' => 'required',
                // Email
                'no_hp_wali' => 'required',
                'email_wali' => 'required|email',
                // Lainnya
                'status_wali' => 'required',

                //Berkas-berkas
                'ktp_santri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'kk_santri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'akta_santri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'pas_foto_santri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $ktpSantri = $request->file('ktp_santri');
            $kkSantri = $request->file('kk_santri');
            $aktaSantri = $request->file('akta_santri');
            $pasfotoSantri = $request->file('pas_foto_santri');

            // Mendapatkan nama asli file
            $nama_santri = $request->input('nama_santri');
            $ktpSantriName = $nama_santri . "_" . uniqid() . "_" . $ktpSantri->getClientOriginalName();
            $kkSantriName = $nama_santri . "_" . uniqid() . "_" . $kkSantri->getClientOriginalName();
            $aktaSantriName = $nama_santri . "_" . uniqid() . "_" . $aktaSantri->getClientOriginalName();
            $pasfotoSantriName = $nama_santri . "_" . uniqid() . "_" . $pasfotoSantri->getClientOriginalName();

            // Simpan file KTP dan KK
            $ktpSantri->move(public_path('berkas_santri/ktp_santri'), $ktpSantriName);
            $kkSantri->move(public_path('berkas_santri/kk_santri'), $kkSantriName);
            $aktaSantri->move(public_path('berkas_santri/akta_santri'), $aktaSantriName);
            $pasfotoSantri->move(public_path('berkas_santri/pas_foto_santri'), $pasfotoSantriName);

            // Tahun masuk
            $tahun_masuk = date('Y');

            // Simpan data santri
            $santri = Santri::create([
                'nama_santri' => $request->input('nama_santri'),
                'no_induk' => $request->input('no_induk'),
                'status_santri' => $request->input('status_santri'),
                'no_identitas' => $request->input('no_identitas'),
                'tempat_lahir_santri' => $request->input('tempat_lahir_santri'),
                'tanggal_lahir_santri' => $request->input('tanggal_lahir_santri'),
                'jenis_kelamin_santri' => $request->input('jenis_kelamin_santri'),
                'rt' => $request->input('rt'),
                'rw' => $request->input('rw'),
                'dusun' => $request->input('dusun'),
                'desa' => $request->input('desa'),
                'kecamatan' => $request->input('kecamatan'),
                'kab_kota' => $request->input('kab_kota'),
                'provinsi' => $request->input('provinsi'),
                'kode_pos' => $request->input('kode_pos'),
                'no_hp_santri' => $request->input('no_hp_santri'),
                'email_santri' => $request->input('email_santri'),
                'tahun_masuk' => now()->year,
                'tingkatan' => $request->input('tingkatan'),
                'jumlah_saudara_kandung' => $request->input('jumlah_saudara_kandung'),
                'anak_ke' => $request->input('anak_ke'),

                //Identitas Ayah
                'nama_ayah' => $request->input('nama_ayah'),
                'pendidikan_ayah' => $request->input('pendidikan_ayah'),
                'pekerjaan_ayah' => $request->input('pekerjaan_ayah'),
                'pendapatan_ayah_perbulan' => $request->input('pendapatan_ayah_perbulan'),

                //Identitas Ibu
                'nama_ibu' => $request->input('nama_ibu'),
                'pendidikan_ibu' => $request->input('pendidikan_ibu'),
                'pekerjaan_ibu' => $request->input('pekerjaan_ibu'),
                'pendapatan_ibu_perbulan' => $request->input('pendapatan_ibu_perbulan'),

                //Berkas-berkas
                'ktp_santri' => $ktpSantriName,
                'kk_santri' => $kkSantriName,
                'akta_santri' => $aktaSantriName,
                'pas_foto_santri' => $pasfotoSantriName,
            ]);

            // Tambah wali santri
            $wali_santri = WaliSantri::create([
                'id_santri' => $santri->id_santri,
                'nama_wali' => $request->input('nama_wali'),
                'no_identitas_wali' => $request->input('no_identitas_wali'),
                'tempat_lahir_wali' => $request->input('tempat_lahir_wali'),
                'tanggal_lahir_wali' => $request->input('tanggal_lahir_wali'),
                'rt_wali' => $request->input('rt_wali'),
                'rw_wali' => $request->input('rw_wali'),
                'dusun_wali' => $request->input('dusun_wali'),
                'desa_wali' => $request->input('desa_wali'),
                'kecamatan_wali' => $request->input('kecamatan_wali'),
                'kab_kota_wali' => $request->input('kab_kota_wali'),
                'provinsi_wali' => $request->input('provinsi_wali'),
                'kode_pos_wali' => $request->input('kode_pos_wali'),
                'status_wali' => $request->input('status_wali'),
                'no_hp' => $request->input('no_hp_wali'),
                'email' => $request->input('email_wali'),
                'password' => Hash::make($request->input('password_wali_santri')),
                'pendidikan_wali' => $request->input('pendidikan_wali'),
                'pekerjaan_wali' => $request->input('pekerjaan_wali'),
                'pendapatan_wali_perbulan' => $request->input('pendapatan_wali_perbulan'),
            ]);

            //* Pembayaran
            $currentSemester = SemesterHelper::getCurrentSemester();
            $master = MasterAdmin::get();

            $daftar_ulang_baru = $master->where('jenis_pembayaran', 'pendaftaran')
                ->where('keterangan_pembayaran', 'Pendaftaran Baru')
                ->pluck('jumlah_pembayaran')
                ->first();
            $bayar_semester = $master->where('jenis_pembayaran', 'semester')
                ->where('keterangan_pembayaran', 'Semester')
                ->pluck('jumlah_pembayaran')
                ->first();
            $iuran_makan_transport = $master->where('jenis_pembayaran', 'iuran')
                ->where('keterangan_pembayaran', 'Makan & Transport')
                ->pluck('jumlah_pembayaran')
                ->first();
            $iuran_ziarah = $master->where('jenis_pembayaran', 'iuran')
                ->where('keterangan_pembayaran', 'Ziarah')
                ->pluck('jumlah_pembayaran')
                ->first();

            $total_iuran = $iuran_makan_transport + $iuran_ziarah;

            // Daftar Ulang
            Pembayaran::create([
                'id_santri' => $santri->id_santri,
                'id_admin' => null,
                'tanggal_pembayaran' => null,
                'jumlah_pembayaran' => $daftar_ulang_baru,
                'jumlah_bayar' => 0,
                'jenis_pembayaran' => 'daftar_ulang',
                'status_pembayaran' => 'belum_lunas',
                'tahun_ajaran' => $currentSemester['tahun'],
                'semester_ajaran' => $currentSemester['semester'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // Iuran Bulanan
            Pembayaran::create([
                'id_santri' => $santri->id_santri,
                'id_admin' => null,
                'tanggal_pembayaran' => null,
                'jumlah_pembayaran' => $total_iuran,
                'jumlah_bayar' => 0,
                'jenis_pembayaran' => 'iuran_bulanan',
                'status_pembayaran' => 'belum_lunas',
                'tahun_ajaran' => $currentSemester['tahun'],
                'semester_ajaran' => $currentSemester['semester'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // Tamrin
            Pembayaran::create([
                'id_santri' => $santri->id_santri,
                'id_admin' => null,
                'tanggal_pembayaran' => null,
                'jumlah_pembayaran' => $bayar_semester,
                'jumlah_bayar' => 0,
                'jenis_pembayaran' => 'tamrin',
                'status_pembayaran' => 'belum_lunas',
                'tahun_ajaran' => $currentSemester['tahun'],
                'semester_ajaran' => $currentSemester['semester'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            $surahs = Surah::getValues();

            foreach ($surahs as $surah) {
                $totalAyat = Surah::$totalAyat[$surah];

                Hafalan::create([
                    'id_santri' => $santri->id_santri,
                    'surah' => $surah,
                    'total_ayat' => $totalAyat,
                    'progress_ayat' => 0,
                ]);
            }

            return redirect()->route('santri')->with('success', 'Data santri berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // return redirect()->back()->withErrors($e->errors())->withInput();
            return redirect()->route('santri')->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->route('santri')->withErrors(['error' => 'Error: ' . $e->getMessage()])->withInput();
            // return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()])->withInput();
        }

    }

    public function index_info($id_santri)
    {
        $data['title'] = 'Santri';

        $santri = Santri::where('id_santri', $id_santri)->first();

        $wali = WaliSantri::where('id_santri', $id_santri)->first();

        $currentSemester = SemesterHelper::getCurrentSemester();
        $RiwayatPembayaran = Pembayaran::where('id_santri', $id_santri)
            ->where('status_pembayaran', 'lunas')
            ->with(['santri', 'user'])
            ->orderBy('tanggal_pembayaran', 'desc')
            ->get();

        $TagihanPembayaran = Pembayaran::where('id_santri', $id_santri)
            ->where('status_pembayaran', 'belum_lunas')
            ->with(['santri', 'user'])
            ->orderBy('tahun_ajaran', 'asc')
            ->get();
        return view('admin.santri.info.info', [
            'santri' => $santri,
            'wali' => $wali,
            'RiwayatPembayaran' => $RiwayatPembayaran,
            'TagihanPembayaran' => $TagihanPembayaran,
        ], $data);
    }

    public function update_pembayaran(Request $request, $jenis_pembayaran, $id_pembayaran)
    {
        $pembayaran = Pembayaran::where('jenis_pembayaran', $jenis_pembayaran)
            ->where('id_pembayaran', $id_pembayaran)
            ->first();

        if ($pembayaran) {
            $pembayaran->tanggal_pembayaran = now();
            $pembayaran->id_admin = Auth::user()->id_admin;
            $pembayaran->jumlah_bayar = $pembayaran->jumlah_pembayaran;
            $pembayaran->status_pembayaran = 'lunas';
            $pembayaran->save();

            return redirect()->back()->with('success', 'Pembayaran berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Pembayaran tidak ditemukan.');
        }
    }

    public function cetakRiwayat($id_santri, $tanggal)
    {   
        $formattedDate = \Carbon\Carbon::parse($tanggal)->format('Y-m-d');

        // Ambil riwayat pembayaran pada tanggal tersebut
        $riwayatPembayaran = Pembayaran::whereDate('tanggal_pembayaran', $formattedDate)
            ->where('id_santri', $id_santri)
            ->with('santri', 'user')
            ->get();
        // dd($formattedDate);
            // Kirim data ke view cetak
        return view('admin.santri.info.cetak.riwayat_pembayaran', [
            'riwayatPembayaran' => $riwayatPembayaran,
            'tanggal' => $tanggal,
        ]);
    }

    public function index_edit(Request $request, $id_santri)
    {
        $data['title'] = 'Santri';

        $santri = Santri::where('id_santri', $id_santri)->first();

        $wali_santri = WaliSantri::where('id_santri', $id_santri)->first();

        return view('admin.santri.edit.edit', [
            'santri' => $santri,
            'wali' => $wali_santri,
        ], $data);
    }

    public function edit(Request $request, $id_santri)
    {
        try {
            // Validasi input
            $this->validate($request, [
                //? Identitas Santri
                'nama_santri' => 'required',
                'status_santri' => 'required',
                'no_identitas' => 'required',
                'tempat_lahir_santri' => 'required',
                'tanggal_lahir_santri' => 'required',
                'jenis_kelamin_santri' => 'required',
                'rt' => 'required',
                'rw' => 'required',
                'kecamatan' => 'required',
                'kab_kota' => 'required',
                'provinsi' => 'required',
                'kode_pos' => 'required',
                'email_santri' => 'required|email',
                'tingkatan' => 'required',

                //? Identitas Orang tua
                //Identitas Ayah
                'nama_ayah' => 'required',
                //Identitas Ibu
                'nama_ibu' => 'required',
                
                //? Identitas Wali
                'nama_wali' => 'required',
                'no_identitas_wali' => 'required',
                'tempat_lahir_wali' => 'required',
                'tanggal_lahir_wali' => 'required',
                // Alamat
                'rt_wali' => 'required',
                'rw_wali' => 'required',
                'kecamatan_wali' => 'required',
                'kab_kota_wali' => 'required',
                'provinsi_wali' => 'required',
                'kode_pos_wali' => 'required',
                // Email
                'no_hp_wali' => 'required',
                'email_wali' => 'required|email',
                // Lainnya
                'status_wali' => 'required',
            ]);

            $nama_santri = $request->input('nama_santri');

            $santri = Santri::where('id_santri', $id_santri)->first();

            // Perbarui gambar jika ada
            if ($request->hasFile('ktp_santri')) {
                if ($santri->ktp_santri) {
                    unlink(public_path('berkas_santri/ktp_santri/' . $santri->ktp_santri));
                }

                $ktpSantri = $request->file('ktp_santri');
                $ktpSantriName = $nama_santri . "_" . uniqid() . "_" . $ktpSantri->getClientOriginalName();
                $ktpSantri->move(public_path('berkas_santri/ktp_santri'), $ktpSantriName);
                Santri::where('id_santri', $id_santri)->update([
                    'ktp_santri' => $ktpSantriName,
                ]);
            }

            if ($request->hasFile('kk_santri')) {
                if ($santri->kk_santri) {
                    unlink(public_path('berkas_santri/kk_santri/' . $santri->kk_santri));
                }

                $kkSantri = $request->file('kk_santri');
                $kkSantriName = $nama_santri . "_" . uniqid() . "_" . $kkSantri->getClientOriginalName();
                $kkSantri->move(public_path('berkas_santri/kk_santri'), $kkSantriName);
                Santri::where('id_santri', $id_santri)->update([
                    'kk_santri' => $kkSantriName,
                ]);
            }

            if ($request->hasFile('akta_santri')) {
                if ($santri->akta_santri) {
                    unlink(public_path('berkas_santri/akta_santri/' . $santri->akta_santri));
                }

                $aktaSantri = $request->file('akta_santri');
                $aktaSantriName = $nama_santri . "_" . uniqid() . "_" . $aktaSantri->getClientOriginalName();
                $aktaSantri->move(public_path('berkas_santri/akta_santri'), $aktaSantriName);
                Santri::where('id_santri', $id_santri)->update([
                    'akta_santri' => $aktaSantriName,
                ]);
            }

            if ($request->hasFile('pas_foto_santri')) {
                if ($santri->pas_foto_santri) {
                    unlink(public_path('berkas_santri/pas_foto_santri/' . $santri->pas_foto_santri));
                }

                $pasfotoSantri = $request->file('pas_foto_santri');
                $pasfotoSantriName = $nama_santri . "_" . uniqid() . "_" . $pasfotoSantri->getClientOriginalName();
                $pasfotoSantri->move(public_path('berkas_santri/pas_foto_santri'), $pasfotoSantriName);
                Santri::where('id_santri', $id_santri)->update([
                    'pas_foto_santri' => $pasfotoSantriName,
                ]);
            }

            // Perbarui data santri
            $santri = Santri::where('id_santri', $id_santri)->update([
                'nama_santri' => $request->input('nama_santri'),
                'no_induk' => $request->input('no_induk'),
                'status_santri' => $request->input('status_santri'),
                'no_identitas' => $request->input('no_identitas'),
                'tempat_lahir_santri' => $request->input('tempat_lahir_santri'),
                'tanggal_lahir_santri' => $request->input('tanggal_lahir_santri'),
                'jenis_kelamin_santri' => $request->input('jenis_kelamin_santri'),
                'rt' => $request->input('rt'),
                'rw' => $request->input('rw'),
                'dusun' => $request->input('dusun'),
                'desa' => $request->input('desa'),
                'kecamatan' => $request->input('kecamatan'),
                'kab_kota' => $request->input('kab_kota'),
                'provinsi' => $request->input('provinsi'),
                'kode_pos' => $request->input('kode_pos'),
                'no_hp_santri' => $request->input('no_hp_santri'),
                'email_santri' => $request->input('email_santri'),
                'tingkatan' => $request->input('tingkatan'),
                // 'tahun_masuk' => $request->input('mulai_masuk_tanggal'),
                'jumlah_saudara_kandung' => $request->input('jumlah_saudara_kandung'),
                'anak_ke' => $request->input('anak_ke'),

                //Identitas Ayah
                'nama_ayah' => $request->input('nama_ayah'),
                'pendidikan_ayah' => $request->input('pendidikan_ayah'),
                'pekerjaan_ayah' => $request->input('pekerjaan_ayah'),
                'pendapatan_ayah_perbulan' => $request->input('pendapatan_ayah_perbulan'),

                //Identitas Ibu
                'nama_ibu' => $request->input('nama_ibu'),
                'pendidikan_ibu' => $request->input('pendidikan_ibu'),
                'pekerjaan_ibu' => $request->input('pekerjaan_ibu'),
                'pendapatan_ibu_perbulan' => $request->input('pendapatan_ibu_perbulan'),

            ]);

            // Tambah wali santri
            $wali_santri = WaliSantri::where('id_santri', $id_santri)->update([
                'id_santri' => $id_santri,
                'nama_wali' => $request->input('nama_wali'),
                'no_identitas_wali' => $request->input('no_identitas_wali'),
                'tempat_lahir_wali' => $request->input('tempat_lahir_wali'),
                'tanggal_lahir_wali' => $request->input('tanggal_lahir_wali'),
                'rt_wali' => $request->input('rt_wali'),
                'rw_wali' => $request->input('rw_wali'),
                'dusun_wali' => $request->input('dusun_wali'),
                'desa_wali' => $request->input('desa_wali'),
                'kecamatan_wali' => $request->input('kecamatan_wali'),
                'kab_kota_wali' => $request->input('kab_kota_wali'),
                'provinsi_wali' => $request->input('provinsi_wali'),
                'kode_pos_wali' => $request->input('kode_pos_wali'),
                'status_wali' => $request->input('status_wali'),
                'no_hp' => $request->input('no_hp_wali'),
                'email' => $request->input('email_wali'),
                'pendidikan_wali' => $request->input('pendidikan_wali'),
                'pekerjaan_wali' => $request->input('pekerjaan_wali'),
                'pendapatan_wali_perbulan' => $request->input('pendapatan_wali_perbulan'),
            ]);

            return redirect()->route('santri')->with('success', 'Data santri berhasil diubah.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }

    }

    public function delete($id_santri)
    {
        try {
            $pembayaran = Pembayaran::where('id_santri', $id_santri);
            if (!$pembayaran) {
                throw new \Exception('Pembayaran tidak ditemukan.');
            }
            $pembayaran->delete();

            $nilai_santri = NilaiSantri::where('id_santri', $id_santri);
            if (!$nilai_santri) {
                throw new \Exception('Nilai tidak ditemukan.');
            }
            $nilai_santri->delete();

            $point_santri = PointSantri::where('id_santri', $id_santri);
            if (!$point_santri) {
                throw new \Exception('Point tidak ditemukan.');
            }
            $point_santri->delete();

            $hafalan = Hafalan::where('id_santri', $id_santri);
            if (!$hafalan) {
                throw new \Exception('Hafalan tidak ditemukan.');
            }
            $hafalan->delete();

            // Hapus wali santri
            $wali_santri = WaliSantri::where('id_santri', $id_santri);
            if (!$wali_santri) {
                throw new \Exception('Wali santri tidak ditemukan.');
            }
            $wali_santri->delete();

            // Hapus santri
            $santri = Santri::where('id_santri', $id_santri)->first();
            if (!$santri) {
                throw new \Exception('Santri tidak ditemukan.');
            }
            // // Hapus gambar
            // if ($santri->ktp_santri) {
            //     unlink(public_path('berkas_santri/ktp_santri/' . $santri->ktp_santri));
            // }

            // if ($santri->kk_santri) {
            //     unlink(public_path('berkas_santri/kk_santri/' . $santri->kk_santri));
            // }

            // if ($santri->akta_santri) {
            //     unlink(public_path('berkas_santri/akta_santri/' . $santri->akta_santri));
            // }

            // if ($santri->pas_foto_santri) {
            //     unlink(public_path('berkas_santri/pas_foto_santri/' . $santri->pas_foto_santri));
            // }
            $santri->delete();

            return redirect()->back()->with('success', 'Santri berhasil dihapus.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
}
