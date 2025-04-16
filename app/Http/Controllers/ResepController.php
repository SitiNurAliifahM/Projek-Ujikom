<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Resep;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resep = Resep::latest()->get();
        $kategori = Kategori::all();
        confirmDelete('Hapus', 'Apakah anda yakin ingin menghapus resep ini?');
        return view('admin.resep.index', compact('resep', 'kategori'));
    }

    public function listResep(Request $request)
    {
        $query = Resep::query();

// Tambahkan filter hanya resep yang diapprove
        $query->where('status', 'approve');

// Jika ada request kategori, filter berdasarkan kategori
        if ($request->has('id_kategori') && $request->id_kategori != '') {
            $query->where('id_kategori', $request->id_kategori);
        }

        $resep = $query->get();
        $kategori = Kategori::all();

        return view('front.resep', compact('resep', 'kategori'));

    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $resep = Resep::where('nama_kategori', 'LIKE', "%$query%")
            ->orWhere('kategori', 'LIKE', "%$query%")
            ->get();

        return view('front.index', compact('resep'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.resep.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $resep->id_user = $request->id_user ?? auth()->id();

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

        dd($request->all());

        // Redirect ke halaman daftar resep
        return redirect()->back()->with('success', 'Resep berhasil diajukan dan menunggu persetujuan admin.');
    }

    public function approve($id)
    {
        $resep = Resep::findOrFail($id);
        $resep->status = 'approve';
        $resep->save();

        Alert::success('Succes', 'Pengajuan resep berhasil disetujui !')->autoClose(1500);
        return redirect()->back();
    }

    public function reject($id)
    {
        $resep = Resep::findOrFail($id);
        $resep->status = 'rejected';
        $resep->save();

        Alert::error('Error', 'Pengajuan resep tidak disetujui !')->autoClose(1500);
        return redirect()->back();
    }

    public function show($id)
    {
        $resep = Resep::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.resep.show', compact('resep', 'kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resep = Resep::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.resep.edit', compact('resep', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_resep' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategoris,id',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $resep = Resep::findOrFail($id);
        $resep->nama_resep = $request->nama_resep;
        $resep->id_kategori = $request->id_kategori;
        $resep->deskripsi = $request->deskripsi;

        // upload gambar
        if ($request->hasFile('gambar')) {
            if ($resep->gambar && file_exists(public_path('gambars/resep/' . $resep->gambar))) {
                unlink(public_path('gambars/resep/' . $resep->gambar));
            }
            $gambar = $request->file('gambar');
            $name = rand(1000, 9999) . $gambar->getClientOriginalName();
            $gambar->move(public_path('gambars/resep'), $name);
            $resep->gambar = $name;
        }

        // dd($id);die;
        $resep->save();
        Alert::success('Success', 'Resep berhasil diubah')->autoClose(5000);
        return redirect()->route('resep.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);
        $resep->delete();

        Alert::success('Success', 'Resep berhasil dihapus')->autoClose(5000);
        return redirect()->route('resep.index');
    }
}
