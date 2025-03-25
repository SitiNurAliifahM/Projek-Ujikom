@extends('layouts.admin')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Detail Resep {{ $resep->nama_resep }}</h5>
                        {{-- <small class="text-muted float-end">Default label</small> --}}
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label fw-bold">Nama Resep : </label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <span>{{ $resep->nama_resep }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label fw-bold">Deskripsi : </label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <span>{!! $resep->deskripsi !!}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label fw-bold">Nama Kategori : </label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <span>{{ $resep->kategori->nama_kategori }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Gambar Resep : </label>
                                <div class="col-sm-10">
                                    <img src="{{ asset('gambars/resep/' . $resep->gambar) }}" alt="Gambar Resep"
                                        class="img-fluid rounded" style="max-height: 300px;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <a href="{{ route('resep.index') }}" class="btn btn-outline-danger">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
