@extends('layouts.front')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4 overflow-hidden position-relative">
                    <!-- Ikon pensil edit -->
                    <button class="btn btn-sm btn-outline-success position-absolute end-0 top-0 m-3" data-bs-toggle="modal"
                        data-bs-target="#editProfileModal">
                        <i class="fa fa-pencil"></i>
                    </button>

                    <div class="card-body text-center p-5 bg-light">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <img src="{{ asset('front/assets/img/core-img/user-regular-60.png') }}" alt="Profile Picture"
                            class="img-fluid rounded-circle mb-3 border border-2 border-success" width="100"
                            height="100">

                        <h5 class="fw-bold mb-1">{{ $user->username }}</h5>
                        <p class="text-muted mb-3">Selamat datang di halaman profil Anda.</p>

                        <hr class="my-4">

                        <h6 class="fw-semibold mb-4 text-success">Informasi Pribadi</h6>

                        <div class="row justify-content-center">
                            <div class="col-md-8 text-start">
                                <div class="mb-3 d-flex justify-content-between">
                                    <span class="fw-semibold text-dark">Nama Pengguna:</span>
                                    <span>{{ $user->username }}</span>
                                </div>

                                <div class="mb-3 d-flex justify-content-between">
                                    <span class="fw-semibold text-dark">Email:</span>
                                    <span>{{ $user->email }}</span>
                                </div>

                                <div class="mb-3 d-flex justify-content-between">
                                    <span class="fw-semibold text-dark">Peran:</span>
                                    <span>{{ $user->role ? 'Admin' : 'Pengguna' }}</span>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger px-4 mt-4">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Profil -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('update.profile') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nama Pengguna</label>
                        <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
