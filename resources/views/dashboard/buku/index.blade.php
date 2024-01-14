@extends('layouts.app')
@section('title', 'Daftar Buku')

@section('title-header', 'Daftar Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Daftar Buku</li>
@endsection

@if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
@section('action_btn')
    <a href="{{ route('buku.create') }}" class="btn btn-default">Tambah Buku</a>
@endsection
@endif

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Daftar Buku</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id Buku</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Kategori</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bukus as $buku)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $buku->buku_id }}</td>
                                        <td>{{ $buku->judul }}</td>
                                        <td>{{ $buku->penulis }}</td>
                                        <td>{{ $buku->penerbit }}</td>
                                        <td>{{ $buku->tahun_terbit }}</td>
                                        <td>{{ $buku->kategoriBuku->nama_kategori ?? '-' }}</td>
                                        <td>
                                        @if($buku->gambar)
                                            <img src="{{ asset('uploads/images/' . $buku->gambar) }}" alt="{{ $buku->judul }}" style="max-width: 50px; max-height: 50px;">
                                        @else
                                            No Image
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('buku.edit', $buku->buku_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            {{-- Tampilkan tombol hapus hanya untuk admin --}}
                                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                                                <form id="delete-form-{{ $buku->buku_id }}" action="{{ route('buku.destroy', $buku->buku_id) }}" class="d-inline" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button onclick="deleteForm('{{ $buku->buku_id }}')" class="btn btn-danger btn-sm">Hapus</button>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">Tidak ada data buku.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            {{-- Jika ingin menambahkan pagination --}}
                            {{-- <tfoot>
                                <tr>
                                    <th colspan="8">
                                        {{ $bukus->links() }}
                                    </th>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteForm(id){
            Swal.fire({
                title: 'Hapus data',
                text: "Anda akan menghapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-form-${id}`).submit()
                }
            })
        }
    </script>
@endsection
