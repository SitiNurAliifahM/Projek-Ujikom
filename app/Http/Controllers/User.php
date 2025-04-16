<?php

namespace App\Http\Controllers;


use App\Models\Resep;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class User extends Controller
{
    public function showProfile()
    {
        // Mengambil data pengguna yang sedang login

        $user = Auth::user();
        $resep = Resep::with('kategori')
            ->where('id_user', $user->id)
            ->latest()
            ->get();
        $kategori = Kategori::all();

        return view('front.profile', compact('user', 'resep', 'kategori'));
// Mengirim data pengguna ke view
    }
}
