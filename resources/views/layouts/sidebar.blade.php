<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="@auth
    /dashboard
@else
/
    @endauth" class="brand-link  text-decoration-none">
        {{-- UBAH LOGO PERUSAHAAN --}}
        <img src="/assets/image/logo.jpeg" alt="Logo BGR" style="opacity: .8" width="85 px">
        <span class="brand-text font-weight-light">PT BGR LOGISTIK</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        @auth
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    {{-- UBAH FOTO USER --}}
                    <img src="/assets/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="/dashboard" class="d-block text-decoration-none">{{ auth()->user()->name }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
            </div> --}}

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    @can('admin')
                        <hr>
                        <li class="nav-item">
                            <a href="/dashboard/contract"
                                class="nav-link {{ Request::is('dashboard/contract*') ? 'active' : '' }}">
                                <i class="bi bi-person-rolodex"></i>
                                <p>
                                    Kontrak
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/service"
                                class="nav-link {{ Request::is('dashboard/warehouse*') ? 'active' : '' }} {{ Request::is('dashboard/depo*') ? 'active' : '' }} {{ Request::is('dashboard/cms*') ? 'active' : '' }} {{ Request::is('dashboard/logistic*') ? 'active' : '' }}">
                                <i class="bi bi-gear"></i>
                                <p>
                                    Jenis Pelayanan
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/dashboard/warehouse"
                                        class="nav-link {{ Request::is('dashboard/warehouse*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Gudang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/depo"
                                        class="nav-link {{ Request::is('dashboard/depo*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Depo Container</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/cms"
                                        class="nav-link {{ Request::is('dashboard/cms*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>CMS</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dashboard/logistic"
                                        class="nav-link {{ Request::is('dashboard/logistic*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Logistik</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    <hr>
                    <li class="nav-item">
                        <a href="/logout" class="nav-link">
                            <i class="bi bi-box-arrow-left"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        @else
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="/login" class="nav-link">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <p>
                                Login
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        @endauth
    </div>
    <!-- /.sidebar -->
</aside>
