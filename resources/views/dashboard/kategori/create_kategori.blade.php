@extends('layouts.app')

@section('title', 'Tambah Kategori Buku')

@section('title-header', 'Tambah Kategori Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('kategori.admin') }}">Daftar Kategori</a></li>
    <li class="breadcrumb-item active">Tambah Kategori Buku</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Kategori Buku</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('kategori.store') }}" method="POST" role="form">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori"
                                placeholder="Nama Kategori" value="{{ old('nama_kategori') }}" name="nama_kategori" required>

                            @error('nama_kategori')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                <a href="{{ route('kategori.admin') }}" class="btn btn-sm btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
