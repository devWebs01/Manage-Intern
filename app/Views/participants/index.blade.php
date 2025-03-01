@extends('components.layout')

@include('layouts.table')

@section('header')
    <li class="breadcrumb-item">
        <a href="{{ site_url('participants') }}">
            Peserta
        </a>
    </li>
@endsection

@section('content')
    <div class="card rounded">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                <a href="{{ site_url('participants/create') }}" class="btn btn-primary">Tambah Peserta</a>
            </div>

            <div class="table-responsive">
                <table class="table text-center text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                            <th>Institusi</th>
                            <th>Level</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($participants as $participant)
                            <?php $user = model('App\Models\UserModel')->find($participant->user_id); ?>
                            <tr>
                                <td>{{ $participant->id }}</td>
                                <td>{{ $participant->full_name }}</td>
                                <td>{{ $participant->institution }}</td>
                                <td>{{ $participant->level }}</td>
                                <td>{{ $participant->start_date }}</td>
                                <td>{{ $participant->end_date }}</td>
                                <td>{{ $participant->status }}</td>
                                <td>{{ $participant->user->email }}</td>
                                <td>
                                    <a href="{{ site_url('participants/edit/' . $participant->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ site_url('participants/delete' . $participant->id) }}"
                                        class="btn btn-sm btn-danger" onclick="return confirm('Hapus partisipan?')"
                                        data-method="delete">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
