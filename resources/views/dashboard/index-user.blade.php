@extends('layouts.app')

@section('title', 'Dashboard User')

@section('title-header', 'Dashboard User')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard User</li>
@endsection

<style>
     .buku-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        height: 550px; 
    }

    .buku-card img {
        max-width: 100%;
        height: 370px;
        object-fit: cover;
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
</style>

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card text-center">
                    <div class="card-body">
                        <h1 class="card-subtitle mb-3 custom-font">Daftar buku yang sedang dipinjam</h1> <br>
                        @if($peminjamans->isEmpty())
                            <p>Anda belum meminajm buku</p>
                        @else
                        <div class="row">
                            @foreach($peminjamans as $peminjaman)
                                <div class="col-md-3 mb-3"> 
                                    <div class="buku-card" style="width: 100%; "> 
                                        <img src="{{ asset('uploads/images/' . $peminjaman->buku->gambar) }}" alt="{{ $peminjaman->buku->judul }}" class="card-img-top" style="width: 100%; height: 370px; object-fit: cover;"> 
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $peminjaman->buku->judul }}</h5>
                                            <p class="card-text">Return Date: {{ $peminjaman->tanggal_pengembalian }}</p>
                                            @if($peminjaman->denda > 0)
                                                <p class="denda-column" style="color: red;">Denda: <span class="denda-column">Rp. {{ number_format($peminjaman->denda, 0, ',', '.') }}</span></p>
                                            @else
                                                <p class="denda-column">Denda: <span class="denda-column">Rp. {{ number_format($peminjaman->denda, 0, ',', '.') }}</span></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent
     <script>
        document.addEventListener('DOMContentLoaded', function () {
            var today = new Date();
            var isLate = false; 

            document.querySelectorAll('.card').forEach(function (card) {
                var returnDateText = card.querySelector('.card-text').innerText; 
                var returnDate = new Date(returnDateText);
                var lateDays = Math.max(0, Math.floor((today - returnDate) / (24 * 60 * 60 * 1000)));
                var denda = lateDays * 10000;

                var formattedDenda = 'Rp. ' + numberFormat(denda);

                var dendaColumn = card.querySelector('.denda-column');

                dendaColumn.innerText = 'Denda: ' + formattedDenda;
                dendaColumn.style.display = 'block';

                if (lateDays === 0) {
                    dendaColumn.innerText = 'Denda: Rp. 0';
                }

                if (denda > 0) {
                    dendaColumn.style.color = 'red';
                    isLate = true; 
                }
            });

            if (isLate) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Keterlambatan Mengembalikan Buku',
                    text: 'Anda terlambat mengembalikan buku. Silakan cek pada halaman dashboard ini.'
                });
            }
        });

        function numberFormat(value) {
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
    </script>
@endsection
