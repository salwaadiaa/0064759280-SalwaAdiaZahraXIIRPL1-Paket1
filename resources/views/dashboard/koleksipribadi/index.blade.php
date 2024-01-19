@extends('layouts.app')

@section('title', 'Koleksi Pribadi')

@section('title-header', 'Koleksi Pribadi Saya')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Koleksi Pribadi</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Koleksi Pribadi Saya</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Penerbit</th>
                                </tr>
                            </thead>
                            <tbody>
    @forelse ($bukusDiUlas as $buku)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $buku->judul }}</td>
            <td>{{ $buku->penerbit }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4">Tidak ada buku dalam koleksi pribadi yang telah diulas.</td>
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

<script>
    function deleteForm(id) {
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
                $(`#delete-form-${id}`).submit();
            }
        });
    }
</script>
