<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header justify-content-center">
            <a href="" class="d-flex align-items-center b-brand text-dark fw-bolder">

                @if (!empty($GLOBALS["companyLogo"]) && file_exists($GLOBALS["companyLogo"]))
                    <img src="{{ base_url($GLOBALS["companyLogo"]) }}" class="img" width="50px" height="50px"
                        style="object-fit: cover;" alt="logo">
                @else
                    <strong class="fs-5">{{ $GLOBALS["companyName"] }}</strong>
                @endif

            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item">
                    <a href="{{ base_url("/dashboard") }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-dashboard">
                            </i>
                        </span>
                        <span class="pc-mtext">Beranda</span>
                    </a>
                </li>

                @if (User()->role === "ADMIN")
                    <li class="pc-item pc-caption">
                        <label>Menu Admin</label>
                        <i class="ti ti-dashboard">
                        </i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ site_url("users") }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-typography">
                                </i>
                            </span>
                            <span class="pc-mtext">Admin</span>
                        </a>
                    </li>

                    <li class="pc-item">
                        <a href="{{ site_url("mentors") }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-typography">
                                </i>
                            </span>
                            <span class="pc-mtext">Pembimbing</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ site_url("participants") }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-color-swatch">
                                </i>
                            </span>
                            <span class="pc-mtext">Peserta</span>
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
                                <a class="pc-link" href="{{ site_url("internships") }}">Peserta Magang</a>
                            </li>
                            <li class="pc-item">
                                <a class="pc-link" href="{{ site_url("assessment-indicators") }}">Indikator
                                    Penilaian</a>
                            </li>
                            <li class="pc-item">
                                <a class="pc-link" href="{{ site_url("company-profile/show") }}">Format Piagam
                            </li>
                        </ul>
                    </li>
                @elseif (User()->role === "MENTOR")
                    <li class="pc-item pc-caption">
                        <label>Menu Pembimbing</label>
                        <i class="ti ti-news">
                        </i>
                    </li>

                    <li class="pc-item">
                        <a href="{{ site_url("internships") }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-menu">
                                </i>
                            </span>
                            <span class="pc-mtext">Peserta Magang</span>
                        </a>
                    </li>

                    <li class="pc-item">
                        <a href="{{ site_url("participant-assessments") }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-menu">
                                </i>
                            </span>
                            <span class="pc-mtext">Penilaian Peserta</span>
                        </a>
                    </li>
                @elseif (User()->role === "PARTICIPANT")
                    <li class="pc-item pc-caption">
                        <label>Menu Peserta</label>
                        <i class="ti ti-dashboard">
                        </i>

                    <li class="pc-item">
                        <a href="{{ site_url("presences") }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-lock">
                                </i>
                            </span>
                            <span class="pc-mtext">Absen</span>
                        </a>
                    </li>

                    <li class="pc-item">
                        <a href="{{ site_url("logbooks") }}" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-plant-2">
                                </i>
                            </span>
                            <span class="pc-mtext">Logbook</span>
                        </a>
                    </li>
                @endif

            </ul>

        </div>
    </div>
</nav>
