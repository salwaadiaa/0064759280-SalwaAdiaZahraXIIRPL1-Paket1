@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('title-header', 'Tambah Pengguna')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Daftar Pengguna</a></li>
    <li class="breadcrumb-item active">Tambah Pengguna</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Pengguna</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <input type="hidden" class="form-control @error('user_id') is-invalid @enderror" id="user_id"
                                placeholder="User ID Pengguna" value="{{ old('user_id', $user_id) }}" name="user_id" required>

                            @error('user_id')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                                placeholder="Username" value="{{ old('username') }}" name="username" required>

                            @error('username')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Nama Pengguna" value="{{ old('name') }}" name="name" required>

                            @error('name')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                placeholder="Alamat Pengguna">{{ old('alamat') }}</textarea>

                            @error('alamat')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="Email Pengguna" value="{{ old('email') }}" name="email" required>

                            @error('email')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="Password" name="password" required>

                            @error('password')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" placeholder="Konfirmasi Password" name="password_confirmation" required>

                            @error('password_confirmation')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="" selected>---Role---</option>
                                @php
                                    $roles = ['petugas', 'user'];
                                @endphp
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}" @if (old('role') == $role) selected @endif>
                                        {{ $role }}</option>
                                @endforeach
                            </select>

                            @error('role')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="avatar">Avatar</label>
                            <input type="file" class="form-control-file @error('avatar') is-invalid @enderror" id="avatar"
                                name="avatar">

                            @error('avatar')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah Pengguna</button>
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
