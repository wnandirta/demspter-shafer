<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">TalinTest</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('images/photo-profile.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url(Auth::user()->role) }}" class="nav-link @if (!Request::segment(2)) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (auth()->user()->role == 'Admin')
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}" class="nav-link @if(Request::segment(2) == 'user') active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.kelas.index') }}" class="nav-link @if(Request::segment(2) == 'kelas') active @endif">
                        <i class="nav-icon fas fa-door-closed"></i>
                        <p>
                            Kelas
                        </p>
                    </a>
                </li>
                    
                @endif
                @if (auth()->user()->role == 'Guru')
                <li class="nav-item">
                    <a href="{{ route('guru.tipe.index') }}" class="nav-link @if(Request::segment(2) == 'tipe') active @endif">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Tipe
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('guru.karakteristik.index') }}" class="nav-link @if(Request::segment(2) == 'karakteristik') active @endif">
                        <i class="nav-icon fas fa-user-circle" aria-hidden="true"></i>
                        <p>
                            Karakteristik
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('guru.pengetahuan.index') }}" class="nav-link @if(Request::segment(2) == 'pengetahuan') active @endif">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Pengetahuan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('guru.jurusan.index') }}" class="nav-link @if(Request::segment(2) == 'jurusan') active @endif">
                        <i class="nav-icon fas fa-user-circle" aria-hidden="true"></i>
                        <p>
                            Jurusan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('guru.solusi.index') }}" class="nav-link @if(Request::segment(2) == 'solusi') active @endif">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Solusi
                        </p>
                    </a>
                </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
