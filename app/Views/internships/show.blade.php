@extends('components.layout')

@include('layouts.table')

@section('header')
    <li class="breadcrumb-item">
        <a href="{{ site_url('internships') }}">Penilaian Peserta</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1"
                                role="tab" aria-selected="true">
                                <i class="ti ti-user me-2"></i>Profile
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab" href="#profile-2" role="tab"
                                aria-selected="true">
                                <i class="ti ti-file-text me-2"></i>Absensi
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab" href="#profile-2" role="tab"
                                aria-selected="true">
                                <i class="ti ti-file-text me-2"></i>Logbook
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                            @include('internships.profile')
                        </div>
                        <div class="tab-pane" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                            @include('internships.presence')
                        </div>
                        <div class="tab-pane" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-2">
                            <div class="table-responsive">
                                <table class="table table-striped text-nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Isi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logbooks as $no => $logbook)
                                            <tr>
                                                <td>{{ ++$no }}</td>
                                                <td>{{ Carbon\Carbon::parse($logbook->date)->format('d M Y') }}</td>
                                                <td>{{ Illuminate\Support\Str::limit($logbook->activity, 40, '...') }}</td>
                                                <td>
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <a href="{{ site_url('logbooks/' . $logbook->id . '/edit') }}"
                                                            class="btn btn-sm btn-sm btn-warning">Edit</a>

                                                        <form action="{{ site_url('logbooks/' . $logbook->id) }}"
                                                            method="post"
                                                            onsubmit="return confirm('Yakin ingin menghapus?');">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
@endsection
