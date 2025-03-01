@extends('components.layout')

@section('header')
    <li class="breadcrumb-item">
        <a href="/users">
            Pengguna
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="/users/create">
            Pengguna Baru
        </a>
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            @if(session('errors'))
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach(session('errors') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ site_url('users/store') }}" method="post">
                <div class="d-none">
                    {{ csrf_field() }}
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection