<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="{{ Storage::disk('s3')->url("uploads/img/kaiadmin/logo_light.svg") }}"
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
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                <div class="input-group-prepend d-flex">

                </div>
            </nav>
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                    <a class="nav-link dropdown-toggle"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-expanded="false"
                        aria-haspopup="true">
                        <i class="fa fa-search"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-search animated fadeIn">
                        <form action="{{ route('searchPage') }}" method="GET">
                            <label for="tanggal">Tanggal:</label>
                            <input type="date" id="tanggal" name="tanggal" required>
                            <button type="submit">Cari</button>
                        </form>
                    </ul>
                </li>
                @auth
                    <li class="nav-item topbar-user dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic"
                            data-bs-toggle="dropdown"
                            href="#"
                            aria-expanded="false">
                            <div class="avatar-sm">
                                @if(!empty(Auth::user()->photo))
                                    <img src="{{ Auth::User()->photo}}" alt="..." class="avatar-img rounded-circle"/>
                                @else
                                    <img src="{{ Storage::disk('s3')->url('uploads/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle"/>
                                @endif
                            </div>
                            <span class="profile-username">
                                <span class="op-7">Hi,</span>
                                <span class="fw-bold">{{ Auth::User()->nama }}</span>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg">
                                            @if(!empty(Auth::User()->photo))
                                                <img src="{{ Auth::User()->photo}}" alt="image profile" class="avatar-img rounded"/>
                                            @else
                                                <img src="{{ Storage::disk('s3')->url('uploads/img/profile.jpg') }}" alt="image profile" class="avatar-img rounded"/>
                                            @endif

                                        </div>
                                        <div class="u-text">
                                            <h4>{{ Auth::User()->nama }}</h4>
                                            <p class="text-muted">{{ Auth::User()->email}} </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">My Profile</a>
                                    <a class="dropdown-item" href="#">Account Setting</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form action="{{ route('logout') }}" method="post" id="logout-form" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </div>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
