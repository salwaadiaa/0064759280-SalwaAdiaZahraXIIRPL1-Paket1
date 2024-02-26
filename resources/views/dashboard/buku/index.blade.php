@extends('layouts.app')
@section('title', 'Daftar Buku')

@section('title-header', 'Daftar Buku')
@section('breadcrumb')
@if (Auth::user()->role == 'admin')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard Admin</a></li>
    <li class="breadcrumb-item active">Daftar Buku</li>
@endif
@if (Auth::user()->role == 'petugas')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard Petugas</a></li>
    <li class="breadcrumb-item active">Daftar Buku</li>
@endif
@endsection

@if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
@section('action_btn')
    <a href="{{ route('buku.create') }}" class="btn btn-default">Tambah Buku</a>
@endsection
@endif

<style>
    .position-relative {
        position: relative;
    }
    
    .best-seller {
        position: absolute;
        top: 0;
        left: -20px;
        transform: rotate(-45deg);
        padding: 5px 10px;
        background-color: #28a745; 
        color: #fff; 
        font-size: 12px; 
    }
    </style>
    
    @section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center text-dark">
                    <h2 class="card-title h3">Daftar Buku</h2>
                    <div class="ml-auto" style="max-width: 200px;"> 
                        <select id="category_filter" class="form-control" onchange="filterByCategory(this)">
                            <option value="" {{ (!$selectedCategory) ? 'selected' : '' }}>Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->kategori_id }}" {{ ($selectedCategory == $category->kategori_id) ? 'selected' : '' }}>{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="table-responsive" style="padding: 15px;"> 
                    <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Buku</th>
                                    <th>Gambar</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Sinopsis Buku</th>
                                    <th>Tahun Terbit</th>
                                    <th>Stok Buku</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($bukus as $buku)
                                <tr>
                                <td>{{ ($bukus->currentPage() - 1) * $bukus->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $buku->buku_id }}</td>
                                <td>
                                    <div class="position-relative">
                                        @if ($buku->jumlah_ulasan >= 3)
                                            <span class="badge badge-success best-seller">Favorite</span>
                                        @endif
                                        @if($buku->gambar)
                                            <img src="{{ asset('uploads/images/' . $buku->gambar) }}" alt="{{ $buku->judul }}" style="max-width: 50px; max-height: 50px;">
                                        @else
                                            No Image
                                        @endif
                                    </div>
                                    </td>
                                    <td>
                                        {{ $buku->judul }}
                                    </td>
                                    <td>{{ $buku->kategoriBuku->nama_kategori ?? '-' }}</td>
                                    <td>{{ $buku->penulis }}</td>
                                    <td>{{ $buku->penerbit }}</td>
                                    <td>{{ $buku->sinopsis }}</td>
                                    <td>{{ $buku->tahun_terbit }}</td>
                                    <td>{{ $buku->stok }}</td>   
                                    <td>
                                        <a href="{{ route('buku.edit', $buku->buku_id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                                            <form id="delete-form-{{ $buku->buku_id }}" action="{{ route('buku.destroy', $buku->buku_id) }}" class="d-inline" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button onclick="deleteForm('{{ $buku->buku_id }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    @if($bukus->currentPage() > 1)
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $bukus->previousPageUrl() }}" tabindex="-1">Previous</a>
                                        </li>
                                    @endif

                                    @for ($i = max(1, $bukus->currentPage() - 2); $i <= min($bukus->currentPage() + 2, $bukus->lastPage()); $i++)
                                        <li class="page-item {{ ($i == $bukus->currentPage()) ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $bukus->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    @if($bukus->currentPage() < $bukus->lastPage())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $bukus->nextPageUrl() }}">Next</a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
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

        function filterByCategory(element) {
            var selectedCategory = element.value;
            window.location.href = "{{ route('buku.index') }}" + "?category=" + selectedCategory;
        }
    </script>
@endsection
