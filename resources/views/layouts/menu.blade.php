<div style="position: relative;">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"
        style="background-image: url('{{ asset('img/background-kb.jpeg') }}'); 
                 background-size: cover; 
                 background-position: center; 
                 height: 100vh;">
        <!-- Atur tinggi sesuai kebutuhan -->
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(181, 0, 142, 0.7);">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                <div class="sidebar-brand-icon ">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ config('app.name', '') }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Nav::isRoute('home') }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>{{ __('Dashboard') }}</span></a>
            </li>
            @if (Auth::user()->role == 'Admin')
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    {{ __('Master Data') }}
                </div>

                <!-- Nav Item - Profile -->

                <li class="nav-item {{ Nav::isRoute('puskesmas') }}">
                    <a class="nav-link" href="{{ route('puskesmas') }}">
                        <i class="fas fa-fw fa-hospital"></i>
                        <span>{{ __('Puskesmas') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Nav::isRoute('alat') }}">
                    <a class="nav-link" href="{{ route('alat') }}">
                        <i class="fas fa-fw fa-toolbox"></i>
                        <span>{{ __('Alat Kontrasepsi') }}</span>
                    </a>
                </li>
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    {{ __('Pengguna') }}
                </div>

                <!-- Nav Item - Profile -->
                <li class="nav-item {{ Nav::isRoute('user.admin') }}">
                    <a class="nav-link" href="{{ route('user.admin') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('Admin') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Nav::isRoute('user.operator') }}">
                    <a class="nav-link" href="{{ route('user.operator') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('Operator') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Nav::isRoute('user.pj') }}">
                    <a class="nav-link" href="{{ route('user.pj') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('Penanggung Jawab') }}</span>
                    </a>
                </li>
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    {{ __('Laporan') }}
                </div>
                <li class="nav-item {{ Nav::isRoute('laporan.pelayanan') }}">
                    <a class="nav-link" href="{{ route('laporan.pelayanan') }}">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>{{ __('Laporan Pelayanan') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Nav::isRoute('laporan.ekseptor') }}">
                    <a class="nav-link" href="{{ route('laporan.ekseptor') }}">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>{{ __('Laporan Akseptor') }}</span>
                    </a>
                </li>
            @elseif (Auth::user()->role == 'PJ-KB')
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    {{ __('Laporan') }}
                </div>
                <li class="nav-item {{ Nav::isRoute('laporan.pelayanan') }}">
                    <a class="nav-link" href="{{ route('laporan.pelayanan') }}">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>{{ __('Laporan Pelayanan') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ Nav::isRoute('laporan.ekseptor') }}">
                    <a class="nav-link" href="{{ route('laporan.ekseptor') }}">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>{{ __('Laporan Akseptor') }}</span>
                    </a>
                </li>
            @elseif (Auth::user()->role == 'Operator')
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    {{ __('Master Data') }}
                </div>
                <li class="nav-item {{ Nav::isRoute('kelurahan') }}">
                    <a class="nav-link" href="{{ route('kelurahan') }}">
                        <i class="fas fa-fw fa-flag"></i>
                        <span>{{ __('Kelurahan') }}</span>
                    </a>
                </li>
                <!-- Nav Item - Profile -->
                <li class="nav-item {{ Nav::isRoute('ekseptor') }}">
                    <a class="nav-link" href="{{ route('ekseptor') }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>{{ __('Data Akseptor') }}</span>
                    </a>
                </li>
                <div class="sidebar-heading">
                    {{ __('Master Pelayanan') }}
                </div>



                <!-- Nav Item - Profile -->
                <li class="nav-item {{ Nav::isRoute('sasaran') }}">
                    <a class="nav-link" href="{{ route('sasaran') }}">
                        <i class="fas fa-fw fa-check"></i>
                        <span>{{ __('Sasaran') }}</span>
                    </a>
                </li>
                <!-- Nav Item - Profile -->
                <li class="nav-item {{ Nav::isRoute('pelayanan') }}">
                    <a class="nav-link" href="{{ route('pelayanan') }}">
                        <i class="fas fa-fw fa-check"></i>
                        <span>{{ __('Pelayanan KB') }}</span>
                    </a>
                </li>
                <!-- Nav Item - Profile -->
                <li class="nav-item {{ Nav::isRoute('pemantauan_ekseptor') }}">
                    <a class="nav-link" href="{{ route('pemantauan_ekseptor') }}">
                        <i class="fas fa-fw fa-check"></i>
                        <span>{{ __('Penggunaan Alat') }}</span>
                    </a>
                </li>
                <!-- Nav Item - Profile -->
                <li class="nav-item {{ Nav::isRoute('pemantauan') }}">
                    <a class="nav-link" href="{{ route('pemantauan') }}">
                        <i class="fas fa-fw fa-check"></i>
                        <span>{{ __('Penerimaan Alat') }}</span>
                    </a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Settings') }}
            </div>
            @if (Auth::user()->role == 'Operator')
                <li class="nav-item {{ Nav::isRoute('update_puskesmas') }}">
                    <a class="nav-link" href="{{ route('update_puskesmas') }}">
                        <i class="fas fa-fw fa-hospital"></i>
                        <span>{{ __('Setting Puskesmas') }}</span>
                    </a>
                </li>
            @endif
            <!-- Nav Item - Profile -->
            <li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('profile') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>{{ __('Profile') }}</span>
                </a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </div>
    </ul>
</div>
