@extends("components.layout")

@include("layouts.table")

@section("header")
    <li class="breadcrumb-item">
        <a href="{{ site_url("participants") }}">
            Absensi
        </a>
    </li>
@endsection

@section("content")
    <div class="card rounded">
        <div class="card-body">
            @if (session("success"))
                <div class="alert alert-success">
                    {{ session("success") }}
                </div>
            @endif

            <div class="mb-3">
                @if (!$hasCheckInToday)
                    <a href="{{ site_url("presences/new") }}" class="btn btn-primary">Tambah Absensi</a>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table table-striped text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presences as $no => $presence)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $presence->participant->user->username }}</td>
                                <td>{{ $presence->participant->full_name }}</td>
                                <td>{{ Carbon\Carbon::parse($presence->date)->format("d M Y") }}</td>
                                <td>{{ $presence->check_in }}</td>
                                <td>{{ $presence->check_out }}</td>

                                <td>
                                    @if (empty($presence->check_out) && Carbon\Carbon::parse($presence->date)->isToday())
                                        <a href="{{ site_url("presences/" . $presence->id . "/edit") }}"
                                            class="btn btn-sm btn-primary">
                                            Absen Keluar
                                        </a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
