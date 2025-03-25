<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resep = Resep::latest()->with('kategori')->get(); // Mengambil resep dengan relasi kategori
        return response()->json($resep); // Kembalikan data dalam format JSON
    }

    /**
     * Search resep by category or name
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $resep = Resep::where('nama_resep', 'LIKE', "%$query%")
            ->orWhereHas('kategori', function ($q) use ($query) {
                $q->where('nama_kategori', 'LIKE', "%$query%");
            })
            ->with('kategori') // Pastikan kategori juga diload
            ->get();

        return response()->json($resep);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resep = Resep::with('kategori')->findOrFail($id); // Mengambil resep dan relasi kategori
        return response()->json($resep); // Kembalikan data resep dalam format JSON
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
            $gambar = $request->file('gambar');
            $name = rand(1000, 9999) . $gambar->getClientOriginalName();
            $gambar->move(public_path('gambars/resep'), $name);
            $resep->gambar = $name;
        }

        $resep->save();

        return response()->json(['message' => 'Resep berhasil ditambahkan', 'data' => $resep], 201);
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

        // upload gambar jika ada
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

        return response()->json(['message' => 'Resep berhasil diubah', 'data' => $resep]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);

        // Menghapus gambar jika ada
        if ($resep->gambar && file_exists(public_path('gambars/resep/' . $resep->gambar))) {
            unlink(public_path('gambars/resep/' . $resep->gambar));
        }

        $resep->delete();

        return response()->json(['message' => 'Resep berhasil dihapus']);
    }
}
