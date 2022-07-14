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
                    <hr>
                    <li class="nav-item">
                        <a href="/dashboard/warehouse"
                            class="nav-link {{ Request::is('dashboard/warehouse*') ? 'active' : '' }}">
                            <i class="bi bi-building"></i>
                            <p>
                                Warehouse
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dashboard/management-warehouse"
                            class="nav-link {{ Request::is('dashboard/management-warehouse*') ? 'active' : '' }}">
                            <i class="bi bi-person-workspace"></i>
                            <p>
                                Management Warehouse
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dashboard/collateral-management-services"
                            class="nav-link {{ Request::is('dashboard/collateral-management-services*') ? 'active' : '' }}">
                            <i class="bi bi-gear"></i>
                            <p>
                                Collateral Management Services (CMS)
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dashboard/handling"
                            class="nav-link {{ Request::is('dashboard/handling*') ? 'active' : '' }}">
                            <i class="bi bi-person-square"></i>
                            <p>
                                Handling
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dashboard/contract"
                            class="nav-link {{ Request::is('dashboard/contract*') ? 'active' : '' }}">
                            <i class="bi bi-person-rolodex"></i>
                            <p>
                                Contract
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dashboard/office"
                            class="nav-link {{ Request::is('dashboard/office*') ? 'active' : '' }}">
                            <i class="bi bi-briefcase"></i>
                            <p>
                                Kantor
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dashboard/depo-container"
                            class="nav-link {{ Request::is('dashboard/depo-container*') ? 'active' : '' }}">
                            <i class="bi bi-truck"></i>
                            <p>
                                Depo Container
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dashboard/distribution"
                            class="nav-link {{ Request::is('dashboard/distribution*') ? 'active' : '' }}">
                            <i class="bi bi-minecart"></i>
                            <p>
                                Distribusi
                            </p>
                        </a>
                    </li>
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
