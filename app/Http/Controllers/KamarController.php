<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KamarController extends Controller
{

    public function removePhoto(Request $request, $id_kamar)
    {
        $kamar = Kamar::findOrFail($id_kamar);

        if ($request->removePhoto) {
            if ($kamar->foto_kamar) {
                // Hapus foto dari disk
                Storage::delete('public/uploads/kamar/' . $kamar->foto_kamar);

                // Set foto kamar menjadi null di database
                $kamar->foto_kamar = null;
                $kamar->save();
            }
        }

        return response()->json(['success' => true]);
    }

    private function getLayoutBasedOnRole()
    {
        $role = Auth::user()->role; // Ambil role dari pengguna yang sedang login

        // Tentukan layout berdasarkan role
        switch ($role) {
            case 'Superadmin':
                return 'web.role.superadmin.layouts.app';
            case 'Owner':
                return 'web.role.owner.layouts.app';
            case 'Resepsionis':
                return 'web.role.resepsionis.layouts.app';
            case 'Staff':
                return 'web.role.staff.layouts.app';
            default:
                return 'web.default.layouts.app'; // Layout default jika role tidak sesuai
        }
    }


    public function index()
    {
        $kamar = Kamar::with('fasilitas')->get(); // Ambil semua data kamar dengan fasilitas

        // Dapatkan layout berdasarkan role
        $layout = $this->getLayoutBasedOnRole();

        // Kirim data $kamar ke view dengan layout yang sesuai
        return view('web.kamar.daftar_kamar', compact('kamar', 'layout'));
    }

    public function create()
    {
        // Dapatkan layout berdasarkan role
        $layout = $this->getLayoutBasedOnRole();

        // Ambil semua fasilitas untuk checkbox
        $fasilitas = Fasilitas::all();
        return view('web.kamar.tambah_kamar', compact('fasilitas', 'layout'));
    }

    public function store(Request $request)
    {
        // Validasi input termasuk validasi untuk foto
        $request->validate([
            'nomor_kamar' => 'required|max:50',
            'tipe_kamar' => 'required|max:50',
            'harga_kamar' => 'required|numeric',
            'status_kamar' => 'required|in:Tersedia,Booked',
            'kapasitas_kamar' => 'required|integer',
            'id_fasilitas' => 'required|array',
            'foto_kamar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);
    
        // Proses unggah foto jika ada file yang diunggah
        if ($request->hasFile('foto_kamar')) {
            $image = $request->file('foto_kamar');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Generate nama file unik
            $image->move(public_path('uploads/kamar'), $imageName); // Simpan ke folder 'uploads/kamar'
        } else {
            $imageName = null; // Jika tidak ada foto yang diunggah
        }
    
        // Simpan data kamar ke database
        $kamar = Kamar::create([
            'nomor_kamar' => $request->nomor_kamar,
            'tipe_kamar' => $request->tipe_kamar,
            'harga_kamar' => $request->harga_kamar,
            'status_kamar' => $request->status_kamar,
            'kapasitas_kamar' => $request->kapasitas_kamar,
            'foto_kamar' => $imageName, // Menyimpan nama file foto ke database
        ]);
    
        // Simpan relasi dengan fasilitas ke tabel pivot
        $kamar->fasilitas()->attach($request->id_fasilitas);
    
        // Redirect ke halaman daftar kamar dengan pesan sukses
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan');
    }

    
    public function edit($id)
    {
        // Dapatkan layout berdasarkan role
        $layout = $this->getLayoutBasedOnRole();

        // Ambil data kamar dan fasilitas untuk edit
        $kamar = Kamar::with('fasilitas')->find($id);
        $fasilitas = Fasilitas::all();
        return view('web.kamar.edit_kamar', compact('kamar', 'fasilitas', 'layout'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nomor_kamar' => 'required|string|max:255',
            'tipe_kamar' => 'required|string|max:255',
            'harga_kamar' => 'required|numeric',
            'status_kamar' => 'required|string',
            'kapasitas_kamar' => 'required|integer',
            'foto_kamar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048', // ukuran max 2MB
            'fasilitas_kamar' => 'nullable|array',
        ]);
    
        // Ambil data kamar yang akan diupdate
        $kamar = Kamar::findOrFail($id);
    
        // Logika untuk menghapus foto lama jika ada permintaan hapus atau ada file baru
        if ($request->input('hapus_foto') === 'true' || $request->hasFile('foto_kamar')) {
            // Hapus foto lama dari folder
            if ($kamar->foto_kamar && file_exists(public_path('uploads/kamar/' . $kamar->foto_kamar))) {
                unlink(public_path('uploads/kamar/' . $kamar->foto_kamar));
            }
            $kamar->foto_kamar = null;
        }
    
        // Jika ada file foto baru, proses upload
        if ($request->hasFile('foto_kamar')) {
            $image = $request->file('foto_kamar');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads/kamar'), $imageName);
            $kamar->foto_kamar = $imageName;
        }
    
        // Update data kamar lainnya
        $kamar->nomor_kamar = $request->input('nomor_kamar');
        $kamar->tipe_kamar = $request->input('tipe_kamar');
        $kamar->harga_kamar = $request->input('harga_kamar');
        $kamar->status_kamar = $request->input('status_kamar');
        $kamar->kapasitas_kamar = $request->input('kapasitas_kamar');
    
        // Simpan perubahan
        $kamar->save();
    
        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil diupdate');
    }
    
     
    

    public function destroy($id)
    {
        // Hapus data kamar
        Kamar::find($id)->delete();
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus');
    }
}
