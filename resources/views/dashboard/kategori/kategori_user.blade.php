@extends('layouts.app')

@section('title', 'Kategori Buku')

@section('title-header', 'Kategori Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kategori Buku</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Kategori Buku</h2>
                    <div class="list-group">
                        @foreach($kategoris as $kategori)
                            <a href="{{ route('user.buku.index', ['kategori_id' => $kategori->kategori_id]) }}" class="list-group-item list-group-item-action">{{ $kategori->nama_kategori }}</a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
