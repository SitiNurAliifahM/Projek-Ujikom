<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class User extends Controller
{
    public function showProfile()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();
        return view('front.profile', compact('user')); // Mengirim data pengguna ke view
    }
}
