@extends('layouts.front')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row g-4">
                    <!-- Kolom Profil -->
                    <div class="col-md-5">
                        <div class="card shadow-sm border-0 rounded-4">
                            <div class="card-body text-center p-4">
                                <img src="{{ asset('front/assets/img/core-img/user-regular-60.png') }}" alt="Profile Picture"
                                    class="img-fluid rounded-circle mb-3" width="100">

                                <p class="mb-1 text-muted">Selamat datang,</p>
                                <h5 class="fw-bold mb-3">{{ $user->username }}</h5>
                                <hr>

                                <div class="text-start mt-4 px-3">
                                    <h6 class="mb-3 text-center fw-semibold">Informasi Pribadi</h6>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="fw-semibold">Nama Pengguna:</span>
                                        <span>{{ $user->username }}</span>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="fw-semibold">Email:</span>
                                        <span>{{ $user->email }}</span>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="fw-semibold">Peran:</span>
                                        <span>
                                            {{ $user->role ? 'Admin' : 'Pengguna' }}
                                        </span>
                                    </div>
                                </div>

                                <a href="#" class="btn btn-success mt-4 px-4">Edit Profil</a>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Form Pengajuan Resep -->
                    <div class="col-md-7">
                        <div class="card shadow-sm border-0 rounded-4">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-4">Ajukan Resep</h5>

                                <form action="{{ route('pengajuanresep.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    {{-- Judul --}}
                                    <div class="mb-3">
                                        <label for="judul" class="form-label">Judul Resep</label>
                                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                            id="judul" name="judul" value="{{ old('judul') }}"
                                            placeholder="Masukkan judul resep" required>
                                        @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Deskripsi --}}
                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi / Isi Resep</label>
                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                            placeholder="Masukkan bahan-bahan dan langkah-langkah">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Kategori --}}
                                    <div class="mb-3">
                                        <label for="id_kategori" class="form-label">Kategori</label>
                                        <select class="form-select @error('id_kategori') is-invalid @enderror"
                                            id="id_kategori" name="id_kategori" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('id_kategori') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_kategori')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Gambar --}}
                                    <div class="mb-3">
                                        <label for="gambar" class="form-label">Gambar</label>
                                        <input class="form-control @error('gambar') is-invalid @enderror" type="file"
                                            id="gambar" name="gambar">
                                        @error('gambar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="user" class="form-label fw-semibold">Dibuat oleh:</label>
                                        <input type="text" class="form-control"
                                            value="{{ $user->username ?? 'User tidak ditemukan' }}" readonly>
                                        <input type="hidden" name="id_user" value="{{ $user->id ?? '' }}">
                                    </div>

                                    {{-- Tombol Simpan --}}
                                    <button type="submit" class="btn btn-primary">Simpan Resep</button>
                                </form>

                                {{-- TinyMCE --}}
                                <script src="/tinymce/tinymce.min.js"></script>
                                <script>
                                    tinymce.init({
                                        selector: '#deskripsi',
                                        height: 300,
                                        menubar: false,
                                        plugins: 'advlist autolink lists link image charmap print preview',
                                        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                                        branding: false,
                                        setup: function(editor) {
                                            editor.on('change', function() {
                                                tinymce.triggerSave(); // sync content to textarea
                                            });
                                        }
                                    });

                                    // Validasi sebelum submit
                                    document.querySelector('form').addEventListener('submit', function(e) {
                                        tinymce.triggerSave();
                                        const deskripsiValue = tinymce.get("deskripsi").getContent({
                                            format: 'text'
                                        }).trim();
                                        if (!deskripsiValue) {
                                            e.preventDefault();
                                            alert("Deskripsi tidak boleh kosong.");
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- End Kolom Form -->
                </div>
            </div>
        </div>
    </div>
@endsection
