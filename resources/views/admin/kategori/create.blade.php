@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Tambah Kategori</h5>
                        <form class="row g-3" method="POST" action="{{ route('kategori.store') }}">
                            @csrf
                            <div class="col-12">
                                <label for="input13" class="form-label">Nama Kategori</label>
                                <div class="position-relative input-icon">
                                    <input type="text" name="nama_kategori"
                                        class="form-control @error('nama_kategori') is-invalid @enderror" id="input13"
                                        value="{{ old('nama_kategori') }}" placeholder="Masukkan Nama Kategori" required>
                                    <span class="position-absolute top-50 translate-middle-y"><i
                                            class="material-icons-outlined fs-5"></i></span>
                                    @error('nama_kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-end gap-3">
                                    <button type="submit" class="btn btn-outline-success px-4">Kirim</button>
                                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-dark px-4">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
