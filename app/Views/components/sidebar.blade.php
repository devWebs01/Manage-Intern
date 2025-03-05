<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="" class="b-brand text-primary">

                <img src="{{ base_url('/assets/images/logo-dark.svg') }}" class="img-fluid logo-lg" alt="logo">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item">
                    <a href="/dashboard" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-dashboard">
                            </i>
                        </span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>UI Components</label>
                    <i class="ti ti-dashboard">
                    </i>
                </li>
                <li class="pc-item">
                    <a href="{{ site_url('users') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-typography">
                            </i>
                        </span>
                        <span class="pc-mtext">Pengguna</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ site_url('participants') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-color-swatch">
                            </i>
                        </span>
                        <span class="pc-mtext">Peserta</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ site_url('logbooks') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-plant-2">
                            </i>
                        </span>
                        <span class="pc-mtext">Logbook</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Pages</label>
                    <i class="ti ti-news">
                    </i>
                </li>
                <li class="pc-item">
                    <a href="{{ site_url('presences') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-lock">
                            </i>
                        </span>
                        <span class="pc-mtext">Absen</span>
                    </a>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-menu">
                            </i>
                        </span>
                        <span class="pc-mtext">Magang</span>
                        <span class="pc-arrow">
                            <i data-feather="chevron-right">
                            </i>
                        </span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="#!">Penilaian</a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="#!">Serfikat</a>
                        </li>
                    </ul>
                </li>
              
            </ul>
           
        </div>
    </div>
</nav>