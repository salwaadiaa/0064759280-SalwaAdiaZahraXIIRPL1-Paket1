@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('title-header', 'Daftar Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Daftar Buku</li>
@endsection

@section('content')
<style>
    .buku-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    min-height: 550px;
    }

    @media (max-width: 768px) {
        .buku-card {
            min-height: auto;
        }
    }

    .buku-card img {
        width: 100%;
        height: 370px; 
    }

    .buku-card .card-title {
        font-size: 1.2rem;
        margin-bottom: 10px;
        text-align: center;
    }

    .buku-card .card-text {
        font-size: 1rem;
        margin-bottom: 8px;
    }

    .buku-card .card-body {
        min-height: 140px;
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

    .form-select option:checked {
        background-color: #007bff;
        color: #fff;
    }

    .form-select option {
        background-color: #fff;
        color: #495057;
    }

    .form-select option:hover {
        background-color: #e9ecef;
        color: #495057;
    }

    .centered-link {
        text-align: center;
    }

    .d-flex.align-items-stretch {
        display: flex;
    }

    .d-flex.align-items-stretch > .col-md-4 {
        flex: 1;
        margin-right: 15px;
    }

    .rating {
        display: flex;
        justify-content: center;
    }

    .card-body {
        min-height: 140px; 
    }

    .btn-custom {
        background-color: #C0A183;
    }

    .best-seller {
        position: absolute;
        top: 25px;
        right: 5px; 
        transform: rotate(40deg);
        background-color: #28a745;
        color: #fff;
        padding: 10px 15px;
        border-radius: 5px;
        z-index: ;
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
                    <input class="form-control me-2" type="text" name="search" placeholder="Cari buku berdasarkan judul...">
                    <button class="btn btn-outline-white" type="submit">Cari</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-transparent border-0 text-dark">
                        <h2 class="text-center card-title h3">Daftar Buku</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if ($bukus->isEmpty())
                                <div class="col-12">
                                    <p class="text-center">Tidak ada buku untuk kategori ini.</p>
                                </div>
                            @else
                                @foreach ($bukus as $buku)
                                    <div class="col-md-4 mb-4">
                                        <div class="card shadow buku-card {{ $buku->stok == 0 ? 'border-danger' : '' }}">
                                            <div class="position-relative">
                                                @if ($buku->jumlah_ulasan >= 3)
                                                    <span class="badge badge-success best-seller">Favorite</span>
                                                @endif
                                                @if($buku->gambar)
                                                    <img src="{{ asset('uploads/images/' . $buku->gambar) }}" class="card-img-top" alt="{{ $buku->judul }}">
                                                @else
                                                    <img src="{{ asset('uploads/images/no-image.jpg') }}" class="card-img-top" alt="No Image">
                                                @endif
                                            </div>
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <h5 class="card-title">{{ $buku->judul }}</h5>
                                                <div class="text-center rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $buku->rating_rata_rata)
                                                            <i class="fas fa-star"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div> 
                                                @if ($buku->stok > 0)
                                                    <div class="d-flex justify-content-center mt-2">
                                                        <form action="{{ route('buku.ajukan-peminjaman', $buku->buku_id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-custom mx-1"><i class="fas fa-check"></i></button>
                                                        </form>
                                                        <button type="button" class="btn btn-custom mx-2" data-toggle="modal" data-target="#detailBukuModal{{ $buku->buku_id }}"><i class="fas fa-eye"></i></button>
                                                    </div>
                                                @else
                                                    <div class="text-center mt-2" style="background-color: #7D0A0A;">
                                                        Stok Buku Habis
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                @if($bukus->currentPage() > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $bukus->previousPageUrl() }}" tabindex="-1">Previous</a>
                                    </li>
                                @endif

                                @for ($i = max(1, $bukus->currentPage() - 2); $i <= min($bukus->currentPage() + 2, $bukus->lastPage()); $i++)
                                    <li class="page-item {{ ($i == $bukus->currentPage()) ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $bukus->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if($bukus->currentPage() < $bukus->lastPage())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $bukus->nextPageUrl() }}">Next</a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($bukus as $buku)
    <div class="modal fade" id="detailBukuModal{{ $buku->buku_id }}" tabindex="-1" role="dialog" aria-labelledby="detailBukuModalLabel{{ $buku->buku_id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailBukuModalLabel{{ $buku->buku_id }}">Detail Buku - {{ $buku->judul }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center mb-3">
                                <img src="{{ asset('uploads/images/' . $buku->gambar) }}" class="img-fluid rounded" alt="{{ $buku->judul }}">
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-top: 55px;">
                            <div class="card mb-3 mx-3" style="margin-top: 55px;"> 
                                <div class="card-body">
                                    <p><strong>Judul:</strong> {{ $buku->judul }}</p>
                                    <p><strong>Penulis:</strong> {{ $buku->penulis }}</p>
                                    <p><strong>Penerbit:</strong> {{ $buku->penerbit }}</p>
                                    <p><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}</p>
                                    @if ($buku->kategoriBuku)
                                        <p><strong>Kategori:</strong> {{ $buku->kategoriBuku->nama_kategori }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h5 class="mt-4">Deskripsi</h5>
                        <div class="card mb-3">
                            <div class="card-body">
                                <p>{{ $buku->sinopsis }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="centered-link mt-3">
                        <a href="javascript:void(0);" class="btn btn-link" onclick="showUlasan('{{ $buku->buku_id }}')">Lihat Ulasan Buku</a>
                    </div>
                    <div id="ulasanContainer{{ $buku->buku_id }}" style="display: none;">
                        <h5 class="text-center mt-4">Ulasan Buku</h5>
                        @forelse ($buku->ulasans as $ulasan)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-0"><strong>{{ $ulasan->user->name }}</strong></p>
                                        <div>
                                            {!! str_repeat('<i class="fa fa-star"></i>', $ulasan->rating) !!}
                                        </div>
                                    </div>
                                    <hr>
                                    <p class="text-center mt-4">{{ $ulasan->ulasan }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">Tidak ada ulasan untuk buku ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    function showUlasan(bukuId) {
        console.log('showUlasan called with bukuId:', bukuId);

        document.querySelector('#detailBukuModal' + bukuId + ' .btn-link').style.display = 'none';
        document.getElementById('ulasanContainer' + bukuId).style.display = 'block';
    }
</script>

@endsection
