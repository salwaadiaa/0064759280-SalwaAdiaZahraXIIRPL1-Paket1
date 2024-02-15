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
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Buku</h5>
                        <i class="fas fa-book fa-4x mb-3" style="color: #C0A183;"></i>
                        <p class="card-text">{{ $totalBuku }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Kategori Buku</h5>
                        <i class="fas fa-bookmark fa-4x mb-3" style="color: #C0A183;"></i>
                        <p class="card-text">{{ $totalKategoriBuku }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Total Peminjaman</h5>
                        <div style="height: 400px; width: 100%;">
                            <canvas id="peminjamanChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data total peminjaman per tanggal
        var dataPerTanggal = {!! $peminjamanPerTanggal !!};

        // Inisialisasi canvas chart
        var ctx = document.getElementById('peminjamanChart').getContext('2d');

        // Buat array untuk label tanggal dan data peminjaman
        var labels = [];
        var data = [];

        // Loop melalui data per tanggal untuk mengisi label tanggal dan data peminjaman
        for (var i = 0; i < dataPerTanggal.length; i++) {
            labels.push(dataPerTanggal[i].tanggal);
            data.push(dataPerTanggal[i].total);
        }

        // Buat grafik garis
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
