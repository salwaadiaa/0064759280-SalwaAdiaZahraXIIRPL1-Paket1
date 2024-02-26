@extends('layouts.app')

@section('title', 'Ulas Buku')

@section('title-header', 'Ulas Buku: ' . $buku->judul)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('ulasan.index') }}">Riwayat Buku Dapat Diulas</a></li>
    <li class="breadcrumb-item active">Ulas Buku</li>
@endsection

<style>
    .rating {
        display: inline-block;
    }

    .rating input {
        display: none;
    }

    .rating label {
        font-size: 30px;
        color: #ccc;
        cursor: pointer;
    }

    .rating label:before {
        content: '\2605';
    }

    .rating input:checked ~ label {
        color: #ffcc00; 
    }
</style>


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header bg-transparent border-0 text-dark">
                <h2 class="card-title h3">Ulas Buku: {{ $buku->judul }}</h2>
                <form action="{{ route('ulasan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="buku_id" value="{{ $buku->buku_id }}">
                    <div class="form-group mb-3">
                        <label for="ulasan">Ulasan</label>
                        <textarea name="ulasan" id="ulasan" class="form-control @error('ulasan') is-invalid @enderror" required></textarea>
                        @error('ulasan')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="rating">Rating</label> <br>
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 stars"></label>
                            <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 stars"></label>
                            <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 stars"></label>
                            <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 stars"></label>
                            <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 stars"></label>
                        </div>
                        @error('rating')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Kirim Ulasan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

