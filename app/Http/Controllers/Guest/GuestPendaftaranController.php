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
            'jenis_kelamin_pendaftar' => 'required|in:laki-laki,perempuan',
            'no_hp_pendaftar' => 'required|string|max:15',
            'email_pendaftar' => 'required|email|max:255|unique:pendaftarans,email_pendaftar',

            'no_hp_wali_pendaftar' => 'required|string|max:15',
            'email_wali_pendaftar' => 'required|email|max:255|unique:pendaftarans,email_wali_pendaftar',
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
            'provinsi' => $request->provinsi,
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
            'nama_wali_pendaftar' => $request->nama_wali_pendaftar,
            'no_identitas_wali' => $request->no_identitas_wali,
            'tempat_tanggal_lahir_wali' => $request->tempat_tanggal_lahir_wali,
            'rt_wali' => $request->rt_wali,
            'rw_wali' => $request->rw_wali,
            'dusun_wali' => $request->rw_wali,
            'desa_wali' => $request->desa_wali,
            'kecamatan_wali' => $request->kecamatan_wali,
            'kab_kota_wali' => $request->kab_kota_wali,
            'provinsi_wali' => $request->provinsi_wali,
            'kode_pos_wali' => $request->kode_pos_wali,
            'status_wali' => $request->status_wali,
            'pekerjaan_wali' => $request->pekerjaan_wali,
            'pendapatan_wali_perbulan' => $request->pendapatan_wali_perbulan,
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
