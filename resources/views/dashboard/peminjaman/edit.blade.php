@extends('layouts.app')

@section('title', 'Edit Tanggal Pengembalian')

@section('title-header', 'Edit Tanggal Pengembalian - ' . $peminjaman->user->name)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('peminjaman.index') }}">Data Peminjaman</a></li>
    <li class="breadcrumb-item active">Edit Tanggal Pengembalian - {{ $peminjaman->user->name }}</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">Edit Tanggal Pengembalian</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('peminjaman.update', $peminjaman->peminjaman_id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="tanggal_pengembalian" class="col-md-4 col-form-label text-md-right">Tanggal Pengembalian</label>

                            <div class="col-md-6">
                                <input id="tanggal_pengembalian" type="date" class="form-control @error('tanggal_pengembalian') is-invalid @enderror" name="tanggal_pengembalian" value="{{ old('tanggal_pengembalian', $peminjaman->tanggal_pengembalian) }}" required autofocus>

                                @error('tanggal_pengembalian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection