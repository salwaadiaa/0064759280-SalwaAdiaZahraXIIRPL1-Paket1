<!-- resources/views/dashboard/ulasan/ulasan_admin.blade.php -->
@extends('layouts.app')

@section('title', 'Riwayat Ulasan Buku')

@section('title-header', 'Riwayat Ulasan Buku - Admin')
@section('breadcrumb')
@if (Auth::user()->role == 'admin')
    <li class="breadcrumb-item"><a href="{{ route('ulasan.admin') }}">Dashboard Admin</a></li>
    <li class="breadcrumb-item active">Riwayat Ulasan Buku</li>
@endif
@if (Auth::user()->role == 'petugas')
    <li class="breadcrumb-item"><a href="{{ route('ulasan.admin') }}">Dashboard Petugas</a></li>
    <li class="breadcrumb-item active">Riwayat Ulasan Buku</li>
@endif
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header bg-transparent border-0 text-dark">
                <h2 class="card-title h3">Riwayat Ulasan Buku</h2>
                <form action="{{ route('ulasan.admin') }}" method="GET" class="input-group mb-3">
                    <div  class="col-md-10 align-self-center"> <!-- Tidak perlu menambahkan class col-md-8 di sini -->
                    <select class="judulBuku form-control" name="judul" style="max-height: 300px; width: 100%; padding-top: 8px;" id="judul-select">
                            <option value="">-- Pilih Judul Buku --</option>
                            @foreach ($listJudulBuku as $judulBuku)
                                <option value="{{ $judulBuku->judul }}" {{ request('judul') == $judulBuku->judul ? 'selected' : '' }}>
                                    {{ $judulBuku->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 align-self-center">
    <button type="submit" class="btn btn-custom btn-block" style="height: 38px;">Filter</button>
</div>
                </form>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Buku</th>
                                    <th>Ulasan</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ulasans as $ulasan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ulasan->user->name }}</td>
                                        <td>{{ $ulasan->buku->judul }}</td>
                                        <td>{{ $ulasan->ulasan }}</td>
                                        <td>{!! str_repeat('<i class="fa fa-star"></i>', $ulasan->rating) !!}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Tidak ada ulasan buku.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                @if($ulasans->currentPage() > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $ulasans->previousPageUrl() }}" tabindex="-1">Previous</a>
                                    </li>
                                @endif

                                @for ($i = max(1, $ulasans->currentPage() - 2); $i <= min($ulasans->currentPage() + 2, $ulasans->lastPage()); $i++)
                                    <li class="page-item {{ ($i == $ulasans->currentPage()) ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $ulasans->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if($ulasans->currentPage() < $ulasans->lastPage())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $ulasans->nextPageUrl() }}">Next</a>
                                    </li>
                                @endif
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.judulBuku').select2();
});
</script>
@endsection