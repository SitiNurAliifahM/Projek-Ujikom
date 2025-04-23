@extends('layouts.admin')

@section('content')
    <div class="container mt-5 pt-4">
        <div class="d-flex justify-content-center">
            <div class="card shadow-lg p-4 position-relative"
                style="max-width: 600px; width: 100%; background-color: rgb(245, 245, 245);">

                {{-- Profil Header --}}
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/img/avatars/1.png') }}" class="rounded-circle shadow"
                        style="width: 80px; height: 80px; object-fit: cover;" alt="Foto Admin">
                    <div class="ms-3">
                        <p class="mb-1 text-muted">Selamat datang,</p>
                        <h4 class="fw-bold">{{ $user->username }}</h4>
                    </div>
                </div>

                {{-- Mode Tampilan --}}
                <div class="card mt-3 p-3" id="viewProfile">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th>Nama Pengguna</th>
                            <td>: <strong>{{ $user->username }}</strong></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: <strong>{{ $user->email }}</strong></td>
                        </tr>
                        <tr>
                            <th>Peran</th>
                            <td>: <strong>{{ $user->role ? 'Admin' : 'User' }}</strong></td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
