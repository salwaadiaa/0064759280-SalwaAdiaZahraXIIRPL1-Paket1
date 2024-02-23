@extends('layouts.app')
@section('title', 'Edit Buku - ' . $buku->judul)

@section('title-header', 'Edit Buku - ' . $buku->judul)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('buku.index') }}">Daftar Buku</a></li>
    <li class="breadcrumb-item active">Edit Buku - {{ $buku->judul }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Edit Buku</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('buku.update', $buku->buku_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="buku_id">ID Buku</label>
                            <input type="text" class="form-control" id="buku_id" name="buku_id" value="{{ $buku->buku_id }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="gambar">Gambar</label>
                            @if($buku->gambar)
                                <img src="{{ asset('uploads/images/' . $buku->gambar) }}" alt="{{ $buku->judul }}"
                                    style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
                            @endif
                            <input type="file" class="form-control-file" id="gambar" name="gambar">
                        </div>
                        <div class="form-group mb-3">
                            <label for="kategori_id">Kategori</label>
                            <select class="form-control" id="kategori_id" name="kategori_id">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoriBukus as $kategoriBuku)
                                    <option value="{{ $kategoriBuku->kategori_id }}" {{ $buku->kategori_id == $kategoriBuku->kategori_id ? 'selected' : '' }}>
                                        {{ $kategoriBuku->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $buku->penerbit }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="sinopsis">Sinopsis Buku</label>
                            <textarea class="form-control" id="sinopsis" name="sinopsis" rows="5">{{ $buku->sinopsis }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tahun_terbit">Tahun Terbit</label>
                            <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" value="{{ $buku->tahun_terbit }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="stok">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" value="{{ $buku->stok }}">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
