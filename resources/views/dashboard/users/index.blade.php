@extends('layouts.app')
@section('title', 'Users')

@section('title-header', 'Users')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard Admin</a></li>
    <li class="breadcrumb-item active">Users</li>
@endsection

@section('action_btn')
    <a href="{{route('users.create')}}" class="btn btn-default">Tambah Data</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Users</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Alamat</th>
                                    <th>Avatar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ str()->title($user->role) }}</td>
                                        <td>{{ $user->alamat }}</td>
                                        <td>
                                            <img src="{{ asset('/uploads/images/'.$user->avatar) }}" alt="{{ $user->name }}" width="100">
                                        </td>
                                        <td class="d-flex jutify-content-center">
                                            <a href="{{route('users.edit', $user->user_id)}}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                            <form id="delete-form-{{ $user->user_id }}" action="{{ route('users.destroy', $user->user_id) }}" class="d-none" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button onclick="deleteForm('{{$user->user_id}}')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                @if($users->currentPage() > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $users->previousPageUrl() }}" tabindex="-1">Previous</a>
                                    </li>
                                @endif

                                @for ($i = max(1, $users->currentPage() - 2); $i <= min($users->currentPage() + 2, $users->lastPage()); $i++)
                                    <li class="page-item {{ ($i == $users->currentPage()) ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if($users->currentPage() < $users->lastPage())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteForm(user_id){
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
                    $(`#delete-form-${user_id}`).submit()
                }
            }) 
        }
    </script>
@endsection
