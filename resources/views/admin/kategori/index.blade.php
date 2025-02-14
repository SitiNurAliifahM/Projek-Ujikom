@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Data Tabel Kategori</h4>
                <div>
                    <!-- Tombol trigger modal Tambah -->
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#tambahKategoriModal">
                        Tambah Kategori
                    </button>
                </div>
            </div>

            @if (session('error'))
                <div class="bs-toast toast toast-placement-ex m-2 bg-danger top-0 end-0 fade show toast-custom" role="alert"
                    aria-live="assertive" aria-atomic="true" id="toastError">
                    <div class="toast-header">
                        <i class="bx bx-error me-2"></i>
                        <div class="me-auto fw-semibold">Error</div>
                        <small>Baru saja</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="bs-toast toast toast-placement-ex m-2 bg-success top-0 end-0 fade show toast-custom"
                    role="alert" aria-live="assertive" aria-atomic="true" id="toastSuccess">
                    <div class="toast-header">
                        <i class="bx bx-check me-2"></i>
                        <div class="me-auto fw-semibold">Success</div>
                        <small>Baru saja</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="card">
                <h5 class="card-header">Tabel Kategori</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php $i = 1; @endphp
                            @foreach ($kategori as $data)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $data->nama_kategori }}</td>
                                    <td>

                                        <form action="{{ route('kategori.destroy', $data->id) }}"
                                            onsubmit="return confirm('apakah anda yakin ingin menghapus kategori ini?')"
                                            method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <!-- Tombol Edit -->
                                            {{-- <button type="button" class="btn btn-outline-success btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editKategoriModal-{{ $data->id }}">
                                                <i class="bx bxs-pencil" data-bs-toggle="tooltip" title="Edit Kategori"></i>
                                            </button> --}}

                                            <!-- Tombol Show -->
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#showKategoriModal-{{ $data->id }}">
                                                <i class="bx bx-show" data-bs-toggle="tooltip" title="Detail Kategori"></i>
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="bx bxs-trash-alt" data-bs-toggle="tooltip"
                                                    title="Hapus Kategori"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit Kategori -->
                                {{-- <div class="modal fade" id="editKategoriModal-{{ $data->id }}" tabindex="-1"
                                    aria-labelledby="editKategoriLabel-{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editKategoriLabel-{{ $data->id }}">Edit
                                                    Kategori</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('kategori.update', $data->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="editNamaKategori-{{ $data->id }}"
                                                            class="form-label">Nama Kategori</label>
                                                        <input type="text" class="form-control"
                                                            id="editNamaKategori-{{ $data->id }}" name="nama_kategori"
                                                            value="{{ $data->nama_kategori }}" required />
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
                                </div> --}}

                                <!-- Modal Show Kategori -->
                                <div class="modal fade" id="showKategoriModal-{{ $data->id }}" tabindex="-1"
                                    aria-labelledby="showKategoriLabel-{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="showKategoriLabel-{{ $data->id }}">Detail
                                                    Kategori</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{-- <p><strong>ID:</strong> {{ $data->id }}</p> --}}
                                                <p><strong>Nama Kategori:</strong> {{ $data->nama_kategori }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Tutup
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Kategori -->
        <div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="tambahKategoriLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahKategoriLabel">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="tambahKategoriForm" method="POST" action="{{ route('kategori.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="namaKategori" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                                    id="namaKategori" name="nama_kategori" placeholder="Masukkan Nama Kategori"
                                    required />
                                @error('nama_kategori')
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
                        <button type="submit" form="tambahKategoriForm" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
