<?php

namespace App\Http\Controllers\Guest;

use App\Models\Pemasukan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GuestDonasiController extends Controller
{
    public function index()
    {
        $data['title'] = 'Donasi';

        return view('guest.donasi.donasi', [
        ], $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'jumlah_pemasukan' => 'required|integer',
            'deskripsi_pemasukan' => 'required|string|max:255',
            'bukti_pemasukan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
            'nama_pengirim' => 'nullable|string|max:255', // Validasi untuk nama pengirim
        ]);

        // Menyimpan bukti_pemasukan (jika ada)
        if ($request->hasFile('bukti_pemasukan')) {
            $image = $request->file('bukti_pemasukan');

            // Validasi apakah file adalah gambar
            if (!$image->isValid()) {
                return redirect()->back()->withErrors(['error' => 'The bukti pemasukan must be an image.']);
            }

            // Mengambil ekstensi file
            $extension = $image->getClientOriginalExtension();

            // Validasi tipe file
            if (!in_array(strtolower($extension), ['jpeg', 'png', 'jpg', 'gif'])) {
                return redirect()->back()->withErrors(['error' => 'The bukti pemasukan must be a file of type: jpeg, png, jpg, gif.']);
            }

            // Generate nama file unik
            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->move(public_path('bukti_pemasukan'), $imageName);
        } else {
            $imageName = null;
        }

        $pemasukan = Pemasukan::create([
            'jumlah_pemasukan' => $request->jumlah_pemasukan,
            'tanggal_pemasukan' => now(),
            'deskripsi_pemasukan' => $request->deskripsi_pemasukan,
            'id_admin' => null,
            'nama_pengirim' => $request->nama_pengirim,
            'bukti_pemasukan' => $imageName,
        ]);

        return redirect()->route('guest.donasi.finish', ['id' => $pemasukan->id_pemasukan]);
    }

    public function index_finish($id_pemasukan)
    {
        $data['title'] = 'Donasi';

        $pemasukan = Pemasukan::findOrFail($id_pemasukan);

        return view('guest.donasi.finish.donasi_finish', [
            'pemasukan' => $pemasukan,
        ], $data);
    }
}
