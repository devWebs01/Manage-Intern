@extends("components.layout")

@include("layouts.table")

@section("header")
    <li class="breadcrumb-item">
        <a href="{{ site_url("assessment-indicators") }}">Indikator Penilaian</a>
    </li>
@endsection

@section("content")
    <div class="card rounded">
        <div class="card-body">
            <a href="{{ site_url("assessment-indicators/new") }}" class="btn btn-primary">Tambah Indikator</a>

            <div class="table-responsive">
                <table class="table table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kompenen Penilaian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($indicators as $index => $indicator)
                            <tr>
                                <td>{{ ++$index }}.</td>
                                <td>{{ $indicator->component }}</td>
                                <td>
                                    <a href="{{ site_url("assessment-indicators/edit/" . $indicator->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ site_url("assessment-indicators/" . $indicator->id) }}" method="post"
                                        style="display:inline;">
                                        <div class="d-none">
                                            {{ csrf_field() }}
                                        </div>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus indikator ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
