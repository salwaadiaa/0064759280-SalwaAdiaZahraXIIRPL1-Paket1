<!-- resources/views/dashboard/peminjaman/index.blade.php -->
<style>
    /* Tambahkan CSS berikut untuk memperbagus tampilan filter status */
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
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Daftar Peminjaman</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Daftar Peminjaman</h2>
                    <div class="mb-3">
                    <label for="statusFilter" class="form-label">Filter Status:</label>
                        <select id="statusFilter" class="form-select">
                            <option value="">Semua</option>
                            <option value="Diajukan">Diajukan</option>
                            <option value="Dipinjam">Dipinjam</option>
                            <option value="Sudah Kembali">Sudah Kembali</option>
                        </select>

                        <button id="download-pdf" class="btn btn-danger pdf-button">
                            <i class="fas fa-file-pdf"></i> PDF
                        </button>
                    </div>

                    <!-- Tombol Export PDF -->
                    <!-- <a href="{{ route('peminjaman.exportPdf') }}" id="exportPdf" class="btn btn-primary btn-sm" target="_blank">Export PDF</a> -->
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
                                    <th>Status</th>
                                    <th>Aksi</th>
                                    
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
                                        <td>{{ $peminjaman->status_peminjaman }}</td>
                                        <td>
                                            @if($peminjaman->status_peminjaman == 'Diajukan')
                                                <form id="approve-form-{{ $peminjaman->peminjaman_id }}" action="{{ route('peminjaman.approve', $peminjaman->peminjaman_id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button" class="btn btn-success" onclick="confirmApproval('{{ $peminjaman->peminjaman_id }}')">Setujui</button>
                                                </form>
                                                <form id="reject-form-{{ $peminjaman->peminjaman_id }}" action="{{ route('peminjaman.reject', $peminjaman->peminjaman_id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button" class="btn btn-danger" onclick="confirmRejection('{{ $peminjaman->peminjaman_id }}')">Tolak</button>
                                                </form>
                                            @elseif($peminjaman->status_peminjaman == 'Dipinjam')
                                                <form id="return-form-{{ $peminjaman->peminjaman_id }}" action="{{ route('peminjaman.return', $peminjaman->peminjaman_id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button" class="btn btn-primary" onclick="confirmReturn('{{ $peminjaman->peminjaman_id }}')">Selesai</button>
                                                </form>
                                                <!-- Tombol untuk proses pengembalian -->
                                                <p>Denda: Rp {{ number_format($peminjaman->denda) }}</p>
                                            @endif
                                        </td>
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

        function confirmApproval(peminjaman_id) {
            Swal.fire({
                title: 'Konfirmasi Setujui Peminjaman',
                text: 'Apakah Anda yakin ingin menyetujui peminjaman?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, setujui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, kirimkan formulir persetujuan
                    $(`#approve-form-${peminjaman_id}`).submit();
                }
            });
        }

        function confirmRejection(peminjaman_id) {
            Swal.fire({
                title: 'Konfirmasi Menolak Peminjaman',
                text: 'Apakah Anda yakin ingin menolak peminjaman?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, tolak!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, kirimkan formulir penolakan
                    $(`#reject-form-${peminjaman_id}`).submit();
                }
            });
        }

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

            // Event Listener untuk Export PDF
            document.getElementById('exportPdf').addEventListener('click', function () {
                var statusFilter = document.getElementById('statusFilter').value;
                var url = '{{ route("peminjaman.exportPdf") }}';

                if (statusFilter !== '') {
                    url += '?status=' + statusFilter;
                }

                window.open(url, '_blank');
            });
        });
    </script>
@endsection
