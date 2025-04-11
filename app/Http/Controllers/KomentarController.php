<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_resep)
    {
        $komentar = Komentar::where('id_resep', $id_resep)
            ->with('user') // Ambil informasi user yang memberi komentar
            ->latest() // Urutkan dari yang terbaru
            ->get();

        return response()->json($komentar);

    }

    public function getKomentar($id)
    {
        try {
            $komentar = Komentar::where('id_resep', $id)->with('user')->latest()->get();
            return response()->json($komentar);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
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
    public function store(Request $request, $id)
    {
        try {
            $request->validate([
                'isi_komentar' => 'required|string|max:255',
            ]);

            Komentar::create([
                'id_resep' => $id,
                'id_user' => auth()->id(),
                'isi_komentar' => $request->isi_komentar,
            ]);

            return response()->json(['message' => 'Komentar berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan komentar',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Komentar  $komentar
     * @return \Illuminate\Http\Response
     */
    public function show(Komentar $komentar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Komentar  $komentar
     * @return \Illuminate\Http\Response
     */
    public function edit(Komentar $komentar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Komentar  $komentar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Komentar $komentar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Komentar  $komentar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);

        // Cek apakah user adalah pemilik komentar atau admin
        if (auth()->user()->id !== $komentar->id_user && auth()->user()->role !== 1) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $komentar->delete();
        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }
}
