@extends('layouts.app')

@section('title', 'Dashboard Admin & Petugas')

@section('title-header', 'Dashboard Admin & Petugas')
@section('breadcrumb')
    @if (Auth::user()->role == 'admin')
        <li class="breadcrumb-item active">Dashboard Admin</li>
    @endif
    @if (Auth::user()->role == 'petugas')
        <li class="breadcrumb-item active">Dashboard Petugas</li>
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <a href="{{ route('buku.index') }}">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Buku</h5>
                            <i class="fas fa-book fa-4x mb-3" style="color: #C0A183;"></i>
                            <p class="card-text">{{ $totalBuku }}</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-md-6">
                <a href="{{ route('kategori.admin') }}">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Kategori Buku</h5>
                            <i class="fas fa-bookmark fa-4x mb-3" style="color: #C0A183;"></i>
                            <p class="card-text">{{ $totalKategoriBuku }}</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-md-6">
                <a href="{{ route('peminjaman.selesai') }}">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Denda</h5>
                            <i class="fas fa-money-bill fa-4x mb-3" style="color: #C0A183;"></i>
                            <p class="card-text">Rp. {{ number_format($totalDenda, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-md-6">
                <a href="{{ route('ulasan.admin') }}">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Ulasan</h5>
                            <i class="fas fa-star fa-4x mb-3" style="color: #C0A183;"></i>
                            <p class="card-text">{{ $jumlahUlasan }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @if (Auth::user()->role == 'admin')
                <div class="col-lg-12">
                    <a href="{{ route('peminjaman.index') }}">
                        <div class="card mt-4">
                            <div class="card-body">
                                <h5 class="card-title">Total Peminjaman</h5>
                                <div style="height: 400px; width: 100%;">
                                    <canvas id="peminjamanChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data total peminjaman per tanggal
        var dataPerTanggal = {!! $peminjamanPerTanggal !!};

        var ctx = document.getElementById('peminjamanChart').getContext('2d');

        var labels = [];
        var data = [];

        for (var i = 0; i < dataPerTanggal.length; i++) {
            labels.push(dataPerTanggal[i].tanggal);
            data.push(dataPerTanggal[i].total);
        }

        var peminjamanChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Peminjaman',
                    data: data,
                    backgroundColor: '#E0D7C8',
                    borderColor: '#C0A183',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
