<!-- resources/views/dashboard/peminjaman/riwayat.blade.php -->

@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')

@section('content')
    <div class="container-fluid">
        <h2>Riwayat Peminjaman</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status Peminjaman</th>
                    <th>Denda</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayats as $riwayat)
                    <tr>
                        <td>{{ $riwayat->id }}</td>
                        <td>{{ $riwayat->user->name }}</td>
                        <td>{{ $riwayat->buku->judul }}</td>
                        <td>{{ $riwayat->tanggal_peminjaman }}</td>
                        <td>{{ $riwayat->tanggal_pengembalian }}</td>
                        <td>{{ $riwayat->status_peminjaman }}</td>
                        <td>{{ $riwayat->denda }}</td>
                        <td>
                            <!-- Tambahkan aksi tambahan sesuai kebutuhan di sini -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
