<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\MasterGuest;
use App\Models\MasterGuestFoto;
use App\Models\MasterGuestMisi;
use App\Models\MasterGuestRekening;

class AdminGuestMasterController extends Controller
{
    public function index()
    {
        $data['title'] = 'Master Guest';

        $guests = MasterGuest::with(['foto', 'misi', 'rekening'])->get();

        if (auth()->check()) {
            return view('admin.master.master_guest', [
                'guests' => $guests,
                'title' => $data['title']
            ]);
        }
    }

    public function edit($id_guest)
    {
        $guests = MasterGuest::with(['foto', 'misi', 'rekening'])->findOrFail($id_guest);

        return view('admin.master.master_guest', [
            'guests' => $guests,
            'title' => 'Edit Guest'
        ]);
    }

    public function update(Request $request, $id_guest)
    {
        // Validation rules
        $request->validate([
            'visi' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'no_tlp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        // Find the guest by ID
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

        if ($request->has('rekening')) {
            foreach ($request->rekening as $rekening) {
                $existingRekening = MasterGuestRekening::where('id_guest', $id_guest)
                    ->where('rekening', $rekening)
                    ->first();

                if (!$existingRekening) {
                    MasterGuestRekening::create([
                        'id_guest' => $id_guest,
                        'rekening' => $rekening
                    ]);
                }
            }
        }

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $fotos) {
                $originalName = $fotos->getClientOriginalName();
                $path = public_path('gambar_pondok');
                $fotos->move($path, $originalName);

                MasterGuestFoto::create([
                    'id_guest' => $id_guest,
                    'foto' => $originalName
                ]);
            }
        }

        // Redirect with success message
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

    public function delete_rekening($id_rekening)
    {
        $rekening = MasterGuestRekening::where('id_rekening', $id_rekening)->first();

        if ($rekening) {
            $rekening->delete();
            return redirect()->back()->with('success', 'Rekening berhasil dihapus.');
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
