<!-- resources/views/dashboard/peminjaman/export_pdf.blade.php -->
<h1>Daftar Peminjaman</h1>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Buku</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($peminjamans as $peminjaman)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $peminjaman->user->name }}</td>
                <td>{{ $peminjaman->buku->judul }}</td>
                <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                <td>{{ $peminjaman->tanggal_pengembalian }}</td>
                <td>{{ $peminjaman->status_peminjaman }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
