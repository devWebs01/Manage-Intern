@extends('components.layout')

@section('header')
    <li class="breadcrumb-item">
        <a href="{{ site_url('assessment-indicators') }}">Indikator Penilaian</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">Edit Indikator</a>
    </li>
@endsection

@section('content')
    <div class="card rounded">
        <div class="card-header">
            <h4>Edit Indikator Penilaian</h4>
        </div>
        <div class="card-body">
            <form action="{{ site_url('assessment-indicators/' . $indicator->id) }}" method="post">
                <div class="d-none">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Indikator</label>
                    <input type="text" name="name" id="name" class="form-control {{ isset(session('errors')['name']) ? 'is-invalid' : '' }}" value="{{ old('name', $indicator->name) }}" placeholder="Masukkan nama indikator">
                    @if(session('errors.name'))
                        <div class="invalid-feedback">
                            {{ session('errors')['name'] }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control {{ isset(session('errors')['description']) ? 'is-invalid' : '' }}" rows="3" placeholder="Masukkan deskripsi indikator">{{ old('description', $indicator->description) }}</textarea>
                    @if(session('errors.description'))
                        <div class="invalid-feedback">
                            {{ session('errors')['description'] }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="weight" class="form-label">Bobot</label>
                    <input type="number" step="0.01" name="weight" id="weight" class="form-control {{ isset(session('errors')['weight']) ? 'is-invalid' : '' }}" value="{{ old('weight', $indicator->weight) }}" placeholder="Masukkan bobot indikator">
                    @if(session('errors.weight'))
                        <div class="invalid-feedback">
                            {{ session('errors')['weight'] }}
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update Indikator</button>
            </form>
        </div>
    </div>
@endsection
