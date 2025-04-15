@extends('layouts.admin')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    @endpush

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Data Tabel Pengajuan Resep</h4>
                {{-- <div>
                    <a href="{{ route('resep.create') }}">
                        <button type="button" class="btn btn-outline-success">
                            + Tambah Resep
                        </button>
                    </a>
                </div> --}}
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
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($resep as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama_resep }}</td>
                                    <td>{{ Str::limit(strip_tags($data->deskripsi), 50) }}</td>
                                    <td>{{ $data->kategori->nama_kategori }}</td>
                                    <td>
                                        <img src="{{ asset('gambars/resep/' . $data->gambar) }}"
                                            style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                                    </td>
                                    <td>
                                        @if ($data->status == 'approve')
                                            <span class="badge bg-info text-dark"
                                                style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">
                                                Menyetujui
                                            </span>
                                        @elseif ($data->status == 'rejected')
                                            <span class="badge bg-danger text-white"
                                                style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">
                                                Tidak Menyetujui
                                            </span>
                                        @else
                                            <form action="{{ route('pengajuanResep.approve', $data->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>
                                            <form action="{{ route('pengajuanResep.reject', $data->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('resep.destroy', $data->id) }}"
                                            onsubmit="return confirm('apakah anda yakin ingin menghapus resep ini?')"
                                            method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')

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

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.table').DataTable({
                    responsive: true,
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        paginate: {
                            first: "Awal",
                            last: "Akhir",
                            next: "›",
                            previous: "‹"
                        },
                        zeroRecords: "Tidak ada data yang ditemukan",
                        infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                        infoFiltered: "(disaring dari total _MAX_ data)"
                    }
                });
            });
        </script>
    @endpush
@endsection
