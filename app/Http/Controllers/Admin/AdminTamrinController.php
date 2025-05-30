<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Helpers\SemesterHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\cicilanPembayaran;

class AdminTamrinController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Semester';

        $currentSemester = SemesterHelper::getCurrentSemester();

        $now = now(); // sekarang 2025-05-30
        $bulan = $now->month;
        $tahunSekarang = $now->year;
        $tahunAwalSekarang = ($bulan <= 6) ? $tahunSekarang - 1 : $tahunSekarang; // misal sekarang: 2024

        // Ambil tahun dari created_at terbaru
        $createdTerbaru = Pembayaran::where('jenis_pembayaran', 'tamrin')
            ->orderByDesc('created_at')
            ->value('created_at');

        $tahunTerbaru = $createdTerbaru
            ? (Carbon::parse($createdTerbaru)->month <= 6
                ? Carbon::parse($createdTerbaru)->year - 1
                : Carbon::parse($createdTerbaru)->year)
            : $tahunAwalSekarang;

        // Ambil tahun awal paling kecil antara sekarang - 4 atau berdasarkan created_at terbaru
        $tahunAwalTerendah = min($tahunAwalSekarang - 4, $tahunTerbaru - 4);
        $tahunAkhirTertinggi = max($tahunAwalSekarang, $tahunTerbaru);

        $selectedTahunAjaran = $tahunAwalSekarang . '/' . ($tahunAwalSekarang + 1);

        if ($request->ajax()) {
            $data = Pembayaran::where('jenis_pembayaran', 'tamrin')
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

            // Filter Tahun
            if ($request->filled('filter_tahun') || $request->filled('filter_semester')) {
                $filter_tahun = $request->filter_tahun;
                $semester = $request->filter_semester;

                $tahun_parts = explode('/', $filter_tahun);

                // Pilih tahun berdasarkan semester
                if ($semester === 'ganjil') {
                    $filter_tahun_key = $tahun_parts[0];
                } else {
                    $filter_tahun_key = $tahun_parts[1];
                }

                $data->where('tahun_ajaran', $filter_tahun_key);
                $data->where('semester_ajaran', $semester);
            } else {
                $data->where('tahun_ajaran', $currentSemester['tahun']);
                $data->where('semester_ajaran', $currentSemester['semester']);
            }

            // Filter Status Pembayaran
            if ($request->filled('filter_status') && $request->filter_status !== 'Semua') {
                if ($request->filter_status === 'Belum_bayar') {
                    $data->where('status_pembayaran', 'belum_lunas')->where('jumlah_bayar', 0);
                } elseif ($request->filter_status === 'Lunas') {
                    $data->where('status_pembayaran', 'lunas');
                } else {
                    $data->where('status_pembayaran', 'bebas_tagihan');
                }
            }

            $data->orderBy('tanggal_pembayaran', 'desc')->get();

            return DataTables::of($data)
                ->make(true);
        }

        $pembayarans = Pembayaran::orderBy('created_at', 'desc')
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->where('jenis_pembayaran', 'tamrin')
            ->where('status_pembayaran', 'belum_lunas')
            ->with(['santri', 'user'])
            ->get();

        $pembayarans_lunas = Pembayaran::orderBy('created_at', 'desc')
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->where('jenis_pembayaran', 'tamrin')
            ->whereNotNull('id_admin')
            ->with(['santri', 'user'])
            ->get();

        return view('admin.pembayaran.tamrin', [
            'currentSemester' => $currentSemester,
            'tahunAkhirTertinggi' => $tahunAkhirTertinggi,
            'tahunAwalTerendah' => $tahunAwalTerendah,
            'selectedTahunAjaran' => $selectedTahunAjaran,
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
            ->where('jenis_pembayaran', 'tamrin')
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
        $validator = Validator::make($request->all(), [
            'jenis_bayar' => 'required',
            'tahun_ajaran' => 'required',
            'semester_ajaran' => 'required',
            'jumlah_bayar',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // $currentSemester = SemesterHelper::getCurrentSemester();

        $pembayaran = Pembayaran::where('id_santri', $id_santri)
            ->where('semester_ajaran', $request->input('semester_ajaran'))
            ->where('tahun_ajaran', $request->input('tahun_ajaran'))
            ->where('jenis_pembayaran', 'tamrin')
            ->where('jumlah_bayar', 0)
            ->where('status_pembayaran', 'belum_lunas')
            ->first();

        $statusPotonganHarga = $request->input('status_potongan_harga');
        $potonganHarga = $request->input('potongan_harga');

        if ($statusPotonganHarga == "true" && $pembayaran) {
            // Jika status potongan harga true, maka update harga beserta potongan harga
            $pembayaran->jumlah_pembayaran_sebelum_potongan = $pembayaran->jumlah_pembayaran;
            $pembayaran->jumlah_potongan = $potonganHarga;
            $pembayaran->jumlah_pembayaran = $pembayaran->jumlah_pembayaran_sebelum_potongan - $potonganHarga;

            // Mengubah status pembayaran menjadi lunas
            $pembayaran->tanggal_pembayaran = now();
            $pembayaran->id_admin = Auth::user()->id_admin;

            switch ($request->jenis_bayar) {
                case 'lunas':
                    $pembayaran->jumlah_bayar = $pembayaran->jumlah_pembayaran;
                    $pembayaran->status_pembayaran = 'lunas';
                    break;

                default:
                    $pembayaran->jumlah_bayar = $request->jumlah_bayar;
                    $pembayaran->status_pembayaran = 'belum_lunas';

                    cicilanPembayaran::create([
                        'id_admin' => Auth::user()->id_admin,
                        'id_pembayaran' => $pembayaran->id_pembayaran,
                        'sub_bayar_cicilan' => $request->jumlah_bayar,
                        'tanggal_bayar' => now(),
                    ]);
                    break;
            }

            $pembayaran->save();

            return redirect()->route('tamrin')->with('success', 'Data pembayaran berhasil ditambahkan dengan potongan.');
        } elseif ($pembayaran) {
            // Jika tidak ada potongan harga atau potongan tidak diterapkan, proses normal
            $pembayaran->jumlah_bayar = $pembayaran->jumlah_pembayaran;

            // Mengubah status pembayaran menjadi lunas
            $pembayaran->tanggal_pembayaran = now();
            $pembayaran->id_admin = Auth::user()->id_admin;

            switch ($request->jenis_bayar) {
                case 'lunas':
                    $pembayaran->jumlah_bayar = $pembayaran->jumlah_pembayaran;
                    $pembayaran->status_pembayaran = 'lunas';
                    break;

                default:
                    $pembayaran->jumlah_bayar = $request->jumlah_bayar;
                    $pembayaran->status_pembayaran = 'belum_lunas';

                    cicilanPembayaran::create([
                        'id_admin' => Auth::user()->id_admin,
                        'id_pembayaran' => $pembayaran->id_pembayaran,
                        'sub_bayar_cicilan' => $request->jumlah_bayar,
                        'tanggal_bayar' => now(),
                    ]);
                    break;
            }

            $pembayaran->save();

            return redirect()->route('tamrin')->with('success', 'Data pembayaran berhasil ditambahkan.');
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
            ->where('jenis_pembayaran', 'tamrin')
            ->whereNotNull('id_admin')
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

            $data_cicilan = cicilanPembayaran::orderBy('created_at', 'desc')
                ->where('id_pembayaran', $id_pembayaran)
                ->with(['user'])
                ->get();

            if ($data_cicilan->isNotEmpty()) {
                $data_cicilan->each(function ($cicilan) {
                    $cicilan->delete();
                });
            }

            return redirect()->route('tamrin')->with('success', 'Pembayaran berhasil dibatalkan.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Error: Data pembayaran tidak ditemukan atau sudah dibatalkan.']);
        }
    }
    public function show(Request $request, $id_pembayaran)
    {
        $data['title'] = 'Cicilan Semester';

        $currentSemester = SemesterHelper::getCurrentSemester();


        $data_cicilan = cicilanPembayaran::orderBy('created_at', 'desc')
            ->where('id_pembayaran', $id_pembayaran)
            ->with(['user'])
            ->get();

        $pembayarans = Pembayaran::where('id_pembayaran', $id_pembayaran)
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->where('jenis_pembayaran', 'tamrin')
            ->with(['santri', 'user'])
            ->first();

        return view('admin.pembayaran.cicilan.cicilan', [
            'currentSemester' => $pembayarans->semester_ajaran,
            'currentTahun' => Carbon::parse($pembayarans->created_at)->year,
            'pembayarans' => $pembayarans,
            'data_cicilan' => $data_cicilan
        ], $data);
    }
    public function add_cicilan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pembayaran' => 'required',
            'jumlah_bayar' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pembayaran = Pembayaran::where('id_pembayaran', $request->id_pembayaran)->first();

        if (!$pembayaran) {
            return redirect()->back()->withErrors(['error' => 'Pembayaran tidak ditemukan']);
        }

        $total_bayar = $pembayaran->jumlah_bayar + $request->jumlah_bayar;

        if ($total_bayar > $pembayaran->jumlah_pembayaran) {
            $kembalian = $total_bayar - $pembayaran->jumlah_pembayaran;
            $update_bayar = $request->jumlah_bayar - $kembalian;

            cicilanPembayaran::create([
                'id_admin' => Auth::user()->id_admin,
                'id_pembayaran' => $request->id_pembayaran,
                'sub_bayar_cicilan' => $update_bayar,
                'tanggal_bayar' => now(),
            ]);

            $pembayaran->jumlah_bayar = $pembayaran->jumlah_pembayaran;
            $pembayaran->status_pembayaran = 'lunas';
            $pembayaran->save();

            return redirect()->route('tamrin')->with('success', 'Pembayaran semester Lunas, kembalian Rp' . number_format($kembalian, 0, ',', '.'));
        }

        switch (true) {
            case $total_bayar == $pembayaran->jumlah_pembayaran:
                $pembayaran->status_pembayaran = 'lunas';
                $pembayaran->save();

                cicilanPembayaran::create([
                    'id_admin' => Auth::user()->id_admin,
                    'id_pembayaran' => $request->id_pembayaran,
                    'sub_bayar_cicilan' => $request->jumlah_bayar,
                    'tanggal_bayar' => now(),
                ]);

                $pembayaran->jumlah_bayar = $pembayaran->jumlah_pembayaran;
                $pembayaran->status_pembayaran = 'lunas';
                $pembayaran->save();

                return redirect()->route('tamrin')->with('success', 'Pembayaran semester Lunas');

            default:
                cicilanPembayaran::create([
                    'id_admin' => Auth::user()->id_admin,
                    'id_pembayaran' => $request->id_pembayaran,
                    'sub_bayar_cicilan' => $request->jumlah_bayar,
                    'tanggal_bayar' => now(),
                ]);

                $pembayaran->jumlah_bayar = $pembayaran->jumlah_bayar + $request->jumlah_bayar;
                $pembayaran->save();

                return redirect()->route('cicilan_detail', ['id' => $request->id_pembayaran])->with('success', 'Data cicilan berhasil ditambahkan');
        }
    }
    public function delete_cicilan(Request $request, $id_cicilan_pembayarans)
    {
        $validator = Validator::make($request->all(), [
            'id_pembayaran' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pembayaran = Pembayaran::where('id_pembayaran', $request->id_pembayaran)->first();

        if (!$pembayaran) {
            return redirect()->back()->withErrors(['error' => 'Pembayaran tidak ditemukan']);
        }

        $pembayaran_cicilan = cicilanPembayaran::where('id_cicilan_pembayarans', $id_cicilan_pembayarans)->first();

        if (!$pembayaran_cicilan) {
            return redirect()->back()->withErrors(['error' => 'Pembayaran tidak ditemukan']);
        }

        $update_bayar = $pembayaran->jumlah_bayar - $pembayaran_cicilan->sub_bayar_cicilan;

        if ($pembayaran->status_pembayaran == 'lunas') {
            $pembayaran->jumlah_bayar = $update_bayar;
            $pembayaran->status_pembayaran = 'belum_lunas';
            $pembayaran->save();
        }

        $pembayaran->jumlah_bayar = $update_bayar;
        $pembayaran->status_pembayaran = 'belum_lunas';
        $pembayaran->save();

        $pembayaran_cicilan->delete();

        if ($pembayaran->jumlah_bayar == 0) {
            $pembayaran->tanggal_pembayaran = null;
            $pembayaran->id_admin = null;

            if ($pembayaran->jumlah_pembayaran_sebelum_potongan && $pembayaran->jumlah_pembayaran_sebelum_potongan > 0) {
                // Menghapus potongan harga dan mengembalikan harga menjadi semula
                $pembayaran->jumlah_pembayaran = $pembayaran->jumlah_pembayaran_sebelum_potongan;
                $pembayaran->jumlah_pembayaran_sebelum_potongan = 0;
                $pembayaran->jumlah_potongan = 0;
            }

            // Simpan perubahan ke database
            $pembayaran->save();
            return redirect()->route('tamrin', ['id' => $request->id_pembayaran])->with('success', 'Pembayaran cicilan semester dibatalkan');
        }

        return redirect()->route('cicilan_detail', ['id' => $request->id_pembayaran])->with('success', 'Pembayaran cicilan semester dibatalkan');
    }
}