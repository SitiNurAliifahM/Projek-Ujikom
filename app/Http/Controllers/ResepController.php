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
        $resep = Resep::all();
        $kategori = Kategori::all();
        $title = 'Hapus Resep!';
        $text = "Apakah anda yakin ingin menghapus resep ini?";
        confirmDelete($title, $text);
        return view('admin.resep.index', compact('resep', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_resep' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategoris,id',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $resep = new Resep();
        $resep->nama_resep = $request->nama_resep;
        $resep->id_kategori = $request->id_kategori;
        $resep->deskripsi = $request->deskripsi;

        // Ambil ID user yang sedang login
        $resep->id_user = auth()->user()->id;

        // Cek apakah user adalah admin (role 1)
        if (auth()->user()->role == 1) {
            $resep->status = 'approve'; // Jika admin, otomatis approve
        } else {
            $resep->status = 'pending'; // Jika bukan admin, status pending
        }

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

        $resep->save();
        Alert::success('Success', 'Resep berhasil ditambahkan')->autoClose(5000);
        return redirect()->route('resep.index');
        dd($request->all()); // Debug untuk melihat apakah data dikirim

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resep = Resep::findOrFail($id);
        return view('admin.resep.show', compact('resep'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function edit(Resep $resep)
    {
        //
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
            'status' => 'required|in:pending,approve,rejected',
        ]);

        $resep = Resep::findOrFail($id);
        $resep->nama_resep = $request->nama_resep;
        $resep->id_kategori = $request->id_kategori;
        $resep->deskripsi = $request->deskripsi;
        $resep->id_user = $request->id_user;
        $resep->status = $request->status;

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
