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
    background-color: #FF0000;
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

@section('title', 'Daftar Peminjaman')

@section('title-header', 'Daftar Peminjaman')
@section('breadcrumb')
@if (Auth::user()->role == 'admin')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard Admin</a></li>
    <li class="breadcrumb-item active">Daftar Peminjaman</li>
@endif
@if (Auth::user()->role == 'petugas')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard Petugas</a></li>
    <li class="breadcrumb-item active">Daftar Peminjaman</li>
@endif
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Daftar Peminjaman</h2>
                    <div class="mb-3">
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
                                    <th id="dendaColumn">Denda</th>
                                    <th>Status</th>
                                    @if (Auth::user()->role == 'petugas')
                                    <th>Aksi</th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($peminjamans as $peminjaman)
                                <tr class="status-row" data-status="{{ $peminjaman->status_peminjaman }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $peminjaman->user->email }}</td>
                                    <td>{{ $peminjaman->user->name }}</td>
                                    <td>{{ $peminjaman->buku->judul }}</td>
                                    <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                                    <td>{{ $peminjaman->tanggal_pengembalian }}</td>
                                    <td class="denda-column" style="display: none;">>Rp. {{ number_format($peminjaman->denda, 0, ',', '.') }}</td>
                                    <td>{{ $peminjaman->status_peminjaman }}</td>
                                    @if (Auth::user()->role == 'petugas')
                                    <td>
                                        @if($peminjaman->status_peminjaman == 'Dipinjam')
                                            <form id="return-form-{{ $peminjaman->peminjaman_id }}" action="{{ route('peminjaman.return', $peminjaman->peminjaman_id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="button" class="btn btn-primary" onclick="confirmReturn('{{ $peminjaman->peminjaman_id }}')">Selesai</button>
                                            </form>
                                            {{-- <div class="denda-column" style="display: none;">Rp. {{ number_format($peminjaman->denda, 0, ',', '.') }}</div> --}}
                            @endif
                                    </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Tidak ada data peminjaman.</td>
                                </tr>
                            @endforelse
                        </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script>

        $(document).ready(function() {
            $('#download-pdf').click(function() {
                var selectedStatus = $('#statusFilter').val();
                window.location.href = '/peminjaman/exportPdf?status=' + selectedStatus;
            });
        });

        function confirmReturn(peminjaman_id) {
            Swal.fire({
                title: 'Konfirmasi Pengembalian',
                text: 'Apakah buku sudah dikembalikan?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, sudah dikembalikan!',
                cancelButtonText: 'Belum'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, kirimkan formulir pengembalian
                    $(`#return-form-${peminjaman_id}`).submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Event Listener untuk Filter Status
            document.getElementById('statusFilter').addEventListener('change', function () {
                var selectedStatus = this.value;
                var tableRows = document.querySelectorAll('.status-row');

                tableRows.forEach(function (row) {
                    if (selectedStatus === '' || row.getAttribute('data-status') === selectedStatus) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });


        });
    </script>
     <script>
      document.addEventListener('DOMContentLoaded', function () {
    var today = new Date();

    document.querySelectorAll('.status-row').forEach(function (row) {
        var returnDate = new Date(row.querySelector('td:nth-child(6)').innerText);
        var lateDays = Math.max(0, Math.floor((today - returnDate) / (24 * 60 * 60 * 1000)));
        var denda = lateDays * 10000;

        var formattedDenda = 'Rp. ' + numberFormat(denda);

        var dendaColumn = row.querySelector('.denda-column');

        // Tampilkan nilai denda, bahkan jika tidak ada keterlambatan (nilai denda = 0)
        dendaColumn.innerText = formattedDenda;
        dendaColumn.style.display = 'table-cell';

        // Ubah nilai denda menjadi 0 jika tidak ada keterlambatan
        if (lateDays === 0) {
            dendaColumn.innerText = 'Rp. 0';
        }

        var peminjamanId = row.dataset.peminjamanId;
        calculateDendaOnServer(peminjamanId);
    });

    function calculateDendaOnServer(peminjamanId) {
        // Lakukan pemanggilan AJAX ke server untuk menghitung dan menyimpan denda
        $.ajax({
            type: 'POST',
            url: 'peminjaman/calculate-denda', // Sesuaikan dengan URL endpoint yang kamu miliki
            data: {
                peminjaman_id: peminjamanId,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                console.log('Denda berhasil dihitung dan disimpan di server');
            },
            error: function (error) {
                console.error('Gagal menghitung dan menyimpan denda di server:', error);
            }
        });
    }

    function numberFormat(value) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }
});

    </script>
@endsection
