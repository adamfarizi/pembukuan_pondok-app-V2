<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Surah;
use App\Models\Santri;
use App\Models\Hafalan;
use App\Models\Pembayaran;
use App\Models\WaliSantri;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Helpers\SemesterHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AdminPendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Pendaftaran';

        if ($request->ajax()) {
            $data = Pendaftaran::where('status', 'belum_verifikasi')->get();
            return DataTables::of($data)
                ->make(true);
        }

        $pendaftarans = Pendaftaran::all();

        return view('admin.pendaftaran.pendaftaran', [

        ], $data);
    }

    public function index_info($id_pendaftar)
    {
        $data['title'] = 'Pendaftaran';

        $pendaftar = Pendaftaran::where('id_pendaftar', $id_pendaftar)->first();

        return view('admin.pendaftaran.info.info', [
            'pendaftar' => $pendaftar,
        ], $data);
    }

    public function create(Request $request, $id_pendaftar)
    {
        // Validasi data input
        $validated = $request->validate([
            //Indentitas calon santri
            'nama_pendaftar' => 'required|string|max:255',
            'no_identitas' => 'required|string|max:255',
            'tempat_tanggal_lahir_pendaftar' => 'required|string|max:255',
            'jenis_kelamin_pendaftar' => 'required|in:laki-laki,perempuan',
            'rt' => 'required|string|max:15',
            'rw' => 'required|string|max:15',
            'dusun' => 'required|string|max:255',
            'desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kab_kota' => 'required|string|max:255',
            'propinsi' => 'required|string|max:225',
            'kode_pos' => 'required|string|max:15',
            'no_hp_pendaftar' => 'required|string|max:15',
            'email_pendaftar' => 'required|email|max:255|unique:pendaftarans,email_pendaftar,' . $id_pendaftar . ',id_pendaftar',
            'mulai_masuk_tanggal' => 'required|string|max:225',
            'jumlah_saudara_kandung' => 'required|string|max:15',
            'anak_ke' => 'required|string|max:15',

            //Identitas Ayah
            'nama_ayah_pendaftar' => 'required|string|max:225',
            'pendidikan_ayah' => 'required|string|max:225',
            'pekerjaan_ayah' => 'required|string|max:225',
            'pendapatan_ayah_perbulan' => 'required|string|max:225',

            //Identitas Ibu
            'nama_ibu_pendaftar' => 'required|string|max:225',
            'pendidikan_ibu' => 'required|string|max:225',
            'pekerjaan_ibu' => 'required|string|max:225',
            'pendapatan_ibu_perbulan' => 'required|string|max:225',

            //Identitas Wali
            'nama_wali_pendaftar' => 'required|string|max:255',
            'no_identitas_wali' => 'required|string|max:255',
            'tempat_tanggal_lahir_wali' => 'required|string|max:255',
            'rt_wali' => 'required|string|max:15',
            'rw_wali' => 'required|string|max:15',
            'dusun_wali' => 'required|string|max:255',
            'desa_wali' => 'required|string|max:255',
            'kecamatan_wali' => 'required|string|max:255',
            'kab_kota_wali' => 'required|string|max:255',
            'propinsi_wali' => 'required|string|max:225',
            'kode_pos_wali' => 'required|string|max:15',
            'status_wali' => 'required|string|max:225',
            'no_hp_wali_pendaftar' => 'required|string|max:15',
            'email_wali_pendaftar' => 'required|email|max:255|unique:pendaftarans,email_wali_pendaftar,' . $id_pendaftar . ',id_pendaftar',
            'pekerjaan_wali' => 'required|string|max:225',
            'pendapatan_wali_perbulan' => 'required|string|max:225',

            //Berkas-berkas
            'ktp_pendaftar' => 'nullable|file|mimes:jpg,jpeg,png',
            'kk_pendaftar' => 'nullable|file|mimes:jpg,jpeg,png',
            'akta_pendaftar' => 'nullable|file|mimes:jpg,jpeg,png',
            'pas_foto_pendaftar' => 'nullable|file|mimes:jpg,jpeg,png',
        ]);

        // Temukan pendaftar
        $pendaftar = Pendaftaran::findOrFail($id_pendaftar);

        // Handle file uploads
        $ktpPendaftar = $request->file('ktp_pendaftar');
        $kkPendaftar = $request->file('kk_pendaftar');
        $aktaPendaftar = $request->file('akta_pendaftar');
        $pasfotoPendaftar = $request->file('pas_foto_pendaftar');

        $namaPendaftar = $request->input('nama_pendaftar');

        $ktpPendaftarName = $pendaftar->ktp_pendaftar;
        $kkPendaftarName = $pendaftar->kk_pendaftar;
        $aktaPendaftarName = $pendaftar->akta_pendaftar;
        $pasfotoPendaftarName = $pendaftar->pas_foto_pendaftar;

        // Simpan file KTP
        if ($ktpPendaftar) {
            // Hapus berkas lama jika ada
            if ($pendaftar->ktp_pendaftar) {
                unlink(public_path('berkas_pendaftar/ktp_pendaftar/' . $pendaftar->ktp_pendaftar));
            }

            $ktpPendaftarName = $namaPendaftar . "_" . uniqid() . "_" . $ktpPendaftar->getClientOriginalName();
            $ktpPendaftar->move(public_path('berkas_santri/ktp_santri'), $ktpPendaftarName);

            // Jika berkas berbeda, perbarui yang ada di folder pendaftaran
            if ($ktpPendaftarName != $pendaftar->ktp_pendaftar) {
                unlink(public_path('berkas_pendaftar/ktp_pendaftar/' . $pendaftar->ktp_pendaftar));
                copy(public_path('berkas_santri/ktp_santri/' . $ktpPendaftarName), public_path('berkas_pendaftar/ktp_pendaftar/' . $ktpPendaftarName));
            }
        } else {
            // Jika tidak ada perubahan, pindahkan dari pendaftar ke santri
            if ($pendaftar->ktp_pendaftar) {
                copy(public_path('berkas_pendaftar/ktp_pendaftar/' . $pendaftar->ktp_pendaftar), public_path('berkas_santri/ktp_santri/' . $pendaftar->ktp_pendaftar));
            }
        }

        // Simpan file KK
        if ($kkPendaftar) {
            // Hapus berkas lama jika ada
            if ($pendaftar->kk_pendaftar) {
                unlink(public_path('berkas_pendaftar/kk_pendaftar/' . $pendaftar->kk_pendaftar));
            }

            $kkPendaftarName = $namaPendaftar . "_" . uniqid() . "_" . $kkPendaftar->getClientOriginalName();
            $kkPendaftar->move(public_path('berkas_santri/kk_santri'), $kkPendaftarName);

            // Jika berkas berbeda, perbarui yang ada di folder pendaftaran
            if ($kkPendaftarName != $pendaftar->kk_pendaftar) {
                unlink(public_path('berkas_pendaftar/kk_pendaftar/' . $pendaftar->kk_pendaftar));
                copy(public_path('berkas_santri/kk_santri/' . $kkPendaftarName), public_path('berkas_pendaftar/kk_pendaftar/' . $kkPendaftarName));
            }
        } else {
            // Jika tidak ada perubahan, pindahkan dari pendaftar ke santri
            if ($pendaftar->kk_pendaftar) {
                copy(public_path('berkas_pendaftar/kk_pendaftar/' . $pendaftar->kk_pendaftar), public_path('berkas_santri/kk_santri/' . $pendaftar->kk_pendaftar));
            }
        }

        // Simpan file Akta
        if ($aktaPendaftar) {
            // Hapus berkas lama jika ada
            if ($pendaftar->akta_pendaftar) {
                unlink(public_path('berkas_pendaftar/akta_pendaftar/' . $pendaftar->akta_pendaftar));
            }

            $aktaPendaftarName = $namaPendaftar . "_" . uniqid() . "_" . $aktaPendaftar->getClientOriginalName();
            $aktaPendaftar->move(public_path('berkas_santri/akta_santri'), $aktaPendaftarName);

            // Jika berkas berbeda, perbarui yang ada di folder pendaftaran
            if ($aktaPendaftarName != $pendaftar->akta_pendaftar) {
                unlink(public_path('berkas_pendaftar/akta_pendaftar/' . $pendaftar->akta_pendaftar));
                copy(public_path('berkas_santri/akta_santri/' . $aktaPendaftarName), public_path('berkas_pendaftar/akta_pendaftar/' . $aktaPendaftarName));
            }
        } else {
            // Jika tidak ada perubahan, pindahkan dari pendaftar ke santri
            if ($pendaftar->akta_pendaftar) {
                copy(public_path('berkas_pendaftar/akta_pendaftar/' . $pendaftar->akta_pendaftar), public_path('berkas_santri/akta_santri/' . $pendaftar->akta_pendaftar));
            }
        }

        // Simpan file Pas Foto
        if ($pasfotoPendaftar) {
            // Hapus berkas lama jika ada
            if ($pendaftar->pas_foto_pendaftar) {
                unlink(public_path('berkas_pendaftar/pas_foto_pendaftar/' . $pendaftar->pas_foto_pendaftar));
            }

            $pasfotoPendaftarName = $namaPendaftar . "_" . uniqid() . "_" . $pasfotoPendaftar->getClientOriginalName();
            $pasfotoPendaftar->move(public_path('berkas_santri/pas_foto_santri'), $pasfotoPendaftarName);

            // Jika berkas berbeda, perbarui yang ada di folder pendaftaran
            if ($pasfotoPendaftarName != $pendaftar->pas_foto_pendaftar) {
                unlink(public_path('berkas_pendaftar/pas_foto_pendaftar/' . $pendaftar->pas_foto_pendaftar));
                copy(public_path('berkas_santri/pas_foto_santri/' . $pasfotoPendaftarName), public_path('berkas_pendaftar/pas_foto_pendaftar/' . $pasfotoPendaftarName));
            }
        } else {
            // Jika tidak ada perubahan, pindahkan dari pendaftar ke santri
            if ($pendaftar->pas_foto_pendaftar) {
                copy(public_path('berkas_pendaftar/pas_foto_pendaftar/' . $pendaftar->pas_foto_pendaftar), public_path('berkas_santri/pas_foto_santri/' . $pendaftar->pas_foto_pendaftar));
            }
        }

        //* Update pendaftar data
        $pendaftar->update([
            'nama_pendaftar' => $request->input('nama_pendaftar'),
            'no_identitas' => $request->input('no_identitas'),
            'tempat_tanggal_lahir_pendaftar' => $request->input('tempat_tanggal_lahir_pendaftar'),
            'jenis_kelamin_pendaftar' => $request->input('jenis_kelamin_pendaftar'),
            'rt' => $request->input('rt'),
            'rw' => $request->input('rw'),
            'dusun' => $request->input('dusun'),
            'desa' => $request->input('desa'),
            'kecamatan' => $request->input('kecamatan'),
            'kab_kota' => $request->input('kab_kota'),
            'propinsi' => $request->input('propinsi'),
            'kode_pos' => $request->input('kode_pos'),
            'no_hp_pendaftar' => $request->input('no_hp_pendaftar'),
            'email_pendaftar' => $request->input('email_pendaftar'),
            'mulai_masuk_tanggal' => $request->input('mulai_masuk_tanggal'),
            'jumlah_saudara_kandung' => $request->input('jumlah_saudara_kandung'),
            'anak_ke' => $request->input('anak_ke'),

            //Identitas Ayah
            'nama_ayah_pendaftar' => $request->input('nama_ayah_pendaftar'),
            'pendidikan_ayah' => $request->input('pendidikan_ayah'),
            'pekerjaan_ayah' => $request->input('pekerjaan_ayah'),
            'pendapatan_ayah_perbulan' => $request->input('pendapatan_ayah_perbulan'),

            //Identitas Ibu
            'nama_ibu_pendaftar' => $request->input('nama_ibu_pendaftar'),
            'pendidikan_ibu' => $request->input('pendidikan_ibu'),
            'pekerjaan_ibu' => $request->input('pekerjaan_ibu'),
            'pendapatan_ibu_perbulan' => $request->input('pendapatan_ibu_perbulan'),

            //Identitas Wali
            'nama_lengkap_wali_pendaftar' => $request->input('nama_lengkap_wali_pendaftar'),
            'no_identitas_wali' => $request->input('no_identitas_wali'),
            'tempat_tanggal_lahir_wali' => $request->input('tempat_tanggal_lahir_wali'),
            'rt_wali' => $request->input('rt_wali'),
            'rw_wali' => $request->input('rw_wali'),
            'dusun_wali' => $request->input('rw_wali'),
            'desa_wali' => $request->input('desa_wali'),
            'kecamatan_wali' => $request->input('kecamatan_wali'),
            'kab_kota_wali' => $request->input('kab_kota_wali'),
            'propinsi_wali' => $request->input('propinsi_wali'),
            'kode_pos_wali' => $request->input('kode_pos_wali'),
            'status_wali' => $request->input('status_wali'),
            'no_hp_wali_pendaftar' => $request->input('no_hp_wali_pendaftar'),
            'email_wali_pendaftar' => $request->input('email_wali_pendaftar'),

            //Berkas-berkas
            'ktp_pendaftar' => $ktpPendaftarName,
            'kk_pendaftar' => $kkPendaftarName,
            'akta_pendaftar' => $aktaPendaftarName,
            'pas_foto_pendaftar' => $pasfotoPendaftarName,
            'status' => 'sudah_verifikasi',
        ]);

        //* Create santri data
        $santri = Santri::create([
            'nama_santri' => $request->input('nama_pendaftar'),
            'tempat_tanggal_lahir_santri' => $request->input('tempat_tanggal_lahir_pendaftar'),
            'jenis_kelamin_santri' => $request->input('jenis_kelamin_pendaftar'),
            'status_santri' => 'aktif',
            'rt' => $request->input('rt'),
            'rw' => $request->input('rw'),
            'dusun' => $request->input('dusun'),
            'desa' => $request->input('desa'),
            'kecamatan' => $request->input('kecamatan'),
            'kab_kota' => $request->input('kab_kota'),
            'propinsi' => $request->input('propinsi'),
            'kode_pos' => $request->input('kode_pos'),
            'no_hp_santri' => $request->input('no_hp_pendaftar'),
            'email_santri' => $request->input('email_pendaftar'),
            'ktp_santri' => $ktpPendaftarName,
            'kk_santri' => $kkPendaftarName,
            'akta_santri' => $aktaPendaftarName,
            'pas_foto_santri' => $pasfotoPendaftarName,
            'tahun_masuk' => now()->year,
        ]);

        //* Create wali santri data
        WaliSantri::create([
            'id_santri' => $santri->id_santri,
            'nama_wali_santri' => $request->input('nama_wali_pendaftar'),
            'rt_wali' => $request->input('rt_wali'),
            'rw_wali' => $request->input('rw_wali'),
            'dusun_wali' => $request->input('rw_wali'),
            'desa_wali' => $request->input('desa_wali'),
            'kecamatan_wali' => $request->input('kecamatan_wali'),
            'kab_kota_wali' => $request->input('kab_kota_wali'),
            'propinsi_wali' => $request->input('propinsi_wali'),
            'kode_pos_wali' => $request->input('kode_pos_wali'),
            'email' => $request->input('email_wali_pendaftar'),
            'password' => Hash::make($pendaftar->kode_pendaftaran),
            'no_hp' => $request->input('no_hp_wali_pendaftar'),
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

        return redirect()->route('pendaftaran')->with('success', 'Data santri berhasil di verifikasi !');
    }
}
