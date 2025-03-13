@extends('components.layout')

@section('header')
    <li class="breadcrumb-item">
        <a href="{{ site_url('logbooks') }}">
            Logbook
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">
            Logbook Baru
        </a>
    </li>
@endsection

@section('content')
    <div class="card rounded">
        <div class="card-body">
            <form action="{{ site_url('logbooks') }}" method="post">
                <div class="d-none">
                    {{ csrf_field() }}
                    <!-- Contoh: Mengambil participant_id dari fungsi helper user() -->
                    <input type="hidden" name="participant_id" id="participant_id" value="{{ user()->id ?? '' }}" readonly>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control
                        @error('date')
                        is-invalid
                        @enderror
                        " name="date" id="date" value="{{ old('date') }}">
                         @error('date')
                            <div class="invalid-feedback">
                                {{ session('errors')['date'] }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="activity" class="form-label">Isi Logbook</label>
                        <textarea class="form-control 
                        @error('activity')
                        is-invalid
                        @enderror" name="activity" id="activity" rows="10">{{ old('activity') }}</textarea>
                         @error('activity')
                            <div class="invalid-feedback">
                                {{ session('errors')['activity'] }}
                            </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
