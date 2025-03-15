@extends("components.layout")

@include("layouts.table")

@section("header")
    <li class="breadcrumb-item">
        <a href="{{ site_url("participants") }}">
            Peserta
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
                <a href="{{ site_url("participants/new") }}" class="btn btn-primary">Tambah Peserta</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Lengkap</th>
                            <th>Institusi</th>
                            <th>Tingkat</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($participants as $no => $participant)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $participant->full_name }}</td>
                                <td>{{ $participant->institution }}</td>
                                <td>{{ $participant->level }}</td>
                                <td>{{ Carbon\Carbon::parse($participant->start_date)->format("d M Y") }}</td>
                                <td>{{ Carbon\Carbon::parse($participant->end_date)->format("d M Y") }}</td>
                                <td>{{ $participant->status }}</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ site_url("participants/" . $participant->id . "/edit") }}"
                                            class="btn btn-sm btn-warning">Edit</a>

                                        <form action="{{ site_url("participants/" . $participant->id) }}" method="post"
                                            onsubmit="return confirm('Yakin ingin menghapus?');">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
@endsection
