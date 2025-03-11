@extends('components.layout')

@section('header')
    <li class="breadcrumb-item">
        <a href="{{ site_url('participant-assessments') }}">Penilaian Peserta</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">Penilaian Baru</a>
    </li>
@endsection

@section('content')
    <div class="card rounded">
        <div class="card-body">
            <form action="{{ site_url('participant-assessments') }}" method="post">
                <div class="d-none">
                    {{ csrf_field() }}
                </div>

                <div class="row">
                    <h5 class="fw-bold">Peserta</h5>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="full_name" id="full_name"
                                value="{{ $participant->full_name }}" aria-describedby="helpId" placeholder="full_name" readonly />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="institution" class="form-label">Pendidikan</label>
                            <input type="text" class="form-control" name="institution" id="institution"
                                value="{{ $participant->institution }}" aria-describedby="helpId"
                                placeholder="institution" readonly />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="level" class="form-label">Tingkat</label>
                            <input type="text" class="form-control" name="level" id="level"
                                value="{{ $participant->level }}" aria-describedby="helpId" placeholder="level" readonly />
                        </div>
                    </div>
                    <div class="d-none">
                        <input type="hidden" name="participant_id" value="{{ $participant->id }}">
                    </div>
                </div>

                <hr>

                <h5 class="fw-bold mt-5">Penilaian</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center">
                        <thead>
                            <tr>
                                <th class="fw-bold">Penilaian</th>
                                <th class="fw-bold">Bobot</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($indicators as $indicator)
                                <tr>
                                    <td>{{ $indicator->component }}</td>
                                    <td>
                                        <input type="number" name="scores[{{ $indicator->id }}]"
                                            id="score_{{ $indicator->id }}" class="form-control"
                                            value="{{ old('scores.' . $indicator->id) }}">
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>


                <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
            </form>
        </div>
    </div>
@endsection
