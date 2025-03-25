@extends("components.layout")

@include("layouts.table")

@section("header")
    <li class="breadcrumb-item">
        <a href="{{ site_url("internships") }}">Detail Peserta Magang</a>
    </li>
@endsection

@section("content")
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1"
                                role="tab" aria-selected="true">
                                <i class="ti ti-user me-2"></i>Profil
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab" href="#profile-2" role="tab"
                                aria-selected="true">
                                <i class="ti ti-file-text me-2"></i>Absensi
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-3" data-bs-toggle="tab" href="#profile-3" role="tab"
                                aria-selected="true">
                                <i class="ti ti-file-text me-2"></i>Logbook
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-4" data-bs-toggle="tab" href="#profile-4" role="tab"
                                aria-selected="true">
                                <i class="ti ti-file-text me-2"></i>Sertifikat
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                            {{-- @include("internships.profile") --}}
                            @include("internships.certificate")

                        </div>
                        <div class="tab-pane" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                            @include("internships.presence")
                        </div>
                        <div class="tab-pane" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-3">
                            @include("internships.logbooks")
                        </div>
                        <div class="tab-pane" id="profile-4" role="tabpanel" aria-labelledby="profile-tab-4">
                            @include("internships.certificate")
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
@endsection
