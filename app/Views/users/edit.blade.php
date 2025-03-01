@extends('components.layout')

@section('content')
<div class="container mt-5">
    <h1>Edit User</h1>
    
    @if(session('errors'))
      <div class="alert alert-danger">
          <ul class="mb-0">
          @foreach(session('errors') as $error)
              <li>{{ $error }}</li>
          @endforeach
          </ul>
      </div>
    @endif

    <form action="{{ site_url('users/update/'.$user->id) }}" method="post">
      <div class="d-none">{{ csrf_field() }}</div>
      <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}">
      </div>
      <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" id="username" value="{{ old('username', $user->username) }}">
      </div>
      <div class="mb-3">
          <label for="password" class="form-label">Password (kosongkan jika tidak ingin mengubah)</label>
          <input type="password" class="form-control" name="password" id="password">
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
