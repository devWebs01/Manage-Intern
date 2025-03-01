@extends('components.layout')

@include('layouts.table')

@section('header')
    <li class="breadcrumb-item">
        <a href="{{ site_url('users') }}">
            Pengguna
        </a>
    </li>
@endsection

@section('content')
    <div class="card rounded">
        <div class="card-body">
           @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-3">
                    <a href="{{ site_url('users/create') }}" class="btn btn-primary">Tambah User</a>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    <a href="{{ site_url('users/edit/' . $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ site_url('users/delete/' . $user->id) }}" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus user?')">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@endsection