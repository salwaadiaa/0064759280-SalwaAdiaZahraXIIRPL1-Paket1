<style>
.form-label {
    margin-right: 10px;
}

.form-select {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
}

.btn {
    cursor: pointer;
}

.pdf-button {
    background-color: #B31312;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
}

.pdf-button i {
    margin-right: 5px;
}
</style>


@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')

@section('title-header', 'Riwayat Peminjaman')
@section('breadcrumb')
@if (Auth::user()->role == 'admin')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard Admin</a></li>
    <li class="breadcrumb-item active">Riwayat Peminjaman</li>
@endif
@if (Auth::user()->role == 'petugas')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard Petugas</a></li>
    <li class="breadcrumb-item active">Riwayat Peminjaman</li>
@endif
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header bg-transparent border-0 text-dark d-flex justify-content-between align-items-center">
                <h2 class="card-title h3">Daftar Peminjaman</h2>
                <div class="ml-auto">
                    @if (Auth::user()->role == 'admin')
                        <button class="pdf-button" id="exportPdfBtn">
                            <i class="fas fa-file-pdf"></i> PDF
                        </button>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date:</label>
                    <input type="date" id="start_date" class="form-select">
                    <label for="end_date" class="form-label">End Date:</label>
                    <input type="date" id="end_date" class="form-select">
                    <button style="background-color: #C0A183; " class="btn" id="filterBtn">Filter</button>
                </div>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email Peminjam</th>
                                    <th>Nama Peminjam</th>
                                    <th>Buku</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Denda</th>
                                    <th>Status</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($peminjamanSelesai as $peminjaman)
                                <tr class="status-row" data-status="{{ $peminjaman->tanggal_peminjaman }}">
                                    <td>{{ ($peminjamanSelesai->currentPage() - 1) * $peminjamanSelesai->perPage() + $loop->index + 1 }}</td>
                                    <td>{{ $peminjaman->user->email }}</td>
                                    <td>{{ $peminjaman->user->name }}</td>
                                    <td>{{ $peminjaman->buku->judul }}</td>
                                    <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                                    <td>{{ $peminjaman->tanggal_pengembalian }}</td>
                                    <td>Rp. {{ number_format($peminjaman->denda, 0, ',', '.') }}</td>
                                    <td>{{ $peminjaman->status_peminjaman }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Tidak ada data peminjaman.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                @if($peminjamanSelesai->currentPage() > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $peminjamanSelesai->previousPageUrl() }}" tabindex="-1">Previous</a>
                                    </li>
                                @endif

                                @for ($i = max(1, $peminjamanSelesai->currentPage() - 2); $i <= min($peminjamanSelesai->currentPage() + 2, $peminjamanSelesai->lastPage()); $i++)
                                    <li class="page-item {{ ($i == $peminjamanSelesai->currentPage()) ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $peminjamanSelesai->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if($peminjamanSelesai->currentPage() < $peminjamanSelesai->lastPage())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $peminjamanSelesai->nextPageUrl() }}">Next</a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
@endsection

@section('script')
    @parent
    
    <script>
            var filterBtn = document.getElementById('filterBtn');
            filterBtn.addEventListener('click', function () {
                var startDate = new Date(document.getElementById('start_date').value);
                var endDate = new Date(document.getElementById('end_date').value);

                document.querySelectorAll('.status-row').forEach(function (row) {
                    var tanggalPeminjaman = new Date(row.querySelector('td:nth-child(5)').innerText);

                    if ((isNaN(startDate) || tanggalPeminjaman >= startDate) &&
                        (isNaN(endDate) || tanggalPeminjaman <= endDate)) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Logika ekspor PDF
            var exportPdfBtn = document.getElementById('exportPdfBtn');
            exportPdfBtn.addEventListener('click', function () {
                var startDate = document.getElementById('start_date').value;
                var endDate = document.getElementById('end_date').value;

                // Handle kasus di mana tanggal awal atau tanggal akhir kosong
                if (!startDate && !endDate) {
                    window.location.href = "/peminjaman/exportPdf";
                } else {
                    var url = "/peminjaman/exportPdf?startDate=" + startDate + "&endDate=" + endDate;
                    window.location.href = url;
                }
            });
    </script>
@endsection
