@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('title-header', 'Dashboard Admin')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard Admin</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Buku</h5>
                    <i class="fas fa-book fa-4x mb-3"></i>
                    <p class="card-text">{{ $totalBuku }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Kategori Buku</h5>
                    <i class="fas fa-bookmark fa-4x mb-3"></i>
                    <p class="card-text">{{ $totalKategoriBuku }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Peminjaman</h5>
                    <i class="fas fa-user fa-4x mb-3"></i>
                    <p class="card-text">{{ $totalPeminjaman }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
