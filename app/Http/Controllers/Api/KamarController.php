<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class KamarController extends Controller
{
    public function index()
    {
        return Kamar::all();
    }

    public function show($id)
    {
        return Kamar::findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required|integer',
            'foto_kamar' => 'nullable|image',
            'tipe_kamar' => 'required|string',
            'status_kamar' => 'required|string',
            'kapasitas_kamar' => 'required|integer',
            'harga_kamar' => 'required|numeric',
            'fasilitas_kamar' => 'nullable|string',
        ]);

        if ($request->hasFile('foto_kamar')) {
            $path = $request->file('foto_kamar')->store('images');
            $request->merge(['foto_kamar' => $path]);
        }

        return Kamar::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);
        
        // Validasi input
        $request->validate([
            'nomor_kamar' => 'sometimes|required|integer',
            'foto_kamar' => 'nullable|image',
            'tipe_kamar' => 'sometimes|required|string',
            'status_kamar' => 'sometimes|required|string',
            'kapasitas_kamar' => 'sometimes|required|integer',
            'harga_kamar' => 'sometimes|required|numeric',
            'fasilitas_kamar' => 'nullable|string',
        ]);
        
        // Menghapus foto lama jika ada dan foto baru dikirim
        if ($request->hasFile('foto_kamar')) {
            if ($kamar->foto_kamar && Storage::exists($kamar->foto_kamar)) {
                Storage::delete($kamar->foto_kamar);
            }
            $path = $request->file('foto_kamar')->store('images');
            $kamar->foto_kamar = $path;
        } elseif ($request->input('foto_kamar') === null) {
            // Jika foto_kamar adalah null, hapus file lama jika ada
            if ($kamar->foto_kamar && Storage::exists($kamar->foto_kamar)) {
                Storage::delete($kamar->foto_kamar);
                $kamar->foto_kamar = null;
            }
        }
        
        // Update field lain
        $kamar->nomor_kamar = $request->input('nomor_kamar', $kamar->nomor_kamar);
        $kamar->tipe_kamar = $request->input('tipe_kamar', $kamar->tipe_kamar);
        $kamar->status_kamar = $request->input('status_kamar', $kamar->status_kamar);
        $kamar->kapasitas_kamar = $request->input('kapasitas_kamar', $kamar->kapasitas_kamar);
        $kamar->harga_kamar = $request->input('harga_kamar', $kamar->harga_kamar);
        $kamar->fasilitas_kamar = $request->input('fasilitas_kamar', $kamar->fasilitas_kamar);
        
        $kamar->save();
        
        return response()->json($kamar, 200);
    }
    
    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
    
        // Periksa apakah foto_kamar ada dan file-nya ada di penyimpanan
        if ($kamar->foto_kamar && Storage::exists($kamar->foto_kamar)) {
            Storage::delete($kamar->foto_kamar);
        }
    
        // Hapus data kamar
        $kamar->delete();
    
        return response()->json([
            'message' => 'Data kamar berhasil dihapus'
        ], 200);
    }
    
}
