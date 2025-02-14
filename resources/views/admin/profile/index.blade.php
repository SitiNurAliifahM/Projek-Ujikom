@extends('layouts.admin')

@section('content')
    <div class="container mt-5 pt-4">
        <div class="d-flex justify-content-center">
            <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%; background-color: rgb(245, 245, 245);">

                <!-- Ikon Edit di Pojok Kanan Atas -->
                <a href="{{ route('profile.edit') }}"
                    class="position-absolute top-0 end-0 mt-3 me-3 text-decoration-none text-dark">
                    <i class="bx bx-pencil fs-5"></i> <!-- Bootstrap Icons -->
                </a>

                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/img/avatars/1.png') }}" class="rounded-circle shadow"
                        style="width: 80px; height: 80px; object-fit: cover;" alt="Foto Admin">
                    <div class="ms-3">
                        <p class="mb-1 text-muted">Selamat datang,</p>
                        <h4 class="fw-bold">{{ $user->username }}</h4>
                    </div>
                    <a href="#" class="ms-auto text-decoration-none">
                        <i class="bi bi-pencil-square"></i> <!-- Icon Edit -->
                    </a>
                </div>

                <div class="card mt-3 p-3">
                    <table class="table table-border mb-0">
                        <tr>
                            <th class="text">Nama Pengguna</th>
                            <td>: <strong>{{ $user->username }}</strong></td>
                        </tr>
                        <tr>
                            <th class="text">Email</th>
                            <td>: <strong>{{ $user->email }}</strong></td>
                        </tr>
                        <tr>
                            <th class="text">Role</th>
                            <td>: <strong>
                                    @if ($user->role)
                                        <span>Admin</span>
                                    @else
                                        <span>User</span>
                                    @endif
                                </strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
