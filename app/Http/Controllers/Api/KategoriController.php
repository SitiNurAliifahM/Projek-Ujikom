<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $kategori = Kategori::all();
        return response()->json(['success' => true, 'data' => $kategori], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori',
        ]);

        $kategori = Kategori::create([ 'nama_kategori' => $request->nama_kategori ]);
        return response()->json(['success' => true, 'message' => 'Kategori berhasil ditambahkan', 'data' => $kategori], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $kategori = Kategori::find($id);
        if (!$kategori) {
            return response()->json(['success' => false, 'message' => 'Kategori tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }
        return response()->json(['success' => true, 'data' => $kategori], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori,' . $id,
        ]);

        $kategori = Kategori::find($id);
        if (!$kategori) {
            return response()->json(['success' => false, 'message' => 'Kategori tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }

        $kategori->update(['nama_kategori' => $request->nama_kategori]);
        return response()->json(['success' => true, 'message' => 'Kategori berhasil diperbarui', 'data' => $kategori], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        if (!$kategori) {
            return response()->json(['success' => false, 'message' => 'Kategori tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }

        if ($kategori->resep()->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Kategori tidak bisa dihapus karena terdapat resep di dalamnya'], Response::HTTP_BAD_REQUEST);
        }

        $kategori->delete();
        return response()->json(['success' => true, 'message' => 'Kategori berhasil dihapus'], Response::HTTP_OK);
    }
}
