@extends("components.layout")

@include("layouts.table")

@section("header")
    <li class="breadcrumb-item">
        <a href="{{ site_url("internships") }}">Peserta Magang</a>
    </li>
@endsection

@section("content")
    <div class="card rounded">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Status</th>
                            <th>Mentor</th>
                            <th>Waktu Magang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($participants as $index => $participant)
                            <tr>
                                <td>{{ ++$index }}.</td>
                                <td>{{ $participant->user->username }}</td>
                                <td>{{ $participant->full_name }}</td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ lang("Status." . $participant->status) }}
                                    </span>

                                </td>
                                <td>{{ $participant->mentor->username }}</td>
                                <td>{{ Carbon\Carbon::parse($participant->start_date)->format("d M Y") }} -
                                    {{ Carbon\Carbon::parse($participant->end_date)->format("d M Y") }}</td>
                                <td>
                                    <a href="{{ site_url("internships/" . $participant->id) . "/show" }}"
                                        class="btn btn-primary btn-sm">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
