<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class User extends Controller
{
    public function showProfile()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();
        $kategori = Kategori::all();
        return view('front.profile', compact('user','kategori')); // Mengirim data pengguna ke view
    }
}
