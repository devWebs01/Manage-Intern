@extends("components.layout")

@include("layouts.table")

@section("content")
    <div class="card">
        <div class="card-body">
            <h2>Dashboard {{ User()->role }}</h2>

            @if (User()->role === "ADMIN")
                <p class="text-center">Grafik Bar untuk Total Peserta, Pembimbing, dan Peserta Lulus</p>
                <canvas id="barChart"></canvas>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <h6 class="fw-bold text-center">Grafik Donat untuk Status Magang</h6>
                        <canvas id="donutStatusChart"></canvas>
                    </div>
                    <div class="col-6">
                        <h6 class="fw-bold text-center">Grafik Donat untuk Level Pendidikan</h6>
                        <canvas id="donutLevelChart"></canvas>
                    </div>
                </div>
            @elseif (User()->role === "MENTOR")
                <div class="row">
                    <div class="col-8">
                        <p class="text-center fw-bold">Grafik Bar untuk Total Peserta yang Dibimbing berdasarkan Level</p>
                        <canvas id="barChart"></canvas>
                    </div>
                    <div class="col-4">
                        <p class="text-center fw-bold">Grafik Donat untuk Status Peserta yang Dibimbing</p>
                        <canvas id="donutStatusChart"></canvas>
                    </div>
                </div>

                <h3 class="text-center mt-5">Peserta yang Dibimbing</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-center table-sm text-sm">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Institusi</th>
                                <th>Level</th>
                                <th>Mulai</th>
                                <th>Berakhir</th>
                                <th>Waktu Tersisa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mentoredParticipants as $participant)
                                <tr>
                                    <td>{{ $participant->full_name }}</td>
                                    <td>{{ $participant->institution }}</td>
                                    <td>{{ $participant->level }}</td>
                                    <td>{{ Carbon\Carbon::parse($participant->start_date)->format("d F Y") }}</td>
                                    <td>{{ Carbon\Carbon::parse($participant->end_date)->format("d F Y") }}</td>
                                    <td>
                                        @php
                                            $remainingDays = $participant->end_date
                                                ? \Carbon\Carbon::parse($participant->end_date)->diffInDays(
                                                    Carbon\Carbon::now(),
                                                )
                                                : 0;
                                        @endphp
                                        {{ $remainingDays }} hari
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            @elseif (User()->role === "PARTICIPANT")
               
                <div class="row mt-5">
                    <div class="col-md-6">
                        <!-- Timeline Magang -->
                        <div class="mb-3">
                            <p class="fw-bold">Timeline Magang</p>
                            <p class="fw-bold">
                                Sisa Waktu Magang: <strong>{{ $internship_status["days_remaining"] }}
                                    hari</strong></p>
                            <canvas id="timelineChart"></canvas>
                        </div>
                        <div class="mb-3">
                            <p class="fw-bold">History Logbook & Absensi</p>
                            <canvas id="historyChart"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <p class="fw-bold mb-3">Penilaian (Assessment)</p>

                            @if (
                                !empty($auth["participant"]) &&
                                    !empty($auth["participant"]["assessments"]) &&
                                    count($auth["participant"]["assessments"]) > 0)
                                <ol class="list-group list-group-numbered list-group-flush mb-3">
                                    @foreach ($auth["participant"]["assessments"] as $assessment)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-start list-group-item-action">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">
                                                    {{ Illuminate\Support\Str::limit($assessment["indicator_component"] ?? "Indikator Tidak Ditemukan", 30, "...") }}
                                                </div>
                                            </div>
                                            <span class="badge bg-primary rounded-pill">{{ $assessment["score"] }}</span>
                                        </li>
                                    @endforeach
                                </ol>

                                <div class="text-center">
                                    <a href="{{ base_url("/certificate/" . $auth["participant"]["id"] . "/print") }}"
                                        class="btn btn-success d-grid" target="_blank">
                                        Download Sertifikat
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-warning text-center" role="alert">
                                    Belum ada data penilaian tersedia.
                                </div>
                                <div class="text-center">
                                    <a href="{{ base_url("/certificate/" . ($auth["participant"]["id"] ?? 0) . "/print") }}"
                                        class="btn btn-secondary disabled d-grid">
                                        Download Sertifikat
                                    </a>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            @endif

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                @if (User()->role === "ADMIN")
                    // Grafik untuk Admin
                    const barData = {
                        labels: @json($charts["total_counts"]["labels"] ?? []),
                        datasets: [{
                            label: "Jumlah",
                            data: @json($charts["total_counts"]["values"] ?? []),
                            backgroundColor: ['#4CAF50', '#FFC107', '#2196F3']
                        }]
                    };

                    const donutStatusData = {
                        labels: @json($charts["status_donut"]["labels"] ?? []),
                        datasets: [{
                            data: @json($charts["status_donut"]["values"] ?? []),
                            backgroundColor: ['#28a745', '#dc3545', '#ffc107']
                        }]
                    };

                    const donutLevelData = {
                        labels: @json($charts["level_donut"]["labels"] ?? []),
                        datasets: [{
                            data: @json($charts["level_donut"]["values"] ?? []),
                            backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6c757d', '#17a2b8']
                        }]
                    };

                    new Chart(document.getElementById("barChart"), {
                        type: "bar",
                        data: barData,
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    new Chart(document.getElementById("donutStatusChart"), {
                        type: "doughnut",
                        data: donutStatusData,
                        options: {
                            responsive: true
                        }
                    });
                    new Chart(document.getElementById("donutLevelChart"), {
                        type: "doughnut",
                        data: donutLevelData,
                        options: {
                            responsive: true
                        }
                    });
                @elseif (User()->role === "MENTOR")
                    // Grafik untuk Mentor
                    const barDataMentor = {
                        labels: @json($charts["total_participants"]["labels"] ?? []),
                        datasets: [{
                            label: "Jumlah Peserta",
                            data: @json($charts["total_participants"]["values"] ?? []),
                            backgroundColor: ['#4CAF50', '#FFC107', '#2196F3', '#17a2b8', '#dc3545', '#6c757d',
                                '#007bff'
                            ]
                        }]
                    };
                    const donutStatusDataMentor = {
                        labels: @json($charts["status_donut"]["labels"] ?? []),
                        datasets: [{
                            data: @json($charts["status_donut"]["values"] ?? []),
                            backgroundColor: ['#28a745', '#dc3545', '#ffc107']
                        }]
                    };

                    new Chart(document.getElementById("barChart"), {
                        type: "bar",
                        data: barDataMentor,
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    new Chart(document.getElementById("donutStatusChart"), {
                        type: "doughnut",
                        data: donutStatusDataMentor,
                        options: {
                            responsive: true
                        }
                    });
                @elseif (User()->role === "PARTICIPANT")
                    // Grafik Timeline Magang (Stacked Horizontal Bar Chart)
                    const timelineData = {
                        labels: ["Masa Magang"],
                        datasets: [{
                            label: "Hari Terlewati",
                            data: [@json($internship_status["days_passed"])],
                            backgroundColor: "#4CAF50"
                        }, {
                            label: "Hari Tersisa",
                            data: [@json($internship_status["days_remaining"])],
                            backgroundColor: "#FFC107"
                        }]
                    };

                    const timelineConfig = {
                        type: "bar",
                        data: timelineData,
                        options: {
                            indexAxis: "y",
                            responsive: true,
                            scales: {
                                x: {
                                    stacked: true,
                                    title: {
                                        display: true,
                                        text: "Hari"
                                    },
                                    min: 0,
                                    max: @json($internship_status["total_days"])
                                },
                                y: {
                                    stacked: true
                                }
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: "Timeline Magang"
                                },
                                legend: {
                                    position: "bottom"
                                }
                            }
                        }
                    };

                    new Chart(document.getElementById("timelineChart"), timelineConfig);

                    // Grafik Line Chart History Logbook & Absensi
                    const historyData = {
                        labels: @json($logbookHistory["labels"] ?? []),
                        datasets: [{
                            label: "Logbook",
                            data: @json($logbookHistory["logbook"] ?? []),
                            borderColor: "#4CAF50",
                            fill: false,
                            tension: 0.1
                        }, {
                            label: "Absensi",
                            data: @json($logbookHistory["presence"] ?? []),
                            borderColor: "#FFC107",
                            fill: false,
                            tension: 0.1
                        }]
                    };

                    new Chart(document.getElementById("historyChart"), {
                        type: "line",
                        data: historyData,
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: "bottom"
                                },
                                title: {
                                    display: true,
                                    text: "History Logbook dan Absensi"
                                }
                            }
                        }
                    });
                @endif
            </script>
        </div>
    </div>
@endsection
