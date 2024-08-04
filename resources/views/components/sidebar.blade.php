<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">

    <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
        <a href="{{ route('Dashboard') }}" class="logo">
        <img
            src="{{ asset('img/Logo_book.png') }}"
            alt="navbar brand"
            class="navbar-brand"
            height="20"
        />
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
    <div class="sidebar-content">
        <ul class="nav nav-secondary">
        <li class="{{Route::currentRouteNamed('Dashboard') ? 'nav-item active' : "nav-item"}}">
            <a href="{{ route('Dashboard') }}">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
            </a>
            <div class="collapse" id="dashboard">
            </div>
        </li>
        <li class="{{Route::currentRouteNamed('ListBuku') ? 'nav-item active' : "nav-item"}}">
            <a data-bs-toggle="collapse" href="#sidebarLayouts" class="" aria-expanded="true">
            <i class="fas fa-layer-group"></i>
            <p>Manajemen Buku</p>
            </a>
            <div class="collapse show" id="sidebarLayouts" style="">
                <ul class="nav nav-collapse">
                    <li>
                        <a href="{{ route('ListBuku') }}">
                            <span class="sub-item">Data Master Buku</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('history') }}">
                            <span class="sub-item">Laporan History Buku</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="{{Route::currentRouteNamed('ListUser') ? 'nav-item active' : "nav-item"}}">
            <a data-bs-toggle="collapse" href="#sidebarUserLayouts" class="" aria-expanded="true">
            <i class="fas fa-layer-group"></i>
            <p>Manajemen User</p>
            </a>
            <div class="collapse show" id="sidebarUserLayouts" style="">
                <ul class="nav nav-collapse">
                    <li>
                        <a href="{{ route('ListUser') }}">
                            <span class="sub-item">Data Master User</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ListUser') }}">
                            <span class="sub-item">Laporan History User</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="{{Route::currentRouteNamed('ListPinjam') ? 'nav-item active' : "nav-item"}}">
            <a data-bs-toggle="collapse" href="#sidebarPinjamLayouts" class="" aria-expanded="true">
            <i class="fas fa-layer-group"></i>
            <p>Data Peminjaman</p>
            </a>
            <div class="collapse show" id="sidebarPinjamLayouts" style="">
                <ul class="nav nav-collapse">
                    <li>
                        <a href="{{ route('ListPinjam') }}">
                            <span class="sub-item">Data Peminjaman Buku</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ListPengembalian') }}">
                            <span class="sub-item">Data Pengembalian Buku</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>


        </ul>
    </div>
    </div>
</div>
<!-- End Sidebar -->
