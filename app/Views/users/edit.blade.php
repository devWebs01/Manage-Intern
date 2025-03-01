@extends('components.layout')

@section('header')
    <li class="breadcrumb-item">
        <a href="/users">
            Pengguna
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="/users/create">
            {{ $user->username }}
        </a>
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">


            @if (session('errors'))
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach (session('errors') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ site_url('users/' . $user->id) }}" method="post">
                <div class="d-none">
                {{ csrf_field() }}
                 <input type="hidden" name="_method" value="PUT">
                </div>
                
                <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email"
                        value="{{ old('email', $user->email) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username"
                        value="{{ old('username', $user->username) }}">
                </div>
                <div class="col-12 mb-3">
                    <label for="password" class="form-label">Password (kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
