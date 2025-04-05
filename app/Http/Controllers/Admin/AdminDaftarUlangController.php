<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pembayaran;
use App\Models\MasterAdmin;
use Illuminate\Http\Request;
use App\Helpers\SemesterHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AdminDaftarUlangController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Daftar Ulang';

        $currentSemester = SemesterHelper::getCurrentSemester();

        if ($request->ajax()) {
            $data = Pembayaran::where('semester_ajaran', $currentSemester['semester'])
                ->where('tahun_ajaran', $currentSemester['tahun'])
                ->where('jenis_pembayaran', 'daftar_ulang')
                ->where('status_pembayaran', 'lunas')
                ->with(['santri', 'user']);

            // Akses Santri
            $akses = Auth::user()->akses_santri;
            if ($akses == "putra") {
                $data->whereHas('santri', function ($query) {
                    $query->where('jenis_kelamin_santri', 'laki-laki');
                });
            } elseif ($akses == "putri") {
                $data->whereHas('santri', function ($query) {
                    $query->where('jenis_kelamin_santri', 'perempuan');
                });
            }
            
            $data->orderBy('tanggal_pembayaran', 'desc')->get();
            
            return DataTables::of($data)
                ->make(true);
        }

        $pembayarans = Pembayaran::orderBy('created_at', 'desc')
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->where('jenis_pembayaran', 'daftar_ulang')
            ->where('status_pembayaran', 'belum_lunas')
            ->where('jumlah_bayar', 0)
            ->with(['santri', 'user'])
            ->get();

        $pembayarans_lunas = Pembayaran::orderBy('created_at', 'desc')
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->where('jenis_pembayaran', 'daftar_ulang')
            ->where('status_pembayaran', 'lunas')
            ->with(['santri', 'user'])
            ->get();

        return view('admin.pembayaran.daftar_ulang', [
            'currentSemester' => $currentSemester,
            'pembayarans' => $pembayarans,
            'pembayarans_lunas' => $pembayarans_lunas,
        ], $data);
    }

    public function select2(Request $request)
    {
        $currentSemester = SemesterHelper::getCurrentSemester();

        $data = Pembayaran::orderBy('created_at', 'desc')
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->where('jenis_pembayaran', 'daftar_ulang')
            ->where('status_pembayaran', 'belum_lunas')
            ->where('jumlah_bayar', 0)
            ->whereHas('santri', function ($query) use ($request) {
                $query->where('nama_santri', 'like', '%' . $request->q . '%');
            })
            ->with(['santri', 'user']);

        // Akses Santri
        $akses = Auth::user()->akses_santri;
        if ($akses == "putra") {
            $data->whereHas('santri', function ($query) {
                $query->where('jenis_kelamin_santri', 'laki-laki');
            });
        } elseif ($akses == "putri") {
            $data->whereHas('santri', function ($query) {
                $query->where('jenis_kelamin_santri', 'perempuan');
            });
        }
        
        $data = $data->get();

        return response()->json($data);
    }

    public function edit(Request $request, $id_santri)
    {
        $currentSemester = SemesterHelper::getCurrentSemester();
        $pembayaran = Pembayaran::where('id_santri', $id_santri)
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->where('jenis_pembayaran', 'daftar_ulang')
            ->where('status_pembayaran', 'belum_lunas')
            ->first();

        $statusPotonganHarga = $request->input('status_potongan_harga');
        $potonganHarga = $request->input('potongan_harga');

        if ($statusPotonganHarga == "true" && $pembayaran) {
            // Jika status potongan harga true, maka update harga beserta potongan harga
            $pembayaran->jumlah_pembayaran_sebelum_potongan = $pembayaran->jumlah_pembayaran;
            $pembayaran->jumlah_potongan = $potonganHarga;
            $pembayaran->jumlah_pembayaran = $pembayaran->jumlah_pembayaran_sebelum_potongan - $potonganHarga;
            $pembayaran->jumlah_bayar = $pembayaran->jumlah_pembayaran;

            // Mengubah status pembayaran menjadi lunas
            $pembayaran->tanggal_pembayaran = now();
            $pembayaran->id_admin = Auth::user()->id_admin;
            $pembayaran->status_pembayaran = 'lunas';

            // Simpan perubahan ke database
            $pembayaran->save();

            return redirect()->route('daftar_ulang')->with('success', 'Data pembayaran berhasil ditambahkan dengan potongan.');
        } elseif ($pembayaran) {
            // Jika tidak ada potongan harga atau potongan tidak diterapkan, proses normal
            $pembayaran->jumlah_bayar = $pembayaran->jumlah_pembayaran;

            // Mengubah status pembayaran menjadi lunas
            $pembayaran->tanggal_pembayaran = now();
            $pembayaran->id_admin = Auth::user()->id_admin;
            $pembayaran->status_pembayaran = 'lunas';

            // Simpan perubahan ke database
            $pembayaran->save();

            return redirect()->route('daftar_ulang')->with('success', 'Data pembayaran berhasil ditambahkan.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Error: Data tidak ditemukan']);
        }
    }

    public function cancelPayment($id_pembayaran)
    {
        $currentSemester = SemesterHelper::getCurrentSemester();
        $pembayaran = Pembayaran::where('id_pembayaran', $id_pembayaran)
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->where('jenis_pembayaran', 'daftar_ulang')
            ->where('status_pembayaran', 'lunas')
            ->with('santri')
            ->first();

        if ($pembayaran) {
            // Mengembalikan data ke kondisi sebelum dibayar
            $pembayaran->tanggal_pembayaran = null;
            $pembayaran->id_admin = null;
            $pembayaran->jumlah_bayar = 0;
            $pembayaran->status_pembayaran = 'belum_lunas';

            if ($pembayaran->jumlah_pembayaran_sebelum_potongan && $pembayaran->jumlah_pembayaran_sebelum_potongan > 0) {
                // Menghapus potongan harga dan mengembalikan harga menjadi semula
                $pembayaran->jumlah_pembayaran = $pembayaran->jumlah_pembayaran_sebelum_potongan;
                $pembayaran->jumlah_pembayaran_sebelum_potongan = 0;
                $pembayaran->jumlah_potongan = 0;
            }

            // Simpan perubahan ke database
            $pembayaran->save();

            return redirect()->route('daftar_ulang')->with('success', 'Pembayaran berhasil dibatalkan.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Error: Data pembayaran tidak ditemukan atau sudah dibatalkan.']);
        }
    }
}