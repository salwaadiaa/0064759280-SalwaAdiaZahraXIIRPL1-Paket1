<!-- resources/views/dashboard/ulasan/ulasan_admin.blade.php -->
@extends('layouts.app')

@section('title', 'Riwayat Ulasan Buku')

@section('title-header', 'Riwayat Ulasan Buku - Admin')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('ulasan.admin') }}">Admin Dashboard</a></li>
    <li class="breadcrumb-item active">Riwayat Ulasan Buku</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Riwayat Ulasan Buku</h2>
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
                                        <td>{{ $ulasan->rating }}</td>
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