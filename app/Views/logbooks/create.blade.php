@extends('components.layout')

@section('header')
    <li class="breadcrumb-item">
        <a href="/logbooks">
            Logbook
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="/logbooks/new">
            Logbook Baru
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

            <form action="{{ site_url('logbooks') }}" method="post">
                <div class="d-none">
                    {{ csrf_field() }}
                    <input type="hidden" name="participant_id" id="participant_id" value="{{ user()->id }}" readonly>
                </div>
                <div class="row">
                <div class="col-12 mb-3">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" class="form-control " name="date" id="date" value="{{ old('date') }}">
                </div>
                <div class="col-12 mb-3">
                    <label for="activity" class="form-label">Isi Logbook</label>
                    <textarea class="form-control" name="activity" id="activity" rows="3"></textarea>
                </div>

                
                
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection