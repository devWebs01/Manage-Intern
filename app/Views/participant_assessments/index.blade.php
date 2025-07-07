@extends("components.layout")

@include("layouts.table")

@section("header")
    <li class="breadcrumb-item">
        <a href="{{ site_url("participant-assessments") }}">Penilaian Peserta</a>
    </li>
@endsection

@php
    function getAssessmentCategory($score)
    {
        if ($score >= 86 && $score <= 100) {
            return "Sangat Memuaskan";
        } elseif ($score >= 71 && $score <= 85) {
            return "Memuaskan";
        } else {
            return "Cukup Memuaskan";
        }
    }
@endphp

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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assessments as $index => $assessment)
                            <tr>
                                <td>
                                    {{ ++$index }}.</td>
                                <td>
                                    {{ $assessment->full_name }}</td>
                                <td>
                                    {{ Carbon\Carbon::parse($assessment->start_date)->format("d M Y") }} -
                                    {{ Carbon\Carbon::parse($assessment->end_date)->format("d M Y") }}
                                </td>
                                <td>
                                    @if ($assessment->assessments->count() > 0)
                                        {{ getAssessmentCategory($assessment->assessments->avg("score")) }}
                                    @else
                                        ❌
                                    @endif
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
