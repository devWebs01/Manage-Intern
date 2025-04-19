@extends("components.layout")

@include("layouts.table")

@section("header")
    <li class="breadcrumb-item">
        <a href="{{ site_url("logbooks") }}">
            Logbook
        </a>
    </li>
@endsection

@section("content")
    <div class="card rounded">
        <div class="card-body">

            <div class="mb-3">
                <a href="{{ site_url("logbooks/new") }}" class="btn btn-primary">Tambah Logbook</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logbooks as $no => $logbook)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $logbook->participant->user->username }}</td>
                                <td>{{ $logbook->participant->full_name }}</td>
                                <td>{{ Carbon\Carbon::parse($logbook->date)->format("d M Y") }}</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ site_url("logbooks/" . $logbook->id . "/edit") }}"
                                            class="btn btn-sm btn-sm btn-warning">Edit</a>

                                        <form action="{{ site_url("logbooks/" . $logbook->id) }}" method="post"
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
