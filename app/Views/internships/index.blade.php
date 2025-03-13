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
                            <th>Peserta</th>
                            <th>Status</th>
                            <th>Waktu Magang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($participants as $index => $participant)
                            <tr>
                                <td>{{ ++$index }}.</td>
                                <td>{{ $participant->full_name }}</td>
                                <td>
                                    <button class="btn btn-outline-dark btn-sm text-uppercase">
                                        {{ lang("Status." . $participant->status) }}
                                    </button>
                                </td>
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
