@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Data Tabel Resep</h4>
                <div>
                    <a href="{{ route('resep.create') }}">
                        <button type="button" class="btn btn-outline-success">
                            + Tambah Resep
                        </button>
                    </a>
                </div>
            </div>
            <div class="card">
                <h5 class="card-header">Tabel Resep</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Resep</th>
                                <th>Deskripsi</th>
                                <th>Kategori Resep</th>
                                <th>Gambar Resep</th>
                                <th>Status</th>
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
                                        <img src="{{ asset('gambars/resep/' . $data->gambar) }}"
                                            style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                                    </td>
                                    <td>
                                        @if ($data->status === 'approve')
                                            <button class="btn btn-success btn-sm">Approve</button>
                                        @elseif ($data->status === 'rejected')
                                            <button class="btn btn-danger btn-sm">Reject</button>
                                        @else
                                            <form action="{{ route('resep.approve', $data->id) }}" method="POST" `
                                                style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-success btn-sm">Approve</button>
                                            </form>

                                            <form action="{{ route('resep.reject', $data->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-danger btn-sm">Reject</button>
                                            </form>
                                        @endif
                                    </td>

                                    <td>
                                        <form action="{{ route('resep.destroy', $data->id) }}"
                                            onsubmit="return confirm('apakah anda yakin ingin menghapus resep ini?')"
                                            method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')

                                            <!-- Tombol Edit -->
                                            <a href="{{ route('resep.edit', $data->id) }}">
                                                <button type="button" class="btn btn-outline-success btn-sm">
                                                    <i class="bx bxs-pencil" data-bs-toggle="tooltip"
                                                        title="Edit Resep"></i>
                                                </button>
                                            </a>

                                            <!-- Tombol Show Resep -->
                                            <a href="{{ route('resep.show', $data->id) }}">
                                                <button type="button" class="btn btn-outline-primary btn-sm">
                                                    <i class="bx bxs-show" data-bs-toggle="tooltip"
                                                        title="Detail Resep"></i>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
