@extends("components.layout")

@include("layouts.table")

@section("header")
    <li class="breadcrumb-item">
        <a href="{{ site_url("participant-assessments") }}">Penilaian Peserta</a>
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
                            <th>Waktu Magang</th>
                            <th>Penilaian</th>
                            <th>Sertifikat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assessments as $index => $assessment)
                            <tr>
                                <td>{{ ++$index }}.</td>
                                <td>{{ $assessment->full_name }}</td>
                                <td>
                                    {{ Carbon\carbon::parse($assessment->start_date)->format("d M Y") }} -
                                    {{ Carbon\carbon::parse($assessment->end_date)->format("d M Y") }}
                                </td>
                                <td>{{ $assessment->assessments->count() > 0 ? "✅" : "❌" }}
                                </td>
                                <td>{{ $assessment->assessments->count() > 0 ? "✅" : "❌" }}
                                </td>
                                <td>
                                    @if ($assessment->assessments->count() > 0)
                                        <a href="{{ site_url("participant-assessments/" . $assessment->id) . "/edit" }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                    @else
                                        <a href="{{ site_url("participant-assessments/" . $assessment->id) . "/new" }}"
                                            class="btn btn-success btn-sm">Nilai</a>
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
