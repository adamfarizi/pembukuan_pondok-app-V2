<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AdminPengeluaranController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Pengeluaran';

        if ($request->ajax()) {
            $data = Pengeluaran::orderBy('tanggal_pengeluaran', 'desc')->get();
            return DataTables::of($data)
                ->make(true);
        }

        $pengeluarans = Pengeluaran::all();

        return view('admin.pengeluaran.pengeluaran', [
            'pengeluarans' => $pengeluarans,
        ], $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'nama_pengeluar' => 'required|string|max:255',
            'jumlah_pengeluaran' => 'required|integer|min:0',
            'deskripsi_pengeluaran' => 'required|string',
            'bukti_pengeluaran' => 'required',
            'jenis_pengeluaran' => 'required|string',
        ]);
        
        $admin_id = Auth::id();

        // Menyimpan bukti_pengeluaran (jika ada)
        $image = $request->file('bukti_pengeluaran');

        // Generate nama file unik
        $imageName = time() . '_' . $image->getClientOriginalName();

        $image->move(public_path('bukti_pengeluaran'), $imageName);

        Pengeluaran::create([
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
            'tanggal_pengeluaran' => now(),
            'deskripsi_pengeluaran' => $request->deskripsi_pengeluaran,
            'nama_pengeluar' => $request->nama_pengeluar,
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'bukti_pengeluaran' => $imageName,
            'id_admin' => $admin_id,
        ]);

        return redirect()->route('pengeluaran')->with('success', 'Pengeluaran created successfully.');
    }

    public function edit(Request $request, $id_pengeluaran)
    {
        $request->validate([
            'nama_pengeluar' => 'required|string|max:255',
            'jumlah_pengeluaran' => 'required|integer|min:0',
            'deskripsi_pengeluaran' => 'required|string',
            'jenis_pengeluaran' => 'required|string',
        ]);

        $pengeluaran = Pengeluaran::where('id_pengeluaran', $id_pengeluaran)->first();

        // Perbarui gambar jika ada
        if ($request->hasFile('bukti_pengeluaran')) {
            if ($pengeluaran->bukti_pengeluaran) {
                unlink(public_path('bukti_pengeluaran/' . $pengeluaran->bukti_pengeluaran));
            }
            $bukti_pengeluaran = $request->file('bukti_pengeluaran');
            $bukti_pengeluaran_name = time() . '_' . $bukti_pengeluaran->getClientOriginalName();
            $bukti_pengeluaran->move(public_path('bukti_pengeluaran'), $bukti_pengeluaran_name);
            $pengeluaran->bukti_pengeluaran = $bukti_pengeluaran_name;
        }

        if ($pengeluaran) {
            $pengeluaran->nama_pengeluar = $request->input('nama_pengeluar');
            $pengeluaran->jumlah_pengeluaran = $request->input('jumlah_pengeluaran');
            $pengeluaran->deskripsi_pengeluaran = $request->input('deskripsi_pengeluaran');
            $pengeluaran->jenis_pengeluaran = $request->input('jenis_pengeluaran');
            $pengeluaran->save();

            return redirect()->route('pengeluaran')->with('success', 'Data pengeluaran berhasil diubah.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Error: Data tidak ditemukan']);
        }
    }

    public function delete($id_pengeluaran)
    {
        try {
            // Hapus pengeluaran
            $pengeluaran = Pengeluaran::where('id_pengeluaran', $id_pengeluaran)->first();
            if (!$pengeluaran) {
                throw new \Exception('Pengeluaran tidak ditemukan.');
            }

            if ($pengeluaran->bukti_pengeluaran) {
                unlink(public_path('bukti_pengeluaran/' . $pengeluaran->bukti_pengeluaran));
            }
            
            $pengeluaran->delete();

            return redirect()->back()->with('success', 'Pengeluaran berhasil dihapus.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
}
