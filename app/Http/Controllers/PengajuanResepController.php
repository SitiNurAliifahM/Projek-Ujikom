<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanResepController extends Controller
{
    public function index()
    {
        $resep = Resep::where('status', 'pending')->get(); // Ambil hanya yang pending
        return view('admin.pengajuanResep.index', compact('resep'));
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama_resep' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategoris,id',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

// Buat instance baru dari model Resep
        $resep = new Resep();
        $resep->nama_resep = $request->nama_resep;
        $resep->id_kategori = $request->id_kategori;
        $resep->deskripsi = $request->deskripsi;

// Simpan ID user yang sedang login
        $resep->id_user = auth()->user()->id;

// Set status awal menjadi pending
        $resep->status = auth()->user()->role == 1 ? 'approve' : 'pending';

// Proses upload gambar (jika ada)
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $name = rand(1000, 9999) . $gambar->getClientOriginalName();
            $gambar->move(public_path('gambars/resep'), $name);
            $resep->gambar = $name;
        }

// Simpan data ke database
        $resep->save();

// Tampilkan notifikasi sukses
        Alert::success('Success', 'Resep berhasil diajukan dan menunggu persetujuan')->autoClose(5000);

        return redirect()->back()->with('success', 'Resep berhasil diajukan dan menunggu persetujuan admin.');
    }

    public function approve($id)
    {
        $resep = Resep::findOrFail($id);
        $resep->status = 'approve';
        $resep->save();

        Alert::success('Succes', 'Pengajuan cuti berhasil disetujui !')->autoClose(1500);
        return redirect()->back();
    }

    public function reject($id)
    {
        $resep = Resep::findOrFail($id);
        $resep->status = 'rejected';
        $resep->save();

        Alert::error('Error', 'Pengajuan cuti tidak disetujui !')->autoClose(1500);
        return redirect()->back();
    }
}
