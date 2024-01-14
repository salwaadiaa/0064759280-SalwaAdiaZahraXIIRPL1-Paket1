@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('title-header', 'Daftar Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Daftar Buku</li>
@endsection

@section('content')
<style>
    /* Gaya CSS langsung disini */
    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }

    .card img {
        max-width: 100%;
        height: 170px; /* Atur tinggi gambar sesuai kebutuhan Anda */
        object-fit: cover; /* Memastikan gambar terisi di area yang telah ditentukan */
    }

    .card-title {
        font-size: 1.2rem;
        margin-bottom: 10px;
        text-align: center;
    }

    .card-text {
        font-size: 1rem;
        margin-bottom: 8px;
    }

    .btn-success {
        background-color: #28a745;
        color: #fff;
        width: 100%;
    }

    .filter-container {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .filter-heading {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .form-select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
    }

    /* Highlight selected option */
    .form-select option:checked {
        background-color: #007bff;
        color: #fff;
    }

    /* Style for options */
    .form-select option {
        background-color: #fff;
        color: #495057;
    }

    /* Hover effect on options */
    .form-select option:hover {
        background-color: #e9ecef;
        color: #495057;
    }
</style>

<div class="row">
    <div class="col-md-3">
        <div class="filter-container">
            <h2 class="filter-heading">Filter Kategori</h2>
            <form action="{{ route('user.buku.index') }}" method="GET">
                <div class="input-group">
                    <select class="form-select" name="kategori_id" onchange="this.form.submit()">
                        <option value="" {{ !$kategori_id ? 'selected' : '' }}>Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->kategori_id }}" {{ $kategori_id == $kategori->kategori_id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <form class="d-flex" action="{{ route('user.buku.index') }}" method="GET">
                    <input class="form-control me-2" type="text" name="search" placeholder="Cari buku...">
                    <button class="btn btn-outline-primary" type="submit">Cari</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-transparent border-0 text-dark">
                        <h2 class="card-title h3">Daftar Buku</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse ($bukus as $buku)
                                <div class="col-md-4 mb-4">
                                    <div class="card shadow">
                                        @if($buku->gambar)
                                            <img src="{{ asset('uploads/images/' . $buku->gambar) }}" class="card-img-top" alt="{{ $buku->judul }}">
                                        @else
                                            <img src="{{ asset('uploads/images/no-image.jpg') }}" class="card-img-top" alt="No Image">
                                        @endif
                                        <!-- <div class="card-header bg-transparent border-0 text-dark">
                                            <h5 class="card-title">{{ $buku->judul }}</h5>
                                        </div> -->
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $buku->judul }}</h5>
                                            <p class="card-text">Penulis: {{ $buku->penulis }}</p>
                                            <p class="card-text">Penerbit: {{ $buku->penerbit }}</p>
                                            <p class="card-text">Tahun Terbit: {{ $buku->tahun_terbit }}</p>

                                            @if ($buku->kategoriBuku)
                                                <p class="card-text">Kategori: {{ $buku->kategoriBuku->nama_kategori }}</p>
                                            @endif

                                            <form action="{{ route('buku.ajukan-peminjaman', $buku->buku_id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success mb-2">Ajukan Peminjaman</button>
                                            </form>

                                            <!-- Tombol "Tambah ke Koleksi Saya" dan Modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addToCollectionModal{{ $buku->id }}">
                                                Tambahkan ke Koleksi Saya
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="addToCollectionModal{{ $buku->id }}" tabindex="-1" role="dialog" aria-labelledby="addToCollectionModalLabel{{ $buku->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addToCollectionModalLabel{{ $buku->id }}">Tambahkan ke Koleksi Saya</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Isi modal sesuai kebutuhan, misalnya form tambahan -->
                                                            <!-- Contoh: -->
                                                            <form action="{{ route('buku.tambah-ke-koleksi', $buku->buku_id) }}" method="POST">
                                                                @csrf
                                                                <!-- Tambahkan input atau elemen form lainnya di sini -->
                                                                <button type="submit" class="btn btn-primary">Tambahkan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p>Tidak ada data buku.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function submitForm() {
        document.getElementById("kategoriFilterForm").submit();
    }
</script>

@endsection
