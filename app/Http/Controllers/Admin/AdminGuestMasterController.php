<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterGuest;
use App\Models\MasterGuestFoto;
use App\Models\MasterGuestMisi;

class AdminGuestMasterController extends Controller
{
    public function index()
    {
        $data['title'] = 'Master Guest';

        // Ambil semua data tamu beserta foto dan misinya
        $guests = MasterGuest::with(['foto', 'misi'])->get();

        if (auth()->check()) {
            return view('admin.master.master_guest', [
                'guests' => $guests,
                'title' => $data['title']
            ]);
        }
    }

    public function edit($id_guest)
    {
        // Ambil data tamu berdasarkan id_guest beserta relasi foto dan misi
        $guests = MasterGuest::with(['foto', 'misi'])->findOrFail($id_guest);

        // Return view untuk halaman edit dengan data tamu, foto, dan misi
        return view('admin.master.master_guest', [
            'guests' => $guests,
            'title' => 'Edit Guest'
        ]);
    }

    public function update(Request $request, $id_guest)
    {
        // Validasi data input
        $request->validate([
            'visi' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'no_tlp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Update data utama
        $guests = MasterGuest::findOrFail($id_guest);
        $guests->visi = $request->visi;
        $guests->lokasi = $request->lokasi;
        $guests->no_tlp = $request->no_tlp;
        $guests->email = $request->email;
        $guests->save();

        // Update data misi (jika ada)
        if ($request->has('misi')) {
            foreach ($request->misi as $misi) {
                // Periksa apakah misi sudah ada
                $existingMisi = MasterGuestMisi::where('id_guest', $id_guest)
                    ->where('misi', $misi)
                    ->first();

                // Jika misi belum ada, tambahkan
                if (!$existingMisi) {
                    MasterGuestMisi::create([
                        'id_guest' => $id_guest,
                        'misi' => $misi
                    ]);
                }
            }
        }

        // Update data foto (jika ada)
        if ($request->hasFile('foto')) {
            foreach ($request->foto as $foto) {
                // Simpan file ke folder 'gambar_pondok'
                $path = $foto->store('gambar_pondok', 'public');

                // Simpan path file ke database
                MasterGuestFoto::create([
                    'id_guest' => $id_guest,
                    'foto' => $path
                ]);
            }
        }

        // Return view dengan data yang sudah diupdate
        return redirect()->route('master_guest')->with('success', 'Data berhasil diupdate');
    }

    public function delete_misi($id_misi)
    {
        $misi = MasterGuestMisi::where('id_misi', $id_misi)->first();

        if ($misi) {
            $misi->delete();
            return redirect()->back()->with('success', 'Misi berhasil dihapus.');
        }
    }
}
