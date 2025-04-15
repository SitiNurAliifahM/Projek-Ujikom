<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['getKomentar']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount = User::count();
        $resepCount = Resep::count();
        $user = Auth::user();
        $resep = Resep::take(6)->get();
        if ($user->role == 1) {
            return view('admin.index', compact('userCount', 'resepCount'));
        } else {
            return view('front.index', compact('resep'));
        }
    }

    public function profile()
    {
        $title = 'Profil';
        $user = auth()->user();
        return view('admin.profile.index', compact('user', 'title',));

        return abort(403);
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('admin.profile.edit-profile', compact('user'));

    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id); // Mencari pengguna berdasarkan ID

        // Validasi data yang di-submit
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        // Memperbarui data pengguna
        $user->name = $request->username;
        $user->email = $request->email;

        // Simpan perubahan
        $user->save();

        // Redirect ke halaman edit profil dengan pesan sukses
        return redirect()->route('profile.index', ['id' => $user->id])->with('success', 'Profil berhasil diperbarui.');
    }

}
