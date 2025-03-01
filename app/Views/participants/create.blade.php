@extends('components.layout')

@section('header')
    <li class="breadcrumb-item">
        <a href="{{ site_url('participants') }}">
            Peserta
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">
           Peserta Baru
        </a>
    </li>
@endsection

@section('content')
    <div class="card rounded">

        <div class="card-body">
            @if (session('errors'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach (session('errors') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ site_url('participants') }}" method="post">
                <div class="d-none">{{ csrf_field() }}</div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            value="{{ old('email') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username"
                            value="{{ old('username') }}">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="full_name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="full_name" id="full_name"
                            value="{{ old('full_name') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="institution" class="form-label">Institusi</label>
                        <input type="text" class="form-control" name="institution" id="institution"
                            value="{{ old('institution') }}">
                    </div>

                    {{-- 'SMA', 'SMK', 'D3', 'S1', 'S2', 'Other' --}}

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="level">Tingkat Pendidikan</label>
                            <select name="level" id="level" class="form-control" required>
                                <option value="" disabled selected>Pilih Tingkat Pendidikan</option>
                                @foreach (['SMA', 'SMK', 'D3', 'S1', 'S2', 'Other'] as $level)
                                    <option value="{{ $level }}" {{ old('level') == $level ? 'selected' : '' }}>
                                        {{ $level }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="start_date" id="start_date"
                            value="{{ old('start_date') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="end_date" id="end_date"
                            value="{{ old('end_date') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="status" class="form-label">Status</label>
    <select name="status" id="status" class="form-control" required>
        <option value="" disabled selected>Pilih Status</option>
        @foreach (['Active', 'Completed', 'Dropped'] as $status)
            <option value="{{ $status }}" 
                {{ old('status', $participant->status ?? 'Active') == $status ? 'selected' : '' }}>
                {{ $status }}
            </option>
        @endforeach
    </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
