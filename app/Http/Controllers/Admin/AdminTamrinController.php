<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Helpers\SemesterHelper;
use App\Http\Controllers\Controller;
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

        if ($request->ajax()) {
            $data = Pembayaran::orderBy('created_at', 'desc')
                ->where('semester_ajaran', $currentSemester['semester'])
                ->where('tahun_ajaran', $currentSemester['tahun'])
                ->where('jenis_pembayaran', 'tamrin')
                // ->where('status_pembayaran', 'lunas')
                ->where('jumlah_bayar', '!=', 0)
                ->with(['santri', 'user'])
                ->get();
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

        return view('admin.pembayaran.tamrin', [
            'currentSemester' => $currentSemester,
            'pembayarans' => $pembayarans,
        ], $data);
    }

    public function edit(Request $request, $id_santri)
    {
        $validator = Validator::make($request->all(), [
            'jenis_bayar' => 'required',
            'jumlah_bayar',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $currentSemester = SemesterHelper::getCurrentSemester();
        $pembayaran = Pembayaran::where('id_santri', $id_santri)
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->where('jenis_pembayaran', 'tamrin')
            ->where('jumlah_bayar', 0)
            ->where('status_pembayaran', 'belum_lunas')
            ->first();

        if ($pembayaran) {
            $pembayaran->tanggal_pembayaran = now();
            $pembayaran->id_admin = Auth::user()->id_admin;

            // if ($request->jenis_bayar == "lunas") {
            //     $pembayaran->jumlah_bayar = $pembayaran->jumlah_pembayaran;
            //     $pembayaran->status_pembayaran = 'lunas';
            // } else {
            //     $pembayaran->jumlah_bayar = $request->jumlah_bayar;
            //     $pembayaran->status_pembayaran = 'belum_lunas';
            // }

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
            'currentSemester' => $currentSemester,
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
            return redirect()->route('tamrin', ['id' => $request->id_pembayaran])->with('success', 'Pembayaran cicilan semester dibatalkan');
        }

        return redirect()->route('cicilan_detail', ['id' => $request->id_pembayaran])->with('success', 'Pembayaran cicilan semester dibatalkan');
    }
}