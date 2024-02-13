<!-- resources/views/dashboard/ulasan/ulasan_admin.blade.php -->
@extends('layouts.app')

@section('title', 'Riwayat Ulasan Buku')

@section('title-header', 'Riwayat Ulasan Buku - Admin')
@section('breadcrumb')
@if (Auth::user()->role == 'admin')
    <li class="breadcrumb-item"><a href="{{ route('ulasan.admin') }}">Dashboard Admin</a></li>
    <li class="breadcrumb-item active">Riwayat Ulasan Buku</li>
@endif
@if (Auth::user()->role == 'petugas')
    <li class="breadcrumb-item"><a href="{{ route('ulasan.admin') }}">Dashboard Petugas</a></li>
    <li class="breadcrumb-item active">Riwayat Ulasan Buku</li>
@endif
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Riwayat Ulasan Buku</h2>
                    <form action="{{ route('ulasan.admin') }}" method="GET">
                        <div class="input-group">
                            <select class="form-control" name="judul">
                                <option value="">-- Pilih Judul Buku --</option>
                                @foreach ($listJudulBuku as $judulBuku)
                                    <option value="{{ $judulBuku->judul }}" {{ request('judul') == $judulBuku->judul ? 'selected' : '' }}>
                                        {{ $judulBuku->judul }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-custom">Filter</button>
                        </div>
                    </form>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Buku</th>
                                    <th>Ulasan</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ulasans as $ulasan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ulasan->user->name }}</td>
                                        <td>{{ $ulasan->buku->judul }}</td>
                                        <td>{{ $ulasan->ulasan }}</td>
                                        <td>{!! str_repeat('<i class="fa fa-star"></i>', $ulasan->rating) !!}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Tidak ada ulasan buku.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
