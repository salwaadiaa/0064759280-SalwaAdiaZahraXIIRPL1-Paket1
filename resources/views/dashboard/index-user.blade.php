@extends('layouts.app')

@section('title', 'Dashboard User')

@section('title-header', 'Dashboard User')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard User</li>
@endsection

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
                                    <div class="card" style="width: 100%;"> 
                                        <img src="{{ asset('uploads/images/' . $peminjaman->buku->gambar) }}" alt="{{ $peminjaman->buku->judul }}" class="card-img-top" style="width: 100%; height: 180px; object-fit: cover;"> 
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
            var isLate = false; // Menyimpan status keterlambatan

            document.querySelectorAll('.card').forEach(function (card) {
                var returnDateText = card.querySelector('.card-text').innerText; // Mengubah dari '.return-date' ke '.card-text'
                var returnDate = new Date(returnDateText);
                var lateDays = Math.max(0, Math.floor((today - returnDate) / (24 * 60 * 60 * 1000)));
                var denda = lateDays * 10000;

                var formattedDenda = 'Rp. ' + numberFormat(denda);

                var dendaColumn = card.querySelector('.denda-column');

                // Tampilkan nilai denda
                dendaColumn.innerText = 'Denda: ' + formattedDenda;
                dendaColumn.style.display = 'block';

                // Ubah nilai denda menjadi 0 jika tidak ada keterlambatan
                if (lateDays === 0) {
                    dendaColumn.innerText = 'Denda: Rp. 0';
                }

                // Tambahkan warna merah jika ada denda
                if (denda > 0) {
                    dendaColumn.style.color = 'red';
                    isLate = true; // Setel status keterlambatan menjadi true jika ada denda
                }
            });

            // Tampilkan SweetAlert2 jika ada keterlambatan
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
