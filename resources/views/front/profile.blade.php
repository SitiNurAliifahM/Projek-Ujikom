@extends('layouts.front')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm border-light">
                    <div class="card-body">
                        <div class="row">
                            <!-- Profile Picture and Name -->
                            <div class="col-md-4 text-center">
                                <img src="{{ asset('front/assets/img/core-img/user-regular-60.png') }}" alt="Profile Picture"
                                    class="img-fluid rounded-circle mb-3" width="150">
                                <p class="mb-1 text-muted">Selamat datang,</p>
                                <h5 class="fw-bold">{{ $user->username }}</h5>
                            </div>
                            <!-- Profile Info -->
                            <div class="col-md-8">
                                <h5 class="mb-3">Informasi Pribadi</h5>
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
                                        <th class="text">Peran</th>
                                        <td>: <strong>
                                                @if ($user->role)
                                                    <span>Admin</span>
                                                @else
                                                    <span>Pengguna</span>
                                                @endif
                                            </strong></td>
                                    </tr>
                                </table>
                                <div class="text-right">
                                    <a href="#" class="btn btn-success">Edit Profil</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
