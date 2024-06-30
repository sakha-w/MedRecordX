<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.index') }}" class="brand-link">
        <img src="{{ asset('img/logoklinik.png') }}" alt="AdminLTE Logo" class="brand-image" >
        <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (auth()->user()->role === 'admin')
                    <img src="{{ asset('img/admin-img.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif

                @if (auth()->user()->role === 'dokter')
                    @if (auth()->user()->doctor->photo)
                        <img src="{{ asset(auth()->user()->doctor->photo) }}" class="img-circle elevation-2"
                            alt="User Image">
                    @endif
                    <img src="{{ asset('img/default-avatar.png') }}" class="img-circle elevation-2" alt="User Image">
                @elseif(auth()->user()->role === 'perawat')
                    @if (auth()->user()->nurse->photo)
                        <img src="{{ asset(auth()->user()->nurse->photo) }}" class="img-circle elevation-2"
                            alt="User Image">
                    @endif
                    <img src="{{ asset('img/default-avatar.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>

            @php
                $user_link = '#';
                if (auth()->user()->role === 'dokter') {
                    $user_link = '/users/dokter/' . auth()->user()->doctor->id_dokter;
                } elseif (auth()->user()->role === 'perawat') {
                    $user_link = '/users/perawat/' . auth()->user()->nurse->id_perawat;
                } else {
                    $user_link = '#';
                }
            @endphp

            <div class="info">
                <a href="{{ $user_link }}" class="d-block">{{ auth()->user()->username }}
                    @if (auth()->user()->role === 'admin')
                        <span class="right badge badge-danger">{{ auth()->user()->role }}</span>
                    @endif
                    @if (auth()->user()->role === 'dokter')
                        <span class="right badge badge-success">{{ auth()->user()->role }}</span>
                    @endif
                    @if (auth()->user()->role === 'perawat')
                        <span class="right badge badge-info">resepsionis</span>
                    @endif
                </a>
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
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ Route::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-gauge"></i>
                        <p> Dashboard</p>
                    </a>
                </li>
                {{-- @dd(request()->route()->getPrefix() == '/users') --}}

                @can('Admin')
                    <li class="nav-item {{ request()->route()->getPrefix() == '/users'? 'menu-open': '' }}">
                        <a href="#" class="nav-link {{ request()->route()->getPrefix() == '/users'? 'active': '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('dokter.index') }}"
                                    class="nav-link {{ Route::is('dokter*') ? 'active' : '' }}">
                                    <i class="nav-icon fa-solid fa-user-doctor"></i>
                                    <p> Dokter</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('perawat.index') }}"
                                    class="nav-link {{ Route::is('perawat*') ? 'active' : '' }}">
                                    <i class="nav-icon fa-solid fa-user-nurse"></i>
                                    <p> Resepsionis</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('poli.index') }}" class="nav-link {{ Route::is('poli*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-notes-medical"></i>
                            <p> Poli</p>
                        </a>
                    </li>
                @endcan
                @can('AdminDoctorNurse')
                    <li class="nav-item">
                        <a href="{{ route('pasien.index') }}" class="nav-link {{ Route::is('pasien*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-hospital-user"></i>
                            <p> Pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('antrian.index') }}"
                            class="nav-link {{ Route::is('antrian*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-arrow-right"></i>
                            <p> Pendaftaran</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
