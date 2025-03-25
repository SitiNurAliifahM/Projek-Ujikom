<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $likes = Like::all();
        return response()->json($likes);
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
            'id_resep' => 'required|integer|exists:reseps,id',
        ]);

        $id_user = Auth::id();

        // Cek apakah user sudah like resep ini
        $like = Like::where('id_user', $id_user)
            ->where('id_resep', $request->id_resep)
            ->first();

        if ($like) {
            return response()->json(['message' => 'Anda sudah menyukai resep ini!'], 400);
        }

        // Jika belum like, tambahkan ke database
        $newLike = Like::create([
            'id_user' => $id_user,
            'id_resep' => $request->id_resep,
            'is_like' => true, // Set default nilai is_like
        ]);

        return response()->json($newLike, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $like = Like::find($id);
        if (!$like) {
            return response()->json(['message' => 'Like tidak ditemukan'], 404);
        }

        return response()->json($like);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_user = Auth::id(); // Ambil ID user yang login

        $like = Like::where('id_user', $id_user)
            ->where('id_resep', $id)
            ->first();

        if (!$like) {
            return response()->json(['message' => 'Like tidak ditemukan atau sudah dihapus'], 404);
        }

        $like->delete();
        return response()->json(['message' => 'Unlike berhasil']);

    }

    public function toggleLike(Request $request)
    {
        $request->validate([
            'id_resep' => 'required|integer|exists:reseps,id',
        ]);

        // Pastikan user sudah login
        if (!Auth::check()) {
            return response()->json(['message' => 'Silakan login terlebih dahulu untuk memberi like!'], 401);
        }

        $id_user = Auth::id();
        $like = Like::where('id_user', $id_user)
            ->where('id_resep', $request->id_resep)
            ->first();

        if ($like) {
            $like->delete(); // Unlike
            return response()->json(['message' => 'unliked', 'liked' => false]);
        } else {
            Like::create([
                'id_user' => $id_user,
                'id_resep' => $request->id_resep,
                'is_like' => true, // Set default nilai is_like
            ]);
            return response()->json(['message' => 'liked', 'liked' => true]);
        }
    }
}
