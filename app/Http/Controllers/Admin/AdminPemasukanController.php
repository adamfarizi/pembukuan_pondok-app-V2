<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pemasukan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class AdminPemasukanController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Pemasukan';

        if ($request->ajax()) {
            $data = Pemasukan::with(['user'])->orderBy('tanggal_pemasukan', 'desc')->get();
            return DataTables::of($data)
                ->make(true);
        }

        $pemasukans = Pemasukan::with(['user'])->orderBy('tanggal_pemasukan', 'desc')->get();

        return view('admin.pemasukan.pemasukan', [
            'pemasukans' => $pemasukans,
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

        // Mengambil ID admin yang sedang login
        $id_admin = Auth::user()->id_admin;

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

        Pemasukan::create([
            'jumlah_pemasukan' => $request->jumlah_pemasukan,
            'tanggal_pemasukan' => now(),
            'deskripsi_pemasukan' => $request->deskripsi_pemasukan,
            'id_admin' => $id_admin,
            'nama_pengirim' => $request->nama_pengirim,
            'bukti_pemasukan' => $imageName,
        ]);

        return redirect()->route('pemasukan')->with('success', 'Pemasukan berhasil ditambahkan.');
    }

    public function edit(Request $request, $id_pemasukan)
    {
        $request->validate([
            'jumlah_pemasukan' => 'required|integer',
            'deskripsi_pemasukan' => 'required|string|max:255',
            'bukti_pemasukan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
            'nama_pengirim' => 'nullable|string|max:255', // Validasi untuk nama pengirim
        ]);

        $pemasukan = Pemasukan::find($id_pemasukan);

        if ($pemasukan) {
            // Hapus bukti pemasukan lama jika ada bukti pemasukan baru yang diunggah
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

                // Pindahkan file baru ke direktori public/bukti_pemasukan
                $image->move(public_path('bukti_pemasukan'), $imageName);

                // Hapus bukti pemasukan lama dari storage jika ada
                if ($pemasukan->bukti_pemasukan) {
                    unlink(public_path('bukti_pemasukan/' . $pemasukan->bukti_pemasukan));
                }

                // Simpan nama file bukti pemasukan baru
                $pemasukan->bukti_pemasukan = $imageName;
            }

            // Update data pemasukan lainnya
            $pemasukan->jumlah_pemasukan = $request->input('jumlah_pemasukan');
            $pemasukan->deskripsi_pemasukan = $request->input('deskripsi_pemasukan');
            $pemasukan->nama_pengirim = $request->input('nama_pengirim');
            $pemasukan->save();

            return redirect()->route('pemasukan')->with('success', 'Data pemasukan berhasil diubah.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Error: Data tidak ditemukan']);
        }
    }

    public function delete(Request $request, $id_pemasukan)
    {
        try {
            // Hapus Pemasukan
            $pemasukan = Pemasukan::where('id_pemasukan', $id_pemasukan)->first();
            if (!$pemasukan) {
                throw new \Exception('Pemasukan tidak ditemukan.');
            }
            // Hapus bukti pemasukan lama dari storage jika ada
            if ($pemasukan->bukti_pemasukan) {
                unlink(public_path('bukti_pemasukan/' . $pemasukan->bukti_pemasukan));
            }
            $pemasukan->delete();

            return redirect()->back()->with('success', 'Pemasukan berhasil dihapus.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
}
