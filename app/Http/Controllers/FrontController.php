<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {
        $kategoriCount = DB::table('reseps')
            ->join('kategoris', 'reseps.id_kategori', '=', 'kategoris.id')
            ->select('kategoris.nama_kategori', DB::raw('count(*) as total'))
            ->groupBy('kategoris.nama_kategori')
            ->get();

        $hero_resep = Resep::latest()->take(3)->get();
        $resepCount = Resep::count();
        // Ambil 3 resep dengan like terbanyak untuk ditampilkan sebagai "best resep"
        $resep_terbaru = Resep::withCount('like') // hitung jumlah like
            ->orderBy('like_count', 'desc') // urutkan dari like terbanyak
            ->take(3)
            ->get();

        // Ambil 3 resep lain secara acak tapi tidak termasuk yang terbaru
        $resep_lain = Resep::whereNotIn('id', $resep_terbaru->pluck('id'))->inRandomOrder()->take(6)->get();

        return view('front.index', compact('resep_terbaru', 'resep_lain', 'resepCount', 'hero_resep', 'kategoriCount'));
    }

    public function about()
    {
        return view('front.about');
    }

    public function kontak()
    {
        return view('front.kontak');
    }

    public function resep()
    {
        $resep = Resep::all();
        return view('front.resep', compact('resep'));
    }

    public function detail_resep($id)
    {
        $detail = Resep::findOrFail($id);
        return view('front.detail_resep', compact('detail'));
    }
}
