@extends('layouts.app')

@section('title', 'Dashboard User')

@section('title-header', 'Dashboard User')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard User</li>
@endsection

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h1 class="card-title">Welcome, {{ $user->name }}!</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tambahkan bagian konten atau komponen lainnya di sini -->
    </div>
@endsection
