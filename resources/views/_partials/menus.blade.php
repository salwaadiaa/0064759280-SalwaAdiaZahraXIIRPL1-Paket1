@php
    $routeActive = Route::currentRouteName();
@endphp

<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
        <i class="ni ni-tv-2 text-primary"></i>
        <span class="nav-link-text">Dashboard</span>
    </a>
</li>

@if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'users.index' ? 'active' : '' }}" href="{{ route('users.index') }}">
        <i class="fas fa-users text-warning"></i>
        <span class="nav-link-text">Users</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'buku.index' ? 'active' : '' }}" href="{{ route('buku.index') }}">
        <i class="fas fa-book text-info"></i>
        <span class="nav-link-text">Buku</span>
    </a>
</li>
<li class="nav-item">
        <a class="nav-link {{ $routeActive == 'peminjaman.index' ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">
            <i class="fas fa-book text-success"></i>
            <span class="nav-link-text">Peminjaman</span>
        </a>
    </li>
    <li class="nav-item">
    <a class="nav-link {{ $routeActive == 'ulasan.admin' ? 'active' : '' }}" href="{{ route('ulasan.admin') }}">
        <i class="fas fa-comment text-primary"></i>
        <span class="nav-link-text">Riwayat Ulasan Buku</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'kategori.admin' ? 'active' : '' }}" href="{{ route('kategori.admin') }}">
        <i class="ni ni-tag text-primary"></i>
        <span class="nav-link-text">Manajemen Kategori</span>
    </a>
</li>

@endif

@if (Auth::user()->role == 'user')
<li class="nav-item">
        <a class="nav-link {{ $routeActive == 'user.buku.index' ? 'active' : '' }}" href="{{ route('user.buku.index') }}">
            <i class="fas fa-book text-info"></i>
            <span class="nav-link-text">Buku</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'ulasan.index' ? 'active' : '' }}" href="{{ route('ulasan.index') }}">
            <i class="fas fa-comment text-primary"></i>
            <span class="nav-link-text">Tambah Ulasan</span>
        </a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'dashboard.ulasan.buku-di-ulas' ? 'active' : '' }}" href="{{ route('dashboard.ulasan.buku-di-ulas') }}">
            <i class="fas fa-comment text-success"></i>
            <span class="nav-link-text">Buku yang Sudah Diulas</span>
        </a>
    </li> -->
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'koleksipribadi.index' ? 'active' : '' }}" href="{{ route('koleksipribadi.index') }}">
            <i class="ni ni-collection text-primary"></i>
            <span class="nav-link-text">Koleksi Pribadi</span>
        </a>
    </li>
    <li class="nav-item">
    <a class="nav-link {{ $routeActive == 'kategori.user' ? 'active' : '' }}" href="{{ route('kategori.user') }}">
        <i class="ni ni-tag text-primary"></i>
        <span class="nav-link-text">Kategori Buku</span>
    </a>
</li>

@endif
