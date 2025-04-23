<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $kategoriCount = DB::table('reseps')
            ->join('kategoris', 'reseps.id_kategori', '=', 'kategoris.id')
            ->select('kategoris.nama_kategori', DB::raw('count(*) as total'))
            ->groupBy('kategoris.nama_kategori')
            ->get();

        $hero_resep = Resep::latest()->take(3)->get();
        $userCount = User::where('role', '!=', 1)->count();
        $resepCount = Resep::count();
        $user = Auth::user();
        // Ambil 3 resep dengan like terbanyak untuk ditampilkan sebagai "best resep"
        $resep_terbaru = Resep::withCount('like') // hitung jumlah like
            ->orderBy('like_count', 'desc') // urutkan dari like terbanyak
            ->take(3)
            ->get();

        // Ambil 3 resep lain secara acak tapi tidak termasuk yang terbaru
        $resep_lain = Resep::whereNotIn('id', $resep_terbaru->pluck('id'))->inRandomOrder()->take(6)->get();

        if ($user->role == 1) {
            return view('admin.index', compact(
                'userCount',
                'resepCount',
                'user'
            ));
        } else {
            return view('front.index', compact('resep_terbaru',
                'resep_lain', 'hero_resep', 'resepCount', 'kategoriCount'));
        }
    }

    public function profile()
    {
        $title = 'Profil';
        $user = auth()->user();
        return view('admin.profile.index', compact('user', 'title', ));

        return abort(403);
    }

}
