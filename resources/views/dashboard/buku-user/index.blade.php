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

    .centered-link {
        text-align: center;
    }

    /* Flexbox untuk menyamakan tinggi card */
    .d-flex.align-items-stretch {
        display: flex;
    }

    .d-flex.align-items-stretch > .col-md-4 {
        flex: 1;
        margin-right: 15px; /* Sesuaikan dengan kebutuhan Anda */
    }
    .btn-custom {
        background-color: #C0A183;
        /* Tambahkan properti CSS lain sesuai kebutuhan Anda */
    }
</style>

<div class="row d-flex align-items-stretch">
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
                    <button class="btn btn-outline-white" type="submit">Cari</button>
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
                        <div class="card-body">
                            <h5 class="card-title">{{ $buku->judul }}</h5>
                            <!-- <p class="card-text">Penulis: {{ $buku->penulis }}</p>
                            <p class="card-text">Penerbit: {{ $buku->penerbit }}</p>
                            <p class="card-text">Tahun Terbit: {{ $buku->tahun_terbit }}</p>

                            @if ($buku->kategoriBuku)
                                <p class="card-text">Kategori: {{ $buku->kategoriBuku->nama_kategori }}</p>
                            @endif -->

                            <div class="d-flex justify-content-center mt-2">
                                <form action="{{ route('buku.ajukan-peminjaman', $buku->buku_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-custom mx-1">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                <button type="button" class="btn btn-custom mx-2" data-toggle="modal" data-target="#detailBukuModal{{ $buku->buku_id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail Buku -->
                <div class="modal fade" id="detailBukuModal{{ $buku->buku_id }}" tabindex="-1" role="dialog" aria-labelledby="detailBukuModalLabel{{ $buku->buku_id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailBukuModalLabel{{ $buku->id }}">Detail Buku - {{ $buku->judul }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center mb-3">
                                    <img src="{{ asset('uploads/images/' . $buku->gambar) }}" class="img-fluid rounded" alt="{{ $buku->judul }}">
                                </div>
                                <div>
                                    <h5>Deskripsi Buku</h5>
                                    <p><strong>Judul:</strong> {{ $buku->judul }}</p>
                                    <p><strong>Penulis:</strong> {{ $buku->penulis }}</p>
                                    <p><strong>Penerbit:</strong> {{ $buku->penerbit }}</p>
                                    <p><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}</p>

                                    @if ($buku->kategoriBuku)
                                        <p><strong>Kategori:</strong> {{ $buku->kategoriBuku->nama_kategori }}</p>
                                    @endif
                                </div>

                                <!-- Tombol untuk menampilkan ulasan -->
                                <div class="centered-link mt-3">
                                    <a href="javascript:void(0);" class="btn btn-link" onclick="showUlasan('{{ $buku->buku_id }}')">Lihat Ulasan Buku</a>
                                </div>

                                <!-- Bagian untuk menampilkan ulasan (awalnya disembunyikan) -->
                                <div id="ulasanContainer{{ $buku->buku_id }}" style="display: none;">
                                    <h5 class="mt-4">Ulasan Buku</h5>
                                    @forelse ($buku->ulasans as $ulasan)
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center">
                                                <p class="mb-0"><strong>{{ $ulasan->user->name }}</strong></p>|
                                                {!! str_repeat('<i class="fa fa-star"></i>', $ulasan->rating) !!}
                                            </div>
                                            <p>{{ $ulasan->ulasan }}</p>
                                        </div>
                                    @empty
                                        <p>Tidak ada ulasan untuk buku ini.</p>
                                    @endforelse
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

<script>
    function submitForm() {
        document.getElementById("kategoriFilterForm").submit();
    }

    function showUlasan(bukuId) {
    console.log('showUlasan called with bukuId:', bukuId);

    // Menyembunyikan tombol setelah diklik
    document.querySelector('#detailBukuModal' + bukuId + ' .btn-link').style.display = 'none';
    // Menampilkan container ulasan setelah tombol diklik
    document.getElementById('ulasanContainer' + bukuId).style.display = 'block';
}

</script>

@endsection
