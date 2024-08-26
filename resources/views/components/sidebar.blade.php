<!-- Sidebar -->
<div class="sidebar" data-background-color="light">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="light">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="{{ Storage::disk('s3')->url('uploads/img/Logo_book.png') }}"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20"/>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content" style="padding: 0 10px;">
            <ul class="nav nav-secondary">
                <li class="{{Route::currentRouteNamed('dashboard') ? 'nav-item active' : "nav-item"}}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                    <h4 class="text-section">Manajemen Buku</h4>
                </li>
                <li class="{{Route::currentRouteNamed('listBuku') ? 'nav-item active' : "nav-item"}}">
                    <a href="{{ route('listBuku') }}">
                        <i class="fas fa-book"></i>
                        <p class="sub-item">Data Master Buku</p>
                    </a>
                </li>
                <li class="{{Route::currentRouteNamed('history') ? 'nav-item active' : "nav-item"}}">
                    <a href="{{ route('history') }}">
                        <i class="fas fa-book-open"></i>
                        <p class="sub-item">Laporan History Buku</p>
                    </a>
                </li>
                <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                    <h4 class="text-section">Manajemen User</h4>
                </li>
                <li class="{{Route::currentRouteNamed('listUser') ? 'nav-item active' : "nav-item"}}">
                    <a href="{{ route('listUser') }}">
                        <i class="fas fa-user"></i>
                        <p class="sub-item">Data Master User</p>
                    </a>
                </li>
                <li class="{{Route::currentRouteNamed('listUser') ? 'nav-item active' : "nav-item"}}">
                    <a href="{{ route('listUser') }}">
                        <i class="fas fa-history"></i>
                        <p class="sub-item">Laporan History User</p>
                    </a>
                </li>
                <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                    <h4 class="text-section">Manajemen Peminjaman</h4>
                </li>
                <li class="{{Route::currentRouteNamed('listPinjam') ? 'nav-item active' : "nav-item"}}">
                    <a href="{{ route('listPinjam') }}">
                        <i class="fas fa-id-badge"></i>
                        <p class="sub-item">Laporan Peminjaman</p>
                    </a>
                </li>
                <li class="{{Route::currentRouteNamed('listPengembalian') ? 'nav-item active' : "nav-item"}}">
                    <a href="{{ route('listPengembalian') }}">
                        <i class="fas fa-book-reader"></i>
                        <p class="sub-item">Laporan Pengembalian</p>
                    </a>
                </li>


            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
