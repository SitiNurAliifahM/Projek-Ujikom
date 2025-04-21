<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Resep2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

// Redirect ke halaman daftar resep
        return redirect()->back()->with('success', 'Resep berhasil diajukan dan menunggu persetujuan admin.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
