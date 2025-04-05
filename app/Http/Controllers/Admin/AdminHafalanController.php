<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Surah;
use App\Models\Santri;
use App\Models\Hafalan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AdminHafalanController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Hafalan';

        if ($request->ajax()) {
            // Akses Santri
            $akses = Auth::user()->akses_santri;
            $data = Santri::orderBy('created_at', 'desc');
            if ($akses === "putra") {
                $data->where('jenis_kelamin_santri', 'laki-laki');
            } elseif ($akses === "putri") {
                $data->where('jenis_kelamin_santri', 'perempuan');
            }
            $data = $data->get();
            
            return DataTables::of($data)
                ->make(true);
        }

        $key_surahs = Surah::getValues();
        $nama_surahs = Surah::getKeys();
        $total_ayats = Surah::$totalAyat;

        return view('admin.penilaian_santri.hafalan', [

        ], $data);
    }

    public function index_hafalan($id_santri)
    {
        $data['title'] = 'Hafalan';

        $santri = Santri::where('id_santri', $id_santri)->first();

        // Akses Santri
        $akses = Auth::user()->akses_santri;
        if (
            ($akses == 'putra' && $santri->jenis_kelamin_santri != 'laki-laki') ||
            ($akses == 'putri' && $santri->jenis_kelamin_santri != 'perempuan')
        ) {
            return redirect()->back()->withErrors(['error' => 'Akses dibatasi!']);
        }

        $hafalans = Hafalan::where('id_santri', $id_santri)
            ->orderBy('surah', 'asc')
            ->get();
        
        return view('admin.penilaian_santri.info.info_hafalan', [
            'santri' => $santri,
            'hafalans' => $hafalans,
        ], $data);
    }

    public function edit(Request $request, $id_hafalan)
    {
        $request->validate([
            'progress_ayat' => 'required|integer|min:0|max:' . Surah::$totalAyat[$request->surah],
        ]);

        $hafalan = Hafalan::where('id_hafalan', $id_hafalan)
            ->where('id_santri', $request->input('id_santri'))
            ->first();
        if ($hafalan->total_ayat == $request->input('progress_ayat')) {
            $hafalan->progress_ayat = $request->input('progress_ayat');
            $hafalan->status = "hafal";
            $hafalan->save();
        } else {
            $hafalan->progress_ayat = $request->input('progress_ayat');
            $hafalan->status = "proses";
            $hafalan->save();
        }

        return redirect()->back()->with('success', 'Hafalan updated successfully.');
    }
}
