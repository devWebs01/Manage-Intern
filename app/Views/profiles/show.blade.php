@extends("components.layout")

@section("header")
    <li class="breadcrumb-item">
        <a href="{{ site_url("profiles") }}">
            Profil Akun
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">
            {{ $profile->username }}
        </a>
    </li>
@endsection

@section("content")
    <div class="card rounded">
        <div class="card-body">
            <form action="{{ site_url("profiles/" . User()->id) }}" method="post">
                <div class="d-none">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                </div>
                <div class="row">
                    <!-- Data User -->
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control {{ session("errors.email") ? "is-invalid" : "" }}"
                            name="email" id="email" value="{{ old("email", $profile->email) }}">
                        @if (session("errors.email"))
                            <div class="invalid-feedback">
                                {{ session("errors.email") }}
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">
                            {{ User()->role === "PARTICIPANT" ? "Username" : "Nama Lengkap" }}
                        </label>
                        <input type="text" class="form-control {{ session("errors.username") ? "is-invalid" : "" }}"
                            name="username" id="username" value="{{ old("username", $profile->username) }}">
                        @if (session("errors.username"))
                            <div class="invalid-feedback">
                                {{ session("errors.username") }}
                            </div>
                        @endif
                    </div>

                    <div class="col-12 mb-3">
                        <label for="password" class="form-label">Password (kosongkan jika tidak diubah)</label>
                        <input type="password" class="form-control {{ session("errors.password") ? "is-invalid" : "" }}"
                            name="password" id="password">
                        @if (session("errors.password"))
                            <div class="invalid-feedback">
                                {{ session("errors.password") }}
                            </div>
                        @endif
                    </div>

                    @if ($profile->role === "PARTICIPANT")
                        <!-- Data Partisipan -->
                        <div class="col-md-6 mb-3">
                            <label for="full_name" class="form-label">Nama Lengkap</label>
                            <input type="text"
                                class="form-control {{ session("errors.full_name") ? "is-invalid" : "" }}" name="full_name"
                                id="full_name" value="{{ old("full_name", $profile->participant->full_name ?? "") }}">
                            @if (session("errors.full_name"))
                                <div class="invalid-feedback">
                                    {{ session("errors.full_name") }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="institution" class="form-label">Institusi</label>
                            <input type="text"
                                class="form-control {{ session("errors.institution") ? "is-invalid" : "" }}"
                                name="institution" id="institution"
                                value="{{ old("institution", $profile->participant->institution ?? "") }}">
                            @if (session("errors.institution"))
                                <div class="invalid-feedback">
                                    {{ session("errors.institution") }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="level">Tingkat Pendidikan</label>
                                <select name="level" id="level"
                                    class="form-control {{ session("errors.level") ? "is-invalid" : "" }}" required>
                                    <option value="" disabled>Pilih Tingkat Pendidikan</option>
                                    @foreach (["SMA", "SMK", "D3", "S1", "S2", "Other"] as $level)
                                        <option value="{{ $level }}"
                                            {{ old("level", $profile->participant->level ?? "") == $level ? "selected" : "" }}>
                                            {{ $level }}
                                        </option>
                                    @endforeach
                                </select>
                                @if (session("errors.level"))
                                    <div class="invalid-feedback">
                                        {{ session("errors.level") }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date"
                                class="form-control {{ session("errors.start_date") ? "is-invalid" : "" }}"
                                name="start_date" id="start_date"
                                value="{{ old("start_date", $profile->participant->start_date ?? "") }}">
                            @if (session("errors.start_date"))
                                <div class="invalid-feedback">
                                    {{ session("errors.start_date") }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control {{ session("errors.end_date") ? "is-invalid" : "" }}"
                                name="end_date" id="end_date"
                                value="{{ old("end_date", $profile->participant->end_date ?? "") }}">
                            @if (session("errors.end_date"))
                                <div class="invalid-feedback">
                                    {{ session("errors.end_date") }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status"
                                class="form-control {{ session("errors.status") ? "is-invalid" : "" }}" required>
                                <option value="" disabled>Pilih Status</option>
                                @foreach (["Active", "Completed", "Dropped"] as $status)
                                    <option value="{{ $status }}"
                                        {{ old("status", $profile->participant->status ?? "") == $status ? "selected" : "" }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            @if (session("errors.status"))
                                <div class="invalid-feedback">
                                    {{ session("errors.status") }}
                                </div>
                            @endif
                        </div>

                        <div class="col-12 mb-3">
                            <label for="mentor_id" class="form-label">Pembimbing</label>
                            <select class="form-select" name="mentor_id" id="mentor_id">
                                <option value="" disabled selected>Select one</option>
                                @foreach ($mentors as $mentor)
                                    <option value="{{ $mentor->id }}"
                                        {{ old("mentor_id", $profile->participant->mentor_id ?? "") == $mentor->id ? "selected" : "" }}>
                                        {{ $mentor->username }}
                                    </option>
                                @endforeach
                            </select>
                            @if (session("errors.mentor_id"))
                                <div class="invalid-feedback">
                                    {{ session("errors.mentor_id") }}
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
