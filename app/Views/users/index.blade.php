@extends("components.layout")

@include("layouts.table")

@section("header")
    <li class="breadcrumb-item">
        <a href="{{ site_url("users") }}">
            Admin
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
                <a href="{{ site_url("users/new") }}" class="btn btn-primary">Tambah Admin</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped text-nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $no => $user)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ site_url("users/" . $user->id . "/edit") }}"
                                            class="btn btn-sm btn-sm btn-warning">Edit</a>

                                        <form action="{{ site_url("users/" . $user->id) }}" method="post"
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
