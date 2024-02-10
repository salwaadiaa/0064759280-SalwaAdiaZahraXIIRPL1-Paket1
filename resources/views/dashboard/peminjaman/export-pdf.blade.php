<!-- export-pdf.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman - Export PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            overflow: hidden;
            word-wrap: break-word;
            max-width: 200px;
        }

        th {
            background-color: #f2f2f2;
        }

        .denda-column {
            color: red;
        }
    </style>
</head>
<body>
    <h2>Riwayat Peminjaman - Export PDF</h2>

    <p>Tanggal Filter: {{ $startDate ?? 'Semua' }} - {{ $endDate ?? 'Semua' }}</p>

    <table>
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
            @forelse ($peminjamans as $peminjaman)
                <tr class="status-row">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peminjaman->user->email }}</td>
                    <td>{{ $peminjaman->user->name }}</td>
                    <td>{{ $peminjaman->buku->judul }}</td>
                    <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                    <td>{{ $peminjaman->tanggal_pengembalian }}</td>
                    <td class="denda-column">Rp. {{ number_format($peminjaman->denda, 0, ',', '.') }}</td>
                    <td>{{ $peminjaman->status_peminjaman }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Tidak ada data peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var today = new Date();

            document.querySelectorAll('.status-row').forEach(function (row) {
                var returnDate = new Date(row.querySelector('td:nth-child(6)').innerText);
                var lateDays = Math.max(0, Math.floor((today - returnDate) / (24 * 60 * 60 * 1000)));
                var denda = lateDays * 10000;

                var formattedDenda = 'Rp. ' + numberFormat(denda);

                var dendaColumn = row.querySelector('.denda-column');
                dendaColumn.innerText = formattedDenda;

                if (lateDays > 0) {
                    // Tampilkan denda jika ada keterlambatan
                    dendaColumn.style.display = 'table-cell';
                }
            });

            function numberFormat(value) {
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
        });
    </script>
</body>
</html>
