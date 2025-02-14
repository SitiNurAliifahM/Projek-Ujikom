<?php

namespace App\Http\Controllers;

use App\Models\Resep;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.index');
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
