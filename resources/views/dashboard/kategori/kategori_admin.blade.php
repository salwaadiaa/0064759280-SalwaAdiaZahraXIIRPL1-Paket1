@extends('layouts.app')

@section('title', 'Manajemen Kategori Buku')

@section('title-header', 'Manajemen Kategori Buku')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Manajemen Kategori Buku</li>
@endsection

@if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
@section('action_btn')
    <a href="{{ route('kategori.create') }}" class="btn btn-default">Tambah Kategori</a>
@endsection
@endif

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Manajemen Kategori Buku</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kategoris as $kategori)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kategori->nama_kategori }}</td>
                                        <td>
                                        <a href="{{ route('kategori.edit', ['kategori_id' => $kategori->kategori_id]) }}" class="btn btn-warning btn-sm">Edit</a>

                                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                                                <form id="delete-form-{{ $kategori->kategori_id }}" action="{{ route('kategori.destroy', $kategori->kategori_id) }}" class="d-inline" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button onclick="deleteForm('{{ $kategori->kategori_id }}')" class="btn btn-danger btn-sm">Hapus</button>
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Tidak ada data kategori.</td>
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
