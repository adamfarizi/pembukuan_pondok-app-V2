<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\MasterGuest;
use App\Models\MasterGuestFoto;
use App\Models\MasterGuestMisi;

class AdminGuestMasterController extends Controller
{
    public function index()
    {
        $data['title'] = 'Master Guest';

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
        $guests = MasterGuest::with(['foto', 'misi'])->findOrFail($id_guest);

        return view('admin.master.master_guest', [
            'guests' => $guests,
            'title' => 'Edit Guest'
        ]);
    }

    public function update(Request $request, $id_guest)
    {
        $request->validate([
            'visi' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'no_tlp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        $guests = MasterGuest::findOrFail($id_guest);
        $guests->visi = $request->visi;
        $guests->lokasi = $request->lokasi;
        $guests->no_tlp = $request->no_tlp;
        $guests->email = $request->email;
        $guests->save();

        if ($request->has('misi')) {
            foreach ($request->misi as $misi) {
                $existingMisi = MasterGuestMisi::where('id_guest', $id_guest)
                    ->where('misi', $misi)
                    ->first();

                if (!$existingMisi) {
                    MasterGuestMisi::create([
                        'id_guest' => $id_guest,
                        'misi' => $misi
                    ]);
                }
            }
        }

        if ($request->hasFile('foto')) {
            foreach ($request->foto as $fotos) {
                // Ambil nama asli file
                $originalName = $fotos->getClientOriginalName();
        
                // Tentukan path untuk menyimpan file langsung ke public/gambar_pondok
                $path = public_path('gambar_pondok'); 
        
                // Pindahkan file ke folder tujuan
                $fotos->move($path, $originalName);
        
                // Simpan informasi file ke database
                MasterGuestFoto::create([
                    'id_guest' => $id_guest,
                    'foto' => $originalName
                ]);
            }
        }

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

    public function delete_foto($id_foto)
    {
        $foto = MasterGuestFoto::where('id_foto', $id_foto)->first();

        if ($foto) {
            if (Storage::disk('public')->exists($foto->foto)) {
                Storage::disk('public')->delete($foto->foto);
            }

            $foto->delete();

            return redirect()->back()->with('success', 'Foto berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Foto tidak ditemukan.');
    }
}
