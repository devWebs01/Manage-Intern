@extends('components.layout')

@section('header')
    <li class="breadcrumb-item">
        <a href="{{ site_url('participant-assessments') }}">Penilaian Peserta</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">Edit Penilaian</a>
    </li>
@endsection

@section('content')
    <div class="card rounded">
        <div class="card-body">
            <form action="{{ site_url('participant-assessments/' . $assessment->id) }}" method="post">
                <div class="d-none">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                </div>
                <h4>Edit Penilaian untuk Indikator: {{ $indicator->name }}</h4>
                <div class="mb-3">
                    <label for="score" class="form-label">Nilai</label>
                    <input type="number" step="0.01" name="score" id="score" class="form-control" value="{{ old('score', $assessment->score) }}">
                </div>
                <div class="mb-3">
                    <label for="comments" class="form-label">Komentar</label>
                    <textarea name="comments" id="comments" class="form-control" rows="3">{{ old('comments', $assessment->comments) }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Penilaian</button>
            </form>
        </div>
    </div>
@endsection
