@extends('layouts.app')
@section('title', 'Tambah Buku')

@section('title-header', 'Tambah Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('buku.index') }}">Daftar Buku</a></li>
    <li class="breadcrumb-item active">Tambah Buku</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Buku</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('buku.store') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="buku_id">ID Buku</label>
                            <input type="text" class="form-control @error('buku_id') is-invalid @enderror" id="buku_id"
                                placeholder="ID Buku" value="{{ old('buku_id', $buku_id) }}" name="buku_id" readonly required>

                            @error('buku_id')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                                placeholder="Judul" value="{{ old('judul') }}" name="judul" required>

                            @error('judul')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis"
                                placeholder="Penulis" value="{{ old('penulis') }}" name="penulis" required>

                            @error('penulis')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit"
                                placeholder="Penerbit" value="{{ old('penerbit') }}" name="penerbit" required>

                            @error('penerbit')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tahun_terbit">Tahun Terbit</label>
                            <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit"
                                placeholder="Tahun Terbit" value="{{ old('tahun_terbit') }}" name="tahun_terbit" required>

                            @error('tahun_terbit')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="kategori_id">Kategori</label>
                            <select class="form-control" id="kategori_id" name="kategori_id">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoriBukus as $kategoriBuku)
                                    <option value="{{ $kategoriBuku->kategori_id }}">{{ $kategoriBuku->nama_kategori }}</option>
                                @endforeach
                            </select>

                            @error('kategori_id')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control-file @error('gambar') is-invalid @enderror" id="gambar"
                                name="gambar">

                            @error('gambar')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                <a href="{{ route('buku.index') }}" class="btn btn-sm btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
