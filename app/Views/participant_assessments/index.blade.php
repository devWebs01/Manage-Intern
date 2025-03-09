@extends('components.layout')

@include('layouts.table')

@section('header')
    <li class="breadcrumb-item">
        <a href="{{ site_url('participant-assessments') }}">Penilaian Peserta</a>
    </li>
@endsection

@section('content')
    <div class="card rounded">
        <div class="card-body">
            <a href="{{ site_url('participant-assessments/new') }}" class="btn btn-primary">Tambah Penilaian Peserta</a>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Peserta</th>
                            <th>Penilaian</th>
                            <th>Sertifikat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assessments as $index => $assessment)
                            <tr>
                                <td>{{ ++$index }}.</td>
                                <td>{{ $assessment->full_name }}</td>
                                <td>{{ $assessment->assessments }}</td>
                                <td>{{ $assessment->assessments }}</td>
                                <td>
                                    <a href="{{ site_url('participant-assessments/' . $assessment->id) . '/edit' }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ site_url('participant-assessments/' . $assessment->id) }}"
                                        method="post" style="display:inline;">
                                        <div class="d-none">
                                            {{ csrf_field() }}
                                        </div>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus indikator ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
