@extends('layouts.app')

@section('title', 'Edit Kategori Buku')

@section('title-header', 'Edit Kategori Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('kategori.admin') }}">Daftar Kategori Buku</a></li>
    <li class="breadcrumb-item active">Edit Kategori Buku</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Edit Kategori Buku</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('kategori.update', ['kategori_id' => $kategori->kategori_id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="kategori_id">ID Kategori</label>
                            <input type="text" class="form-control" id="kategori_id" name="kategori_id" value="{{ $kategori->kategori_id }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
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
