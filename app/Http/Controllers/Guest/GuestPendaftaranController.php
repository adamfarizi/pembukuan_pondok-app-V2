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
            'nama_pendaftar' => 'required|string',
            'tempat_tanggal_lahir_pendaftar' => 'required|string',
            'jenis_kelamin_pendaftar' => 'required|in:laki-laki,perempuan',
            'alamat_pendaftar' => 'required|string',
            'no_hp_pendaftar' => 'required|string',
            'email_pendaftar' => 'required|email|unique:pendaftarans,email_pendaftar',
            'nama_wali_pendaftar' => 'required|string',
            'no_hp_wali_pendaftar' => 'required|string',
            'email_wali_pendaftar' => 'required|email|unique:pendaftarans,email_wali_pendaftar',
            'ktp_pendaftar' => 'required|image',
            'kk_pendaftar' => 'required|image',
            'akta_kelahiran_pendaftar' => 'required|image',
            'pasfoto_pendaftar' => 'required|image',
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
            'tempat_tanggal_lahir_pendaftar' => $request->tempat_tanggal_lahir_pendaftar,
            'jenis_kelamin_pendaftar' => $request->jenis_kelamin_pendaftar,
            'alamat_pendaftar' => $request->alamat_pendaftar,
            'no_hp_pendaftar' => $request->no_hp_pendaftar,
            'email_pendaftar' => $request->email_pendaftar,
            'ktp_pendaftar' => $ktpPendaftarName,
            'kk_pendaftar' => $kkPendaftarName,
            'akta_pendaftar' => $aktaPendaftarName,
            'pas_foto_pendaftar' => $pasfotoPendaftarName,
            'nama_wali_pendaftar' => $request->nama_wali_pendaftar,
            'no_hp_wali_pendaftar' => $request->no_hp_wali_pendaftar,
            'email_wali_pendaftar' => $request->email_wali_pendaftar,
            'alamat_wali_santri' => $request->alamat_wali_pendaftar,
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
