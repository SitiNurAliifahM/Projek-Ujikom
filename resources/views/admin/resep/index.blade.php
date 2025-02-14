@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Data Tabel Resep</h4>
                <div>
                    <!-- Tombol trigger modal Tambah -->
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#tambahResepModal">
                        Tambah Resep
                    </button>
                </div>
            </div>
            <div class="card">
                <h5 class="card-header">Tabel Resep</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Resep</th>
                                <th>Deskripsi</th>
                                <th>Kategori Resep</th>
                                <th>Gambar Resep</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php $i = 1; @endphp
                            @foreach ($resep as $data)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $data->nama_resep }}</td>
                                    <td>{{ Str::limit(strip_tags($data->deskripsi), 50) }}</td>
                                    <td>{{ $data->kategori->nama_kategori }}</td>
                                    <td>
                                        <img src="{{ asset('gambars/resep/' . $data->gambar) }}" width="100">
                                    </td>
                                    <td>
                                        <form action="{{ route('resep.destroy', $data->id) }}"
                                            onsubmit="return confirm('apakah anda yakin ingin menghapus resep ini?')"
                                            method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')

                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-outline-success btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#editResepModal-{{ $data->id }}">
                                                <i class="bx bxs-pencil" data-bs-toggle="tooltip" title="Edit Resep"></i>
                                            </button>

                                            <!-- Tombol Show Resep -->
                                            {{-- <button type="button" class="btn btn-outline-primary btn-sm btn-show-resep"
                                                data-bs-toggle="modal" data-bs-target="#showResepModal-{{ $data->id }}">
                                                <i class="bx bx-show" data-bs-toggle="tooltip" title="Detail Resep"></i>
                                            </button> --}}
                                            <a href="{{ route('resep.show', $data->id) }}">
                                                <button type="button"
                                                    class="btn btn-outline-primary btn-sm btn-show-resep">
                                                    <i class="bx bx-show" data-bs-toggle="tooltip" title="Detail Resep"></i>
                                                </button>
                                            </a>

                                            <!-- Tombol Hapus -->

                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="bx bxs-trash-alt" data-bs-toggle="tooltip"
                                                    title="Hapus Resep"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit Resep -->
                                <div class="modal fade" id="editResepModal-{{ $data->id }}" tabindex="-1"
                                    aria-labelledby="editResepLabel-{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editResepLabel-{{ $data->id }}">Edit
                                                    Resep</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('resep.update', $data->id) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="editNamaResep-{{ $data->id }}"
                                                            class="form-label">Nama Resep</label>
                                                        <input type="text" class="form-control"
                                                            id="editNamaResep-{{ $data->id }}" name="nama_resep"
                                                            value="{{ $data->nama_resep }}" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                                            placeholder="Masukkan bahan-bahan dan langkah-langkah" required>
                                                            {!! old('deskripsi', $data->deskripsi ?? '') !!}
                                                        </textarea>
                                                        <script src="https://cdn.tiny.cloud/1/22kl6refl24luuy4b2macr4koyjbhwmz7xiyqbu1jlgvnmc9/tinymce/6/tinymce.min.js"
                                                            referrerpolicy="origin"></script>
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
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="namaKategori" class="form-label">Kategori Resep</label>
                                                        <select name="id_kategori" id="id_kategori"
                                                            class="form-select mb-3"placeholder="Pilih Kategori Resep"
                                                            required>
                                                            @foreach ($kategori as $d)
                                                                <option value="{{ $d->id }}">
                                                                    {{ $d->nama_kategori }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('id_kategori')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="gambar" class="form-label">Gambar Resep</label>
                                                        <input type="file"
                                                            class="form-control @error('gambar') is-invalid @enderror"
                                                            id="gambar" name="gambar"
                                                            placeholder="Silahkan pilih gambar yang sesuai untuk resep anda"
                                                            required />
                                                        @error('gambar')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            Tutup
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            Simpan Perubahan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Show Resep -->
                                {{-- <div class="modal fade" id="showResepModal-{{ $data->id }}" tabindex="-1"
                                    aria-labelledby="showResepLabel-{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="showResepLabel-{{ $data->id }}">Detail
                                                    Resep</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center mb-3">
                                                    <img src="{{ asset($data->gambar) }}" alt="Gambar Resep"
                                                        class="img-fluid rounded" style="max-height: 300px;">
                                                </div>
                                                <p><strong>ID:</strong> {{ $data->id }}</p>
                                                <p><strong>Nama Resep:</strong> {{ $data->nama_resep }}</p>
                                                <p><strong>Deskripsi Resep:</strong> {!! $data->deskripsi !!}</p>
                                                <p><strong>Kategori Resep:</strong>
                                                    {{ $data->kategori?->nama_kategori ?? 'Tidak Ada Kategori' }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Tutup
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Resep -->
        <div class="modal fade" id="tambahResepModal" tabindex="-1" aria-labelledby="tambahResepLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahResepLabel">Tambah Resep</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="tambahResepForm" method="POST" enctype="multipart/form-data"
                            action="{{ route('resep.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="namaResep" class="form-label">Nama Resep</label>
                                <input type="text" class="form-control @error('nama_resep') is-invalid @enderror"
                                    id="namaResep" name="nama_resep" placeholder="Masukkan Nama Resep" required />
                                @error('nama_resep')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                    placeholder="Masukkan bahan-bahan dan langkah-langkah" required>
                                </textarea>
                                <script src="https://cdn.tiny.cloud/1/22kl6refl24luuy4b2macr4koyjbhwmz7xiyqbu1jlgvnmc9/tinymce/6/tinymce.min.js"
                                    referrerpolicy="origin"></script>
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
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="namaKategori" class="form-label">Kategori Resep</label>
                                <select name="id_kategori" id="id_kategori"
                                    class="form-select mb-3"placeholder="Pilih Kategori Resep" required>
                                    <option selected disabled value="">Silahkan pilih kategori...</option>
                                    @foreach ($kategori as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar Resep</label>
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                    id="gambar" name="gambar"
                                    placeholder="Silahkan pilih gambar yang sesuai untuk resep anda" required />
                                @error('gambar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" form="tambahResepForm" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
