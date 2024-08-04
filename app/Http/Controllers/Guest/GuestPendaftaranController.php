<?php

namespace App\Http\Controllers\Guest;

use App\Models\Pendaftaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuestPendaftaranController extends Controller
{
    public function index()
    {
        $data['title'] = 'Pendaftaran Santri Baru';

        return view('guest.pendaftaran.pendaftaran', [

        ], $data);
    }

    public function create(Request $request)
    {
        // Validasi request
        $request->validate([
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
            'email_pendaftar' => 'required|email|max:255|unique:pendaftarans,email_pendaftar,id_pendaftar',
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
            'email_wali_pendaftar' => 'required|email|max:255|unique:pendaftarans,email_wali_pendaftar,id_pendaftar',
            'pekerjaan_wali' => 'required|string|max:225',
            'pendapatan_wali_perbulan' => 'required|string|max:225',
        ]);

        // Upload berkas
        $ktpPendaftar = $request->file('ktp_pendaftar');
        $kkPendaftar = $request->file('kk_pendaftar');
        $aktaPendaftar = $request->file('akta_kelahiran_pendaftar'); // Sesuaikan dengan nama field yang benar
        $pasfotoPendaftar = $request->file('pasfoto_pendaftar');

        
        // Mendapatkan nama asli file
        $namaPendaftar = $request->input('nama_pendaftar');
        $ktpPendaftarName = $namaPendaftar . "_" . uniqid() . "_" . $ktpPendaftar->getClientOriginalName();
        $kkPendaftarName = $namaPendaftar . "_" . uniqid() . "_" . $kkPendaftar->getClientOriginalName();
        $aktaPendaftarName = $namaPendaftar . "_" . uniqid() . "_" . $aktaPendaftar->getClientOriginalName();
        $pasfotoPendaftarName = $namaPendaftar . "_" . uniqid() . "_" . $pasfotoPendaftar->getClientOriginalName();

        if ($ktpPendaftar) {
            $ktpPendaftar->move(public_path('berkas_pendaftar/ktp_pendaftar'), $ktpPendaftarName);
        }
        if ($kkPendaftar) {
            $kkPendaftar->move(public_path('berkas_pendaftar/kk_pendaftar'), $kkPendaftarName);
        }
        if ($aktaPendaftar) {
            $aktaPendaftar->move(public_path('berkas_pendaftar/akta_pendaftar'), $aktaPendaftarName);
        }
        if ($pasfotoPendaftar) {
            $pasfotoPendaftar->move(public_path('berkas_pendaftar/pas_foto_pendaftar'), $pasfotoPendaftarName);
        }

        // Kode pendaftaran
        $kode_pendaftaran = strtoupper(Str::random(10));

        // Buat entri baru di database
        $pendaftaran = Pendaftaran::create([
            'kode_pendaftaran' => $kode_pendaftaran,
            'nama_pendaftar' => $request->nama_pendaftar,
            'no_identitas' => $request->no_identitas,
            'tempat_tanggal_lahir_pendaftar' => $request->tempat_tanggal_lahir_pendaftar,
            'jenis_kelamin_pendaftar' => $request->jenis_kelamin_pendaftar,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'dusun' => $request->dusun,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kab_kota' => $request->kab_kota,
            'propinsi' => $request->propinsi,
            'kode_pos' => $request->kode_pos,
            'no_hp_pendaftar' => $request->no_hp_pendaftar,
            'email_pendaftar' => $request->email_pendaftar,
            'mulai_masuk_tanggal' => $request->mulai_masuk_tanggal,
            'jumlah_saudara_kandung' => $request->jumlah_saudara_kandung,
            'anak_ke' => $request->anak_ke,

            //Identitas Ayah
            'nama_ayah_pendaftar' => $request->nama_ayah_pendaftar,
            'pendidikan_ayah' => $request->pendidikan_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'pendapatan_ayah_perbulan' => $request->pendapatan_ayah_perbulan,

            //Identitas Ibu
            'nama_ibu_pendaftar' => $request->nama_ibu_pendaftar,
            'pendidikan_ibu' => $request->pendidikan_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'pendapatan_ibu_perbulan' => $request->pendapatan_ibu_perbulan,

            //Identitas Wali
            'nama_lengkap_wali_pendaftar' => $request->nama_lengkap_wali_pendaftar,
            'no_identitas_wali' => $request->no_identitas_wali,
            'tempat_tanggal_lahir_wali' => $request->tempat_tanggal_lahir_wali,
            'rt_wali' => $request->rt_wali,
            'rw_wali' => $request->rw_wali,
            'dusun_wali' => $request->rw_wali,
            'desa_wali' => $request->desa_wali,
            'kecamatan_wali' => $request->kecamatan_wali,
            'kab_kota_wali' => $request->kab_kota_wali,
            'propinsi_wali' => $request->propinsi_wali,
            'kode_pos_wali' => $request->kode_pos_wali,
            'status_wali' => $request->status_wali,
            'no_hp_wali_pendaftar' => $request->no_hp_wali_pendaftar,
            'email_wali_pendaftar' => $request->email_wali_pendaftar,

            //Berkas-berkas
            'ktp_pendaftar' => $ktpPendaftarName,
            'kk_pendaftar' => $kkPendaftarName,
            'akta_pendaftar' => $aktaPendaftarName,
            'pas_foto_pendaftar' => $pasfotoPendaftarName,
        ]);

        // Redirect ke halaman yang sesuai
        return redirect()->route('guest.pendaftaran.konfirmasi', ['id' => $pendaftaran->id_pendaftar]);
    }

    public function index_konfirmasi($id_pendaftar)
    {
        $data['title'] = 'Pendaftaran Santri Baru';

        $kode_pendaftaran = Pendaftaran::where('id_pendaftar', $id_pendaftar)->pluck('kode_pendaftaran')->first();

        if ($kode_pendaftaran) {
            return view('guest.pendaftaran.konfirmasi.konfirmasi', [
                'kode_pendaftaran' => $kode_pendaftaran,
            ], $data);
        } else {
            return redirect()->route('login');
        }
    }
}
