<?php

namespace App\Http\Controllers\Admin;

use App\Models\PointSantri;
use App\Models\Santri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\SemesterHelper;

class AdminPointPelanggaranController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Point Pelanggaran';

        if ($request->ajax()) {
            $data = Santri::orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->make(true);
        }
        return view('admin.penilaian_santri.point_pelanggaran', [

        ], $data);
    }

    public function index_point($id_santri)
    {
        $data['title'] = 'Point Pelanggaran';

        $santri = Santri::where('id_santri', $id_santri)->first();

        $currentSemester = SemesterHelper::getCurrentSemester();

        $point_santris = PointSantri::where('id_santri', $id_santri)
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->orderBy('tanggal_point_santri', 'desc')
            ->get();

        return view('admin.penilaian_santri.info.info_point_pelanggaran', [
            'santri' => $santri,
            'point_santris' => $point_santris,
            'currentSemester' => $currentSemester,
        ], $data);
    }

    public function create(Request $request, $id_santri)
    {
        // Validasi input
        $validatedData = $request->validate([
            'tanggal_point_santri' => 'required|date',
            'jenis_point_santri' => 'required|in:A,B,C,D,E',
            'jumlah_point_santri' => 'required|integer|min:1',
            'deskripsi_point_santri' => 'required|string|max:255',
        ]);

        $currentSemester = SemesterHelper::getCurrentSemester();

        // Buat instance baru dari PointSantri
        $pointSantri = new PointSantri();

        // Isi data
        $pointSantri->id_santri = $id_santri;
        $pointSantri->tanggal_point_santri = $validatedData['tanggal_point_santri'];
        $pointSantri->semester_ajaran = $currentSemester['semester'];
        $pointSantri->tahun_ajaran = $currentSemester['tahun'];
        $pointSantri->jenis_point_santri = $validatedData['jenis_point_santri'];
        $pointSantri->jumlah_point_santri = $validatedData['jumlah_point_santri'];
        $pointSantri->deskripsi_point_santri = $validatedData['deskripsi_point_santri'];

        // Simpan ke database
        $pointSantri->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Point pelanggaran berhasil ditambahkan.');
    }

    public function edit(Request $request, $id_point_santri)
    {
        // Validasi input
        $validatedData = $request->validate([
            'tanggal_point_santri' => 'required|date',
            'jenis_point_santri' => 'required|in:A,B,C,D,E',
            'jumlah_point_santri' => 'required|integer|min:1',
            'deskripsi_point_santri' => 'required|string|max:255',
        ]);

        // Cari record point santri
        $pointSantri = PointSantri::where('id_point_santri', $id_point_santri)->first();

        // Update data
        $pointSantri->tanggal_point_santri = $validatedData['tanggal_point_santri'];
        $pointSantri->jenis_point_santri = $validatedData['jenis_point_santri'];
        $pointSantri->jumlah_point_santri = $validatedData['jumlah_point_santri'];
        $pointSantri->deskripsi_point_santri = $validatedData['deskripsi_point_santri'];

        // Simpan perubahan
        $pointSantri->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Point pelanggaran berhasil diperbarui.');
    }

    public function delete($id_point_santri)
    {
        try {
            $pointSantri = PointSantri::findOrFail($id_point_santri);
            $pointSantri->delete();

            return redirect()->back()->with('success', 'Point pelanggaran berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus point pelanggaran.');
        }
    }
}

