<header class="pc-header">
    <div class="header-wrapper">
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">

                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item header-user-profile">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                        <img src="{{ base_url(User()->avatar ?? "/assets/images/user/avatar-2.jpg") }}" alt="user-image"
                            class="user-avtar">
                        <span>{{ User()->username }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header">
                            <div class="d-flex mb-1">
                                <div class="flex-shrink-0">
                                    <img src="{{ base_url(User()->avatar ?? "/assets/images/user/avatar-2.jpg") }}"
                                        alt="user-image" class="user-avtar wid-35">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">{{ user()->username }}</h6>
                                    <p class="mb-1">{{ lang("role." . user()->role) }}</p>

                                </div>
                                <a href="#!" class="pc-head-link bg-transparent">
                                    <i class="ti ti-power text-success"></i>
                                </a>
                            </div>
                        </div>
                        <a href="{{ base_url("profiles/" . User()->id . "/show") }}" class="dropdown-item">
                            <i class="ti ti-edit-circle"></i>
                            <span>Profil Akun</span>
                        </a>
                        <a href="{{ base_url("logout") }}" class="dropdown-item">
                            <i class="ti ti-power"></i>
                            <span>Keluar</span>
                        </a>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
