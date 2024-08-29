<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Surah;
use App\Models\Santri;
use App\Models\Hafalan;
use App\Models\Pembayaran;
use App\Models\WaliSantri;
use App\Models\MasterAdmin;
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
                ->addColumn('tempat_tanggal_lahir_pendaftar', function ($row) {
                    return $row->tempat_tanggal_lahir_pendaftar; // Menggunakan accessor dari model
                })
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
        try {
            // Validasi data input
            $request->validate([
                //Indentitas calon santri
                'jenis_kelamin_pendaftar' => 'required',
                'email_pendaftar' => 'required',

                'no_hp_wali_pendaftar' => 'required',
                'email_wali_pendaftar' => 'required',
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
                'status_pendaftar' => $request->input('status_pendaftar'),
                'tempat_lahir_pendaftar' => $request->input('tempat_lahir_pendaftar'),
                'tanggal_lahir_pendaftar' => $request->input('tanggal_lahir_pendaftar'),
                'jenis_kelamin_pendaftar' => $request->input('jenis_kelamin_pendaftar'),
                'rt' => $request->input('rt'),
                'rw' => $request->input('rw'),
                'dusun' => $request->input('dusun'),
                'desa' => $request->input('desa'),
                'kecamatan' => $request->input('kecamatan'),
                'kab_kota' => $request->input('kab_kota'),
                'provinsi' => $request->input('provinsi'),
                'kode_pos' => $request->input('kode_pos'),
                'no_hp_pendaftar' => $request->input('no_hp_pendaftar'),
                'email_pendaftar' => $request->input('email_pendaftar'),
                'mulai_masuk_tanggal' => $request->input('mulai_masuk_tanggal'),
                'tingkatan_pendaftar' => $request->input('tingkatan_pendaftar'),
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
                'tempat_lahir_wali' => $request->input('tempat_lahir_wali'),
                'tanggal_lahir_wali' => $request->input('tanggal_lahir_wali'),
                'rt_wali' => $request->input('rt_wali'),
                'rw_wali' => $request->input('rw_wali'),
                'dusun_wali' => $request->input('rw_wali'),
                'desa_wali' => $request->input('desa_wali'),
                'kecamatan_wali' => $request->input('kecamatan_wali'),
                'kab_kota_wali' => $request->input('kab_kota_wali'),
                'provinsi_wali' => $request->input('provinsi_wali'),
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
                'no_identitas' => $request->input('no_identitas'),
                'no_induk' => $request->input('no_induk'),
                'status_santri' => $request->input('status_pendaftar'),
                'tempat_lahir_santri' => $request->input('tempat_lahir_pendaftar'),
                'tanggal_lahir_santri' => $request->input('tanggal_lahir_pendaftar'),
                'jenis_kelamin_santri' => $request->input('jenis_kelamin_pendaftar'),
                'rt' => $request->input('rt'),
                'rw' => $request->input('rw'),
                'dusun' => $request->input('dusun'),
                'desa' => $request->input('desa'),
                'kecamatan' => $request->input('kecamatan'),
                'kab_kota' => $request->input('kab_kota'),
                'provinsi' => $request->input('provinsi'),
                'kode_pos' => $request->input('kode_pos'),
                'no_hp_santri' => $request->input('no_hp_pendaftar'),
                'email_santri' => $request->input('email_pendaftar'),
                'tahun_masuk' => now()->year,
                'tingkatan' => $request->input('tingkatan_pendaftar'),
                'jumlah_saudara_kandung' => $request->input('jumlah_saudara_kandung'),
                'anak_ke' => $request->input('anak_ke'),
                'nama_ayah' => $request->input('nama_ayah_pendaftar'),
                'pendidikan_ayah' => $request->input('pendidikan_ayah'),
                'pekerjaan_ayah' => $request->input('pekerjaan_ayah'),
                'pendapatan_ayah_perbulan' => $request->input('pendapatan_ayah_perbulan'),
                'nama_ibu' => $request->input('nama_ibu_pendaftar'),
                'pendidikan_ibu' => $request->input('pendidikan_ibu'),
                'pekerjaan_ibu' => $request->input('pekerjaan_ibu'),
                'pendapatan_ibu_perbulan' => $request->input('pendapatan_ibu_perbulan'),
                'ktp_santri' => $ktpPendaftarName,
                'kk_santri' => $kkPendaftarName,
                'akta_santri' => $aktaPendaftarName,
                'pas_foto_santri' => $pasfotoPendaftarName,
            ]);

            //* Create wali santri data
            WaliSantri::create([
                'id_santri' => $santri->id_santri,
                'nama_wali' => $request->input('nama_wali_pendaftar'),
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
                'email' => $request->input('email_wali_pendaftar'),
                'password' => Hash::make($pendaftar->kode_pendaftaran),
                'no_hp' => $request->input('no_hp_wali_pendaftar'),
                'status_wali' => $request->input('status_wali'),
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
            $total_iuran = $master->where('jenis_pembayaran', 'iuran')
                ->sum('jumlah_pembayaran');

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

            return redirect()->route('pendaftaran')->with('success', 'Data santri berhasil di verifikasi !');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('pendaftaran')->withErrors($e->errors())->withInput();
            // return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->route('pendaftaran')->withErrors(['error' => 'Error: ' . $e->getMessage()])->withInput();
            // return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()])->withInput();
        }

    }
}
