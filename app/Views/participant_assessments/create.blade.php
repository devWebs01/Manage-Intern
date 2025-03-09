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

                <div class="mb-3">
                    <label for="participant_id" class="form-label">Peserta</label>
                    <select class="form-select" name="participant_id" id="participant_id">
                        <option selected>Select one</option>
                        @foreach ($participants as $participant)
                            <option value="{{ $participant->id }}">
                            {{$participant->full_name}}
                            </option>
                        @endforeach
                    </select>
                </div>



                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center">
                        <thead>
                            <tr>
                                <th  class="fw-bold">Penilaian</th>
                                <th  class="fw-bold">Bobot</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($indicators as $indicator)
                                <tr>
                                <td>{{ $indicator->component }}</td>
                                    <td>
                                        <input type="number" step="0.01" name="scores[{{ $indicator->id }}]"
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