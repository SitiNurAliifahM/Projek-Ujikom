@extends('layouts.front')
@section('content')
    <div class="receipe-content-area py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 mx-auto text-center">
                    <div class="receipe-headline my-4">
                        <h2 class="text-dark">{{ $detail->nama_resep }}</h2>
                        <span class="text-muted">Kategori: <strong>{{ $detail->kategori->nama_kategori }}</strong></span>
                    </div>
                </div>
            </div>

            <div class="row align-items-start">
                <div class="col-md-6">
                    <div class="receipe-img mb-4">
                        <img src="{{ asset('gambars/resep/' . $detail->gambar) }}" class="img-fluid rounded shadow"
                            alt="{{ $detail->nama_resep }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class="text-success">Bahan-bahan dan Langkah-langkah</h3>
                    <div class="preparation-steps" v-html="deskripsi">
                        {!! nl2br($detail->deskripsi) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
