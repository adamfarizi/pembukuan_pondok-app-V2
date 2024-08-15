<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Surah;
use App\Models\Santri;
use App\Models\Hafalan;
use App\Models\Pembayaran;
use App\Models\WaliSantri;
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
                'nama_santri' => 'required',
                'no_identitas' => 'required',
                'tempat_tanggal_lahir_santri' => 'required',
                'jenis_kelamin_santri' => 'required',
                'rt' => 'required',
                'rw' => 'required',
                'dusun' => 'required',
                'desa' => 'required',
                'kecamatan' => 'required',
                'kab_kota' => 'required',
                'provinsi' => 'required',
                'kode_pos' => 'required',
                'no_hp_santri' => 'required',
                'email_santri' => 'required|email',
                'mulai_masuk_tanggal' => 'required',
                'jumlah_saudara_kandung' => 'required',
                'anak_ke' => 'required',

                //Identitas Ayah
                'nama_ayah' => 'required',
                'pendidikan_ayah' => 'required',
                'pekerjaan_ayah' => 'required',
                'pendapatan_ayah_perbulan' => 'required',

                //Identitas Ibu
                'nama_ibu' => 'required',
                'pendidikan_ibu' => 'required',
                'pekerjaan_ibu' => 'required',
                'pendapatan_ibu_perbulan' => 'required',

                //Identitas wali
                'nama_wali' => 'required',
                'no_identitas_wali' => 'required',
                'tempat_tanggal_lahir_wali' => 'required',
                'rt_wali' => 'required',
                'rw_wali' => 'required',
                'dusun_wali' => 'required',
                'desa_wali' => 'required',
                'kecamatan_wali' => 'required',
                'kab_kota_wali' => 'required',
                'provinsi_wali' => 'required',
                'kode_pos_wali' => 'required',
                'status_wali' => 'required',
                'no_hp_wali_pendaftar' => 'required',
                'email_wali_pendaftar' => 'required|email',
                'pendidikan_wali' => 'required',
                'pekerjaan_wali' => 'required',
                'pendapatan_wali_perbulan' => 'required',

                //Berkas-berkas
                'ktp_santri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'kk_santri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'akta_santri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'pas_foto_santri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status_santri' => 'required',
            ], [
                'nama_santri.required' => 'Masukkan nama santri terlebih dahulu!',
                'no_identitas.required' => 'Masukkan no identitas santri terlebih dahulu!',
                'tempat_tanggal_lahir_santri.required' => 'Masukkan tempat, tanggal lahir santri terlebih dahulu!',
                'jenis_kelamin_santri.required' => 'Pilih jenis kelamin santri terlebih dahulu!',
                'rt.required' => 'Masukkan rt santri terlebih dahulu!',
                'rw.required' => 'Masukkan rw santri terlebih dahulu!',
                'dusun.required' => 'Masukkan dusun santri terlebih dahulu!',
                'desa.required' => 'Masukkan desa santri terlebih dahulu!',
                'kecamatan.required' => 'Masukkan kecamatan santri terlebih dahulu!',
                'kab_kota.required' => 'Masukkan kab/kota santri terlebih dahulu!',
                'provinsi.required' => 'Masukkan alamat santri terlebih dahulu!',
                'kode_pos.required' => 'Masukkan propinsi santri terlebih dahulu!',
                'no_hp_santri.required' => 'Masukkan nomor HP santri terlebih dahulu!',
                'email_santri.required' => 'Masukkan email santri terlebih dahulu!',
                'email_santri.email' => 'Format email tidak valid!',
                'nama_ayah.required' => 'Masukkan nama ayah santri',
                'pendidikan_ayah.required' => 'Masukkan pendidikan terakhir ayah santri',
                'pekerjaan_ayah.required' => 'Masukkan pekerjaan ayah santri',
                'pendapatan_ayah_perbulan.required' => 'Masukkan pendapatan perbulan ayah santri',
                'nama_ibu.required' => 'Masukkan nama ibu santri',
                'pendidikan_ibu.required' => 'Masukkan pendidikan terakhir ayah santri',
                'pekerjaan_ibu.required' => 'Masukkan perkerjaan ibu santri',
                'pendapatan_ibu_perbulan.required' => 'Masukkan pendapatan perbulan ibu santri',
                'nama_wali_santri.required' => 'Masukkan nama wali santri terlebih dahulu!',
                'no_identitas_wali'=> '',
                'tempat_tanggal_lahir_wali'=> '',
                'rt_wali'=> 'Masukkan rt wali terlebih dahulu!',
                'rw_wali'=> 'Masukkan rw wali terlebih dahulu!',
                'dusun_wali'=> 'Masukkan dusun wali terlebih dahulu!',
                'desa_wali'=> 'Masukkan desa wali terlebih dahulu!',
                'kecamatan_wali'=> 'Masukkan kecamatan wali terlebih dahulu!',
                'kab_kota_wali'=> 'Masukkan kab/kota wali terlebih dahulu!',
                'provinsi_wali'=> 'Masukkan provinsi wali terlebih dahulu!',
                'kode_pos_wali'=> 'Masukkan kode pos wali terlebih dahulu!',
                'status_wali'=> 'Masukkan status wali wali terlebih dahulu!',
                'no_hp_wali_santri.required' => 'Masukkan nomor HP wali santri terlebih dahulu!',
                'email_wali_santri.required' => 'Masukkan email wali santri terlebih dahulu!',
                'email_wali_santri.email' => 'Format email wali santri tidak valid!',
                'pendidikan_wali' => 'Masukkan pendidikan wali santri!',
                'pekerjaan_wali' => 'Masukkan pekerjaan wali santri!',
                'pendapatan_wali_perbulan' => 'Masukkan pendapatan wali perbulan!',
                'password_wali_santri.required' => 'Masukkan password wali santri terlebih dahulu!',
                'ktp_santri.required' => 'Upload file KTP santri terlebih dahulu!',
                'ktp_santri.image' => 'File harus berupa gambar!',
                'ktp_santri.mimes' => 'Format file KTP harus jpeg, png, jpg, atau gif!',
                'ktp_santri.max' => 'Ukuran file KTP maksimal 2 MB!',
                'kk_santri.required' => 'Upload file KK santri terlebih dahulu!',
                'kk_santri.image' => 'File harus berupa gambar!',
                'kk_santri.mimes' => 'Format file KK harus jpeg, png, jpg, atau gif!',
                'kk_santri.max' => 'Ukuran file KK maksimal 2 MB!',
                'akta_santri.required' => 'Upload file Akta santri terlebih dahulu!',
                'akta_santri.image' => 'File harus berupa gambar!',
                'akta_santri.mimes' => 'Format file Akta harus jpeg, png, jpg, atau gif!',
                'akta_santri.max' => 'Ukuran file Akta maksimal 2 MB!',
                'pas_foto_santri.required' => 'Upload file Pas Foto santri terlebih dahulu!',
                'pas_foto_santri.image' => 'File harus berupa gambar!',
                'pas_foto_santri.mimes' => 'Format file Pas Foto harus jpeg, png, jpg, atau gif!',
                'pas_foto_santri.max' => 'Ukuran file Pas Foto maksimal 2 MB!',
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
                'no_identitas' => $request->input('no_identitas'),
                'tempat_tanggal_lahir_santri' => $request->input('tempat_tanggal_lahir_santri'),
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
                'mulai_masuk_tanggal' => $request->input('mulai_masuk_tanggal'),
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

                //Identitas Wali
                'nama_lengkap_wali' => $request->input('nama_lengkap_wali'),
                'no_identitas_wali' => $request->input('no_identitas_wali'),
                'tempat_tanggal_lahir_wali' => $request->input('tempat_tanggal_lahir_wali'),
                'rt_wali' => $request->input('rt_wali'),
                'rw_wali' => $request->input('rw_wali'),
                'dusun_wali' => $request->input('rw_wali'),
                'desa_wali' => $request->input('desa_wali'),
                'kecamatan_wali' => $request->input('kecamatan_wali'),
                'kab_kota_wali' => $request->input('kab_kota_wali'),
                'provinsi_wali' => $request->input('provinsi_wali'),
                'kode_pos_wali' => $request->input('kode_pos_wali'),
                'status_wali' => $request->input('status_wali'),
                'no_hp_wali' => $request->input('no_hp_wali'),
                'email_wali' => $request->input('email_wali'),
                'pendidikan_wali' => $request->input('pendidikan_wali'),
                'pekerjaan_wali' => $request->input('pekerjaan_wali'),
                'pendapatan_wali_perbulan' => $request->input('pendapatan_wali_perbulan'),

                //Berkas-berkas
                'ktp_santri' => $ktpSantriName,
                'kk_santri' => $kkSantriName,
                'akta_santri' => $aktaSantriName,
                'pas_foto_santri' => $pasfotoSantriName,
                'status' => 'sudah_verifikasi',
            ]);

            // Tambah wali santri
            $wali_santri = WaliSantri::create([
                'id_santri' => $santri->id_santri,
                'nama_lengkap_wali' => $request->input('nama_lengkap_wali_pendaftar'),
                'no_identitas_wali' => $request->input('no_identitas_wali'),
                'tempat_tanggal_lahir_wali' => $request->input('tempat_tanggal_lahir_wali'),
                'rt_wali' => $request->input('rt_wali'),
                'rw_wali' => $request->input('rw_wali'),
                'dusun_wali' => $request->input('rw_wali'),
                'desa_wali' => $request->input('desa_wali'),
                'kecamatan_wali' => $request->input('kecamatan_wali'),
                'kab_kota_wali' => $request->input('kab_kota_wali'),
                'provinsi_wali' => $request->input('provinsi_wali'),
                'kode_pos_wali' => $request->input('kode_pos_wali'),
                'status_wali' => $request->input('status_wali'),
                'no_hp_wali' => $request->input('no_hp_wali'),
                'email_wali' => $request->input('email_wali'),
            ]);

            //* Pembayaran
            $currentSemester = SemesterHelper::getCurrentSemester();
            // Daftar Ulang
            $pembayaranDaftarUlang = Pembayaran::create([
                'id_santri' => $santri->id_santri,
                'id_admin' => null,
                'tanggal_pembayaran' => null,
                'jumlah_pembayaran' => 300000,
                'jenis_pembayaran' => 'daftar_ulang',
                'status_pembayaran' => 'belum_lunas',
                'tahun_ajaran' => $currentSemester['tahun'],
                'semester_ajaran' => $currentSemester['semester'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // Iuran Bulanan
            $pembayaranIuranBulanan = Pembayaran::create([
                'id_santri' => $santri->id_santri,
                'id_admin' => null,
                'tanggal_pembayaran' => null,
                'jumlah_pembayaran' => 100000,
                'jenis_pembayaran' => 'iuran_bulanan',
                'status_pembayaran' => 'belum_lunas',
                'tahun_ajaran' => $currentSemester['tahun'],
                'semester_ajaran' => $currentSemester['semester'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // Tamrin
            $pembayaranTamrin = Pembayaran::create([
                'id_santri' => $santri->id_santri,
                'id_admin' => null,
                'tanggal_pembayaran' => null,
                'jumlah_pembayaran' => 50000,
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
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
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
            $pembayaran->status_pembayaran = 'lunas';
            $pembayaran->save();

            return redirect()->back()->with('success', 'Pembayaran berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Pembayaran tidak ditemukan.');
        }
    }

    public function index_edit(Request $request, $id_santri)
    {
        $data['title'] = 'Santri';

        $santri = Santri::where('id_santri', $id_santri)->first();

        $wali_santri = WaliSantri::where('id_santri', $id_santri)->first();

        return view('admin.santri.edit.edit', [
            'santri' => $santri,
            'wali_santri' => $wali_santri,
        ], $data);
    }

    public function edit(Request $request, $id_santri)
    {
        try {
            // Validasi input
            $this->validate($request, [
                'nama_santri' => 'required',
                'no_identitas' => 'required',
                'tempat_tanggal_lahir_santri' => 'required',
                'jenis_kelamin_santri' => 'required',
                'rt' => 'required',
                'rw' => 'required',
                'dusun' => 'required',
                'desa' => 'required',
                'kecamatan' => 'required',
                'kab_kota' => 'required',
                'provinsi' => 'required',
                'kode_pos' => 'required',
                'no_hp_santri' => 'required',
                'email_santri' => 'required|email',
                'mulai_masuk_tanggal' => 'required',
                'jumlah_saudara_kandung' => 'required',
                'anak_ke' => 'required',

                //Identitas Ayah
                'nama_ayah' => 'required',
                'pendidikan_ayah' => 'required',
                'pekerjaan_ayah' => 'required',
                'pendapatan_ayah_perbulan' => 'required',

                //Identitas Ibu
                'nama_ibu' => 'required',
                'pendidikan_ibu' => 'required',
                'pekerjaan_ibu' => 'required',
                'pendapatan_ibu_perbulan' => 'required',

                //Identitas wali
                'nama_wali' => 'required',
                'no_identitas_wali' => 'required',
                'tempat_tanggal_lahir_wali' => 'required',
                'rt_wali' => 'required',
                'rw_wali' => 'required',
                'dusun_wali' => 'required',
                'desa_wali' => 'required',
                'kecamatan_wali' => 'required',
                'kab_kota_wali' => 'required',
                'provinsi_wali' => 'required',
                'kode_pos_wali' => 'required',
                'status_wali' => 'required',
                'no_hp_wali_pendaftar' => 'required',
                'email_wali_pendaftar' => 'required|email',
                'pendidikan_wali' => 'required',
                'pekerjaan_wali' => 'required',
                'pendapatan_wali_perbulan' => 'required',

                //Berkas-berkas
                'ktp_santri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'kk_santri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'akta_santri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'pas_foto_santri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status_santri' => 'required',
            ], [
                'nama_santri.required' => 'Masukkan nama santri terlebih dahulu!',
                'no_identitas.required' => 'Masukkan no identitas santri terlebih dahulu!',
                'tempat_tanggal_lahir_santri.required' => 'Masukkan tempat, tanggal lahir santri terlebih dahulu!',
                'jenis_kelamin_santri.required' => 'Pilih jenis kelamin santri terlebih dahulu!',
                'rt.required' => 'Masukkan rt santri terlebih dahulu!',
                'rw.required' => 'Masukkan rw santri terlebih dahulu!',
                'dusun.required' => 'Masukkan dusun santri terlebih dahulu!',
                'desa.required' => 'Masukkan desa santri terlebih dahulu!',
                'kecamatan.required' => 'Masukkan kecamatan santri terlebih dahulu!',
                'kab_kota.required' => 'Masukkan kab/kota santri terlebih dahulu!',
                'provinsi.required' => 'Masukkan alamat santri terlebih dahulu!',
                'kode_pos.required' => 'Masukkan propinsi santri terlebih dahulu!',
                'no_hp_santri.required' => 'Masukkan nomor HP santri terlebih dahulu!',
                'email_santri.required' => 'Masukkan email santri terlebih dahulu!',
                'email_santri.email' => 'Format email tidak valid!',
                'nama_ayah.required' => 'Masukkan nama ayah santri',
                'pendidikan_ayah.required' => 'Masukkan pendidikan terakhir ayah santri',
                'pekerjaan_ayah.required' => 'Masukkan pekerjaan ayah santri',
                'pendapatan_ayah_perbulan.required' => 'Masukkan pendapatan perbulan ayah santri',
                'nama_ibu.required' => 'Masukkan nama ibu santri',
                'pendidikan_ibu.required' => 'Masukkan pendidikan terakhir ayah santri',
                'pekerjaan_ibu.required' => 'Masukkan perkerjaan ibu santri',
                'pendapatan_ibu_perbulan.required' => 'Masukkan pendapatan perbulan ibu santri',
                'nama_wali_santri.required' => 'Masukkan nama wali santri terlebih dahulu!',
                'no_identitas_wali'=> '',
                'tempat_tanggal_lahir_wali'=> '',
                'rt_wali'=> 'Masukkan rt wali terlebih dahulu!',
                'rw_wali'=> 'Masukkan rw wali terlebih dahulu!',
                'dusun_wali'=> 'Masukkan dusun wali terlebih dahulu!',
                'desa_wali'=> 'Masukkan desa wali terlebih dahulu!',
                'kecamatan_wali'=> 'Masukkan kecamatan wali terlebih dahulu!',
                'kab_kota_wali'=> 'Masukkan kab/kota wali terlebih dahulu!',
                'provinsi_wali'=> 'Masukkan provinsi wali terlebih dahulu!',
                'kode_pos_wali'=> 'Masukkan kode pos wali terlebih dahulu!',
                'status_wali'=> 'Masukkan status wali wali terlebih dahulu!',
                'no_hp_wali_santri.required' => 'Masukkan nomor HP wali santri terlebih dahulu!',
                'email_wali_santri.required' => 'Masukkan email wali santri terlebih dahulu!',
                'email_wali_santri.email' => 'Format email wali santri tidak valid!',
                'pendidikan_wali' => 'Masukkan pendidikan wali santri!',
                'pekerjaan_wali' => 'Masukkan pekerjaan wali santri!',
                'pendapatan_wali_perbulan' => 'Masukkan pendapatan wali perbulan!',
                'password_wali_santri.required' => 'Masukkan password wali santri terlebih dahulu!',
                'ktp_santri.required' => 'Upload file KTP santri terlebih dahulu!',
                'ktp_santri.image' => 'File harus berupa gambar!',
                'ktp_santri.mimes' => 'Format file KTP harus jpeg, png, jpg, atau gif!',
                'ktp_santri.max' => 'Ukuran file KTP maksimal 2 MB!',
                'kk_santri.required' => 'Upload file KK santri terlebih dahulu!',
                'kk_santri.image' => 'File harus berupa gambar!',
                'kk_santri.mimes' => 'Format file KK harus jpeg, png, jpg, atau gif!',
                'kk_santri.max' => 'Ukuran file KK maksimal 2 MB!',
                'akta_santri.required' => 'Upload file Akta santri terlebih dahulu!',
                'akta_santri.image' => 'File harus berupa gambar!',
                'akta_santri.mimes' => 'Format file Akta harus jpeg, png, jpg, atau gif!',
                'akta_santri.max' => 'Ukuran file Akta maksimal 2 MB!',
                'pas_foto_santri.required' => 'Upload file Pas Foto santri terlebih dahulu!',
                'pas_foto_santri.image' => 'File harus berupa gambar!',
                'pas_foto_santri.mimes' => 'Format file Pas Foto harus jpeg, png, jpg, atau gif!',
                'pas_foto_santri.max' => 'Ukuran file Pas Foto maksimal 2 MB!',
            ]);

            $nama_santri = $request->input('nama_santri');

            // Perbarui gambar jika ada
            if ($request->hasFile('ktp_santri')) {
                $ktpSantri = $request->file('ktp_santri');
                $ktpSantriName = $nama_santri . "_" . uniqid() . "_" . $ktpSantri->getClientOriginalName();
                $ktpSantri->move(public_path('berkas_santri/ktp_santri'), $ktpSantriName);
                Santri::where('id_santri', $id_santri)->update([
                    'ktp_santri' => $ktpSantriName,
                ]);
            }

            if ($request->hasFile('kk_santri')) {
                $kkSantri = $request->file('kk_santri');
                $kkSantriName = $nama_santri . "_" . uniqid() . "_" . $kkSantri->getClientOriginalName();
                $kkSantri->move(public_path('berkas_santri/kk_santri'), $kkSantriName);
                Santri::where('id_santri', $id_santri)->update([
                    'kk_santri' => $kkSantriName,
                ]);
            }

            if ($request->hasFile('akta_santri')) {
                $aktaSantri = $request->file('akta_santri');
                $aktaSantriName = $nama_santri . "_" . uniqid() . "_" . $aktaSantri->getClientOriginalName();
                $aktaSantri->move(public_path('berkas_santri/akta_santri'), $aktaSantriName);
                Santri::where('id_santri', $id_santri)->update([
                    'akta_santri' => $aktaSantriName,
                ]);
            }

            if ($request->hasFile('pas_foto_santri')) {
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
                'no_identitas' => $request->input('no_identitas'),
                'tempat_tanggal_lahir_santri' => $request->input('tempat_tanggal_lahir_santri'),
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
                'mulai_masuk_tanggal' => $request->input('mulai_masuk_tanggal'),
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

                //Identitas Wali
                'nama_lengkap_wali' => $request->input('nama_lengkap_wali'),
                'no_identitas_wali' => $request->input('no_identitas_wali'),
                'tempat_tanggal_lahir_wali' => $request->input('tempat_tanggal_lahir_wali'),
                'rt_wali' => $request->input('rt_wali'),
                'rw_wali' => $request->input('rw_wali'),
                'dusun_wali' => $request->input('rw_wali'),
                'desa_wali' => $request->input('desa_wali'),
                'kecamatan_wali' => $request->input('kecamatan_wali'),
                'kab_kota_wali' => $request->input('kab_kota_wali'),
                'provinsi_wali' => $request->input('provinsi_wali'),
                'kode_pos_wali' => $request->input('kode_pos_wali'),
                'status_wali' => $request->input('status_wali'),
                'no_hp_wali' => $request->input('no_hp_wali'),
                'email_wali' => $request->input('email_wali'),
                'pendidikan_wali' => $request->input('pendidikan_wali'),
                'pekerjaan_wali' => $request->input('pekerjaan_wali'),
                'pendapatan_wali_perbulan' => $request->input('pendapatan_wali_perbulan'),

                //Berkas-berkas
                'ktp_santri' => $ktpSantriName,
                'kk_santri' => $kkSantriName,
                'akta_santri' => $aktaSantriName,
                'pas_foto_santri' => $pasfotoSantriName,
                'status' => 'sudah_verifikasi',
            ]);

            // Tambah wali santri
            $wali_santri = WaliSantri::where('id_santri', $id_santri)->update([
                'id_santri' => $id_santri,
                'nama_lengkap_wali' => $request->input('nama_lengkap_wali'),
                'no_identitas_wali' => $request->input('no_identitas_wali'),
                'tempat_tanggal_lahir_wali' => $request->input('tempat_tanggal_lahir_wali'),
                'rt_wali' => $request->input('rt_wali'),
                'rw_wali' => $request->input('rw_wali'),
                'dusun_wali' => $request->input('rw_wali'),
                'desa_wali' => $request->input('desa_wali'),
                'kecamatan_wali' => $request->input('kecamatan_wali'),
                'kab_kota_wali' => $request->input('kab_kota_wali'),
                'provinsi_wali' => $request->input('provinsi_wali'),
                'kode_pos_wali' => $request->input('kode_pos_wali'),
                'status_wali' => $request->input('status_wali'),
                'no_hp_wali' => $request->input('no_hp_wali'),
                'email_wali' => $request->input('email_wali'),
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
            // Hapus wali santri
            $wali_santri = WaliSantri::where('id_santri', $id_santri);
            if (!$wali_santri) {
                throw new \Exception('Wali santri tidak ditemukan.');
            }
            $wali_santri->delete();

            // Hapus santri
            $santri = Santri::where('id_santri', $id_santri);
            if (!$santri) {
                throw new \Exception('Santri tidak ditemukan.');
            }
            $santri->delete();

            return redirect()->back()->with('success', 'Santri berhasil dihapus.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
}
