@extends('layouts.admin')

@section('content')
    <div class="container mt-5 pt-4">
        {{-- Pesan sukses di luar card --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center mx-auto" style="max-width: 600px;"
                role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex justify-content-center">
            <div class="card shadow-lg p-4 position-relative"
                style="max-width: 600px; width: 100%; background-color: rgb(245, 245, 245);">

                {{-- Pesan sukses --}}
                    {{-- @if (session('success'))
                    <div class="alert alert-success position-absolute top-0 start-0 w-100 rounded-0 text-center" style="z-index: 1000;">
                        {{ session('success') }}
                    </div>
                @endif --}}

                {{-- Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Profil Header --}}
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/img/avatars/1.png') }}" class="rounded-circle shadow"
                        style="width: 80px; height: 80px; object-fit: cover;" alt="Foto Admin">
                    <div class="ms-3">
                        <p class="mb-1 text-muted">Selamat datang,</p>
                        <h4 class="fw-bold">{{ $user->username }}</h4>
                    </div>
                    <button class="btn btn-sm ms-auto" id="toggleEdit">
                        <i class="bx bx-pencil" data-bs-toggle="tooltip" title="Edit Profil"></i>
                    </button>
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

                {{-- Mode Edit --}}
                <form action="{{ route('profile.update', $user->id) }}" method="POST" class="card mt-3 p-3"
                    id="editProfile" style="display: none;">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="username" class="form-label">Nama Pengguna</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ old('username', $user->username) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-danger" id="cancelEdit">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script Toggle Mode --}}
    <script>
        const toggleBtn = document.getElementById('toggleEdit');
        const viewSection = document.getElementById('viewProfile');
        const editSection = document.getElementById('editProfile');
        const cancelBtn = document.getElementById('cancelEdit');

        toggleBtn.addEventListener('click', () => {
            viewSection.style.display = 'none';
            editSection.style.display = 'block';
            toggleBtn.style.display = 'none';
        });

        cancelBtn.addEventListener('click', () => {
            viewSection.style.display = 'block';
            editSection.style.display = 'none';
            toggleBtn.style.display = 'inline-block';
        });
    </script>
@endsection
