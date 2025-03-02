@extends('components.layout')

@section('header')
    <li class="breadcrumb-item">
        <a href="/logbooks">
            Logbook
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="/logbooks/create">
            {{ $logbook->date }}
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

            <form action="{{ site_url('logbooks/' . $logbook->id) }}" method="post">
                <div class="d-none">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">

                    <input type="hidden" name="participant_id" id="participant_id" value="{{ user_id() }}" readonly>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control " name="date" id="date"
                            value="{{ $logbook->date }}">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="activity" class="form-label">Isi Logbook</label>
                        <textarea class="form-control" name="activity" id="activity" rows="3">

                        {{ $logbook->activity }}

                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
