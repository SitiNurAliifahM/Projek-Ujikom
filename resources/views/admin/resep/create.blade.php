@extends('layouts.admin')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Tambah Resep</h5>
                        {{-- <small class="text-muted float-end">Default label</small> --}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('resep.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Resep</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama_resep"
                                        class="form-control @error('nama_resep') is-invalid @enderror"
                                        id="basic-default-name" value="" placeholder="Masukkan Nama Resep" required />
                                    @error('nama_resep')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-message">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea for="deskripsi" class="form-control  @error('deskripsi') is-invalid @enderror" id="deskripsi"
                                        value="{{ old('deskripsi') }}" name="deskripsi" placeholder="Masukkan bahan-bahan dan langkah-langkah"
                                        aria-describedby="basic-icon-default-message2" required>
                                    </textarea>
                                    <script src="/tinymce/tinymce.min.js"></script>
                                    <script>
                                        tinymce.init({
                                            selector: '#deskripsi',
                                            height: 300,
                                            menubar: false,
                                            plugins: 'advlist autolink lists link image charmap print preview',
                                            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                                            branding: false
                                        });
                                    </script>
                                    @error('deskripsi')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Nama Kategori</label>
                                <div class="col-sm-10">
                                    <select name="id_kategori" id="id_kategori" class="form-select"
                                        placeholder="Pilih Kategori Resep" required>
                                        <option value="" selected disabled>Silahkan pilih kategori...</option>
                                        @foreach ($kategori as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kategori')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="gambar">Gambar Resep</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                        id="gambar" name="gambar" value="{{ old('gambar') }}"
                                        placeholder="Silahkan pilih gambar yang sesuai untuk resep anda" required>
                                    @error('gambar')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-success">Kirim</button>
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
