@extends('layouts.admin')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xxl">
                <div class="card shadow-lg mb-4 border-0">
                    <div
                        class="card-header bg-transparent text-white d-flex align-items-center justify-content-between rounded-top">
                        <h5 class="mb-0">Detail Resep : <strong>{{ $resep->nama_resep }}</strong></h5>
                    </div>
                    <div class="card-body bg-light">
                        <form>
                            <div class="row mb-4">
                                <label class="col-sm-3 col-form-label fw-semibold text-dark">Nama Resep :</label>
                                <div class="col-sm-9 d-flex align-items-center">
                                    <span class="fs-6 fw-bold">{{ $resep->nama_resep }}</span>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="col-sm-3 col-form-label fw-semibold text-dark">Gambar Resep :</label>
                                <div class="col-sm-9">
                                    <img src="{{ asset('gambars/resep/' . $resep->gambar) }}" alt="Gambar Resep"
                                        class="img-thumbnail shadow" style="max-height: 300px; border-radius: 12px;">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="col-sm-3 col-form-label fw-semibold text-dark">Kategori Resep :</label>
                                <div class="col-sm-9 d-flex align-items-center">
                                    <span class="badge bg-success text-dark p-2">{{ $resep->kategori->nama_kategori }}</span>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="col-sm-3 col-form-label fw-semibold text-dark">Deskripsi :</label>
                                <div class="col-sm-9">
                                    <div class="border rounded bg-white p-3" style="min-height: 100px;">
                                        {!! $resep->deskripsi !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-9 offset-sm-3">
                                    <a href="{{ route('resep.index') }}" class="btn btn-outline-secondary">
                                        <i class="bx bx-arrow-back"></i> Kembali ke Daftar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
