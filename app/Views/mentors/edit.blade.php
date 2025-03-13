@extends('components.layout')

@section('header')
    <li class="breadcrumb-item">
        <a href="/mentors">
            Pembimbing
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="/mentors/create">
            {{ $user->username }}
        </a>
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
        
            <form action="{{ site_url('mentors/' . $user->id) }}" method="post">
                <div class="d-none">
                {{ csrf_field() }}
                 <input type="hidden" name="_method" value="PUT">
                </div>
                
                 <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control {{ isset(session('errors')['email']) ? 'is-invalid' : '' }}"
                            name="email" id="email" value="{{ $user->email ?? '' }}">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ session('errors')['email'] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control {{ isset(session('errors')['username']) ? 'is-invalid' : '' }}"
                            name="username" id="username" value="{{ $user->username ?? '' }}">

                        @error('username')
                            <div class="invalid-feedback">
                                {{ session('errors')['username'] }}
                            </div>
                        @enderror
                    </div>
                   <div class="col-12 mb-3">
                        <label for="password" class="form-label">Password (kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" class="form-control {{ isset(session('errors')['password']) ? 'is-invalid' : '' }}"
                            name="password" id="password">

                        @error('password')
                            <div class="invalid-feedback">
                                {{ session('errors')['password'] }}
                            </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
