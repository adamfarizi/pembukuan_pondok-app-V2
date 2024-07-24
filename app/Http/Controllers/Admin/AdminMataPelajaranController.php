<?php

namespace App\Http\Controllers\Admin;

use App\Mail\NilaiNotification;
use App\Models\Santri;
use App\Models\WaliSantri;
use App\Models\NilaiSantri;
use Illuminate\Http\Request;
use App\Helpers\SemesterHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class AdminMataPelajaranController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Mata Pelajaran';


        if ($request->ajax()) {
            $data = Santri::orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->make(true);
        }

        return view('admin.penilaian_santri.mata_pelajaran', [

        ], $data);
    }

    public function index_nilai($id_santri)
    {
        $data['title'] = 'Mata Pelajaran';

        $currentSemester = SemesterHelper::getCurrentSemester();

        $santri = Santri::where('id_santri', $id_santri)->first();

        // Mengambil nilai santri
        $nilaiSantri = NilaiSantri::where('id_santri', $id_santri)
            ->with('santri')
            ->orderBy('tahun_ajaran', 'asc')
            ->get();
        // Mengurutkan semester genap dulu, kemudian ganjil
        $sortedNilaiSantri = $nilaiSantri->sortBy(function ($item) {
            return [
                $item->tahun_ajaran, // urutkan berdasarkan tahun ajaran dahulu
                $item->semester_ajaran == 'genap' ? 0 : 1, // urutkan semester genap dulu, lalu ganjil
            ];
        });
        // Kelompokkan berdasarkan tahun ajaran dan semester
        $groupedNilaiSantri = $sortedNilaiSantri->groupBy(function ($item) {
            return $item->tahun_ajaran . '-' . $item->semester_ajaran;
        });

        // Rata-rata
        $averageNilai = NilaiSantri::where('id_santri', $id_santri)
            ->where('semester_ajaran', $currentSemester['semester'])
            ->where('tahun_ajaran', $currentSemester['tahun'])
            ->pluck('nilai')
            ->avg();

        return view('admin.penilaian_santri.info.info_mata_pelajaran', [
            'currentSemester' => $currentSemester,
            'santri' => $santri,
            'groupedNilaiSantri' => $groupedNilaiSantri,
            'averageNilai' => $averageNilai,
        ], $data);
    }

    public function create(Request $request, $id_santri)
    {
        // Validasi request
        $request->validate([
            'semester_ajaran' => 'required|string',
            'tahun_ajaran' => 'required|string',
            'al_quran_tajwid' => 'required|integer',
            'bahasa_arab' => 'required|integer',
            'fiqh' => 'required|integer',
            'hadist' => 'required|integer',
            'aqidah' => 'required|integer',
            'sirah_nabawiyyah' => 'required|integer',
            'tazkiyatun_nafs' => 'required|integer',
            'tarikh' => 'required|integer',
        ]);

        // Cek apakah sudah ada data nilai santri untuk semester dan tahun ajaran yang sama
        $exists = NilaiSantri::where('id_santri', $id_santri)
            ->where('semester_ajaran', $request->semester_ajaran)
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['message' => 'Data nilai santri untuk semester dan tahun ajaran tersebut sudah ada.'])->withInput();
        }

        // Simpan data ke dalam database untuk setiap mata pelajaran
        foreach (['al_quran_tajwid', 'bahasa_arab', 'fiqh', 'hadist', 'aqidah', 'sirah_nabawiyyah', 'tazkiyatun_nafs', 'tarikh'] as $mapel) {
            $nilaiSantri = new NilaiSantri();
            $nilaiSantri->id_santri = $id_santri;
            $nilaiSantri->semester_ajaran = $request->semester_ajaran;
            $nilaiSantri->tahun_ajaran = $request->tahun_ajaran;
            $nilaiSantri->mata_pelajaran = $mapel;
            $nilaiSantri->nilai = $request->$mapel; // Menggunakan variabel dinamis untuk nilai berdasarkan mata pelajaran
            $nilaiSantri->save();
        }

        // Kirim email ke wali santri
        $santri = Santri::where('id_santri', $id_santri)->first();
        $nama_santri = $santri->nama_santri;
        $waliSantri = WaliSantri::where('id_santri', $id_santri)->first();
        if ($waliSantri) {
            Mail::to($waliSantri->email)->send(new NilaiNotification($nama_santri, $waliSantri));
        }        

        // Redirect atau response sesuai kebutuhan
        return redirect()->back()->with('success', 'Data nilai santri berhasil disimpan.');
    }

    public function edit(Request $request, $id_santri)
    {
        // Validasi request
        $request->validate([
            'semester_ajaran' => 'required|string',
            'tahun_ajaran' => 'required|string',
            'al_quran_tajwid' => 'required|integer',
            'bahasa_arab' => 'required|integer',
            'fiqh' => 'required|integer',
            'hadist' => 'required|integer',
            'aqidah' => 'required|integer',
            'sirah_nabawiyyah' => 'required|integer',
            'tazkiyatun_nafs' => 'required|integer',
            'tarikh' => 'required|integer',
        ]);

        // Simpan data ke dalam database untuk setiap mata pelajaran
        foreach (['al_quran_tajwid', 'bahasa_arab', 'fiqh', 'hadist', 'aqidah', 'sirah_nabawiyyah', 'tazkiyatun_nafs', 'tarikh'] as $mapel) {
            // Cari nilai santri berdasarkan mata pelajaran, semester, dan tahun ajaran
            $nilaiSantri = NilaiSantri::where('id_santri', $id_santri)
                ->where('semester_ajaran', $request->semester_ajaran)
                ->where('tahun_ajaran', $request->tahun_ajaran)
                ->where('mata_pelajaran', $mapel)
                ->first();

            if ($nilaiSantri) {
                // Jika data ada, perbarui nilai
                $nilaiSantri->nilai = $request->$mapel;
                $nilaiSantri->save();
            } else {
                // Jika data tidak ada, buat data baru
                NilaiSantri::create([
                    'id_santri' => $id_santri,
                    'semester_ajaran' => $request->semester_ajaran,
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'mata_pelajaran' => $mapel,
                    'nilai' => $request->$mapel,
                ]);
            }
        }

        // Redirect atau response sesuai kebutuhan
        return redirect()->back()->with('success', 'Data nilai santri berhasil diubah.');
    }

    public function delete(Request $request,$id_santri)
    {   
        $request->validate([
            'semester_ajaran' => 'required',
            'tahun_ajaran' => 'required',
        ]);
        
        // Cari nilai santri berdasarkan mata pelajaran, semester, dan tahun ajaran
        $nilaiSantri = NilaiSantri::where('id_santri', $id_santri)
            ->where('semester_ajaran', $request->semester_ajaran)
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->delete();

        // Redirect atau response sesuai kebutuhan
        return redirect()->back()->with('success', 'Data nilai santri berhasil dihapus.');
    }
}
