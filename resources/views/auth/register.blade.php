@extends('layouts.auth')
@section('title', 'Register')

@section('content')
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Register!</h1>
                            <p class="text-lead text-white">Silahkan melakukan registrasi.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <small>Sign up with credentials</small>
                            </div>
                            <form role="form" action="{{ route('register.store') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                        </div>
                                        <input class="form-control" name="user_id" placeholder="User ID" type="text"
                                            value="{{ $user_id }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input class="form-control" name="email" placeholder="Email" type="email"
                                            value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">*{{ $message }} <i
                                                class="fas fa-arrow-up"></i></div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input class="form-control" name="username" placeholder="Username" type="text"
                                            value="{{ old('username') }}">
                                    </div>
                                    @error('username')
                                        <div class="invalid-feedback d-block">*{{ $message }} <i
                                                class="fas fa-arrow-up"></i></div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                        </div>
                                        <input class="form-control" name="name" placeholder="Full Name" type="text"
                                            value="{{ old('name') }}">
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback d-block">*{{ $message }} <i
                                                class="fas fa-arrow-up"></i></div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-bold"></i></span>
                                        </div>
                                        <textarea class="form-control" name="alamat" placeholder="Alamat">{{ old('alamat') }}</textarea>
                                    </div>
                                    @error('alamat')
                                        <div class="invalid-feedback d-block">*{{ $message }} <i
                                                class="fas fa-arrow-up"></i></div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" name="password" placeholder="Password"
                                            type="password" value="{{ old('password') }}" id="password">
                                        <div class="input-group-prepend">
                                            <button type="button" onclick="seePassword(this, 'password')"
                                                class="input-group-text" id="seePass"><i
                                                    class="fas fa-eye"></i></button>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">*{{ $message }} <i
                                                class="fas fa-arrow-up"></i>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" name="password_confirmation"
                                            placeholder="Konfirmasi Password" type="password"
                                            value="{{ old('password_confirmation') }}" id="password_confirmation">
                                        <div class="input-group-prepend">
                                            <button type="button"
                                                onclick="seePasswordConfirmation(this, 'password_confirmation')"
                                                class="input-group-text" id="seePassConfirmation">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback d-block">*{{ $message }} <i
                                                class="fas fa-arrow-up"></i>
                                        </div>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4">Sign up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
