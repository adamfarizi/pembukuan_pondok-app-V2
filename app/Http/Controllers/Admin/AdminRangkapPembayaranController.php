<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SemesterHelper;
use App\Helpers\TagihanHelper;
use App\Http\Controllers\Controller;
use App\Models\cicilanPembayaran;
use App\Models\Pembayaran;
use App\Models\Santri;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class AdminRangkapPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Form Rangkap Pembayaran';

        $currentSemester = SemesterHelper::getCurrentSemester();

        if ($request->ajax()) {
            // Akses Santri
            $akses = Auth::user()->akses_santri;

            // Eager load relasi pembayaran agar tidak N+1
            $santris = Santri::with('pembayaran')
                ->where('status_aktif_santri', 'aktif')
                ->when($akses === "putra", fn($q) => $q->where('jenis_kelamin_santri', 'laki-laki'))
                ->when($akses === "putri", fn($q) => $q->where('jenis_kelamin_santri', 'perempuan'))
                ->orderBy('id_santri', 'desc')
                ->get();

            // Transform hasilnya sesuai kebutuhan JSON
            $result = $santris->map(function ($santri) {
                $tahunTerbaru = $santri->pembayaran
                    ->groupBy('jenis_pembayaran')
                    ->map(function ($items) {
                        return $items->max(fn($item) => Carbon::parse($item->created_at)->year);
                    });
                $bulanTerbaru = $santri->pembayaran
                    ->groupBy('jenis_pembayaran')
                    ->map(function ($items) {
                        return Carbon::parse(
                            $items->sortByDesc('created_at')->first()->created_at
                        )->month;
                    });
                $semesterTerbaru = $santri->pembayaran
                    ->groupBy('jenis_pembayaran')
                    ->map(function ($items) {
                        return $items->sortByDesc('created_at')->first()->semester_ajaran;
                    });

                return [
                    'id_santri' => $santri->id_santri,
                    'nama_santri' => $santri->nama_santri,
                    'bebas_daftar_ulang' => $santri->bebas_daftar_ulang,
                    'bebas_semester' => $santri->bebas_semester,
                    'bebas_iuran' => $santri->bebas_iuran,
                    'tagihan_santri' => $santri->tagihan_santri,
                    'semester_pembayaran_terbaru' => $semesterTerbaru,
                    'tahun_pembayaran_terbaru' => $tahunTerbaru,
                    'bulan_pembayaran_terbaru' => $bulanTerbaru,
                ];
            });

            return response()->json($result);
        }

        return view('admin.pembayaran.rangkap_pembayaran', [
            'currentSemester' => $currentSemester['semester'],
            'currentTahun' => $currentSemester['tahun']
        ], $data);
    }

    public function show_detail_tagihan_santri(Request $request, $id_santri)
    {

        if ($request->ajax()) {
            // Cek apakah tagihan sudah ada, sesuai dengan jenis pembayaran
            $data = Pembayaran::where('id_santri', $id_santri)
                ->where('status_pembayaran', 'belum_lunas')
                ->orderBy('tanggal_pembayaran', 'desc')
                ->get();

            return DataTables::of($data)
                ->make(true);
        }
    }

    public function addRangkapPembayaranAction(Request $request, $id_santri)
    {
        try {
            $request->validate([
                'jumlah_tagihan' => 'required',
                'nominal_pembayaran' => 'required',
            ], [
                'jumlah_tagihan.required' => 'Mohon untuk menambahkan pembayaran yang ingin dirangkap!',
                'nominal_pembayaran.required' => 'Masukkan nominal pembayaran sesuai dengan jumlah tagihan',
            ]);
        } catch (ValidationException $e) {
            $firstErrorMessage = collect($e->validator->errors()->all())->first();
            return redirect()->back()->withInput()->with('warning', $firstErrorMessage);
        }

        // Ambil pembayaran lama (boleh kosong)
        $id_pembayaran_lama = $request->input('id_pembayaran_lama', []);

        // Ambil pembayaran baru (boleh kosong)
        $jumlah_bayar_baru = $request->input('jumlah_bayar_baru', []);
        $jumlah_potongan_baru = $request->input('jumlah_potongan_baru', []);
        $jumlah_awal_baru = $request->input('jumlah_awal_baru', []);
        $jenis_bayar_baru = $request->input('jenis_bayar_baru', []);
        $semester_bayar_baru = $request->input('semester_bayar_baru', []);
        $createdAt_bayar_baru = $request->input('createdAt_bayar_baru', []);
        $tahun_bayar_baru = $request->input('tahun_bayar_baru', []);

        // Simpan pembayaran lama jika ada
        if (!empty($id_pembayaran_lama)) {
            foreach ($id_pembayaran_lama as $id) {

                $pembayaran = Pembayaran::where('id_pembayaran', $id)
                    ->where('id_santri', $id_santri)
                    ->first();

                $checkExistCicilan = cicilanPembayaran::where('id_pembayaran', $id)->first();

                if ($checkExistCicilan) {
                    $nominal_sisa_cicilan = $pembayaran->jumlah_pembayaran - $pembayaran->jumlah_bayar;
                    cicilanPembayaran::create([
                        'id_admin' => Auth::user()->id_admin,
                        'id_pembayaran' => $id,
                        'sub_bayar_cicilan' => $nominal_sisa_cicilan,
                        'tanggal_bayar' => now(),
                    ]);
                }

                $pembayaran->jumlah_bayar = $pembayaran->jumlah_pembayaran;
                $pembayaran->tanggal_pembayaran = now();
                $pembayaran->id_admin = Auth::user()->id_admin;
                $pembayaran->status_pembayaran = 'lunas';
                $pembayaran->save();
            }
        }

        // Simpan pembayaran baru jika ada dan jumlah bayar valid
        if (!empty($jumlah_bayar_baru)) {
            for ($i = 0; $i < count($jumlah_bayar_baru); $i++) {
                // Pastikan jumlah bayar tidak kosong
                if (!empty($jumlah_bayar_baru[$i])) {

                    $id_admin = Auth::user()->id_admin;
                    $jumlah_bayar = $jumlah_bayar_baru[$i];
                    $total_tagihan_sebelum_potongan = $jumlah_awal_baru[$i];
                    $total_potongan = $jumlah_potongan_baru[$i];
                    $jenis_pembayaran = $jenis_bayar_baru[$i];
                    $semester = $semester_bayar_baru[$i];
                    $tahun_ajaran = $tahun_bayar_baru[$i];
                    $createdAt = Carbon::parse($createdAt_bayar_baru[$i]);

                    // Simpan data ke tabel pembayaran
                    TagihanHelper::createRangkapPembayaranBaru(
                        $id_santri,
                        $id_admin,
                        $jenis_pembayaran,
                        $total_tagihan_sebelum_potongan,
                        $total_potongan,
                        $jumlah_bayar,
                        $jumlah_bayar,
                        $tahun_ajaran,
                        $semester,
                        $createdAt
                    );
                    // Contoh:
                    // Pembayaran::create([
                    //     'id_santri' => $id_santri,
                    //     'jumlah' => $jumlah_bayar_baru[$i],
                    //     'jenis' => $jenis_bayar_baru[$i] ?? null,
                    //     'semester' => $semester_bayar_baru[$i] ?? null,
                    //     'tahun_ajaran' => $tahun_bayar_baru[$i] ?? null,
                    //     'created_at_manual' => $createdAt_bayar_baru[$i] ?? now(),
                    // ]);
                }
            }
        }

        return redirect()->route('rangkap_pembayaran')->with('success', 'Data pembayaran berhasil ditambahkan');
    }
}