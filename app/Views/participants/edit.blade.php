@extends("components.layout")

@include("layouts.fancybox")

@section("header")
    <li class="breadcrumb-item">
        <a href="{{ site_url("participants") }}">
            Peserta
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">
            Edit Peserta
        </a>
    </li>
@endsection

@section("content")
    <div class="card rounded">
        @if (!empty($participant->user->avatar))
            <a href="{{ base_url($participant->user->avatar) }}" data-fancybox data-caption="Foto profil">
                <img src="{{ base_url($participant->user->avatar) }}" alt="Foto profil" class="card-img-top" width="100%"
                    height="200px" style="object-fit: cover;">
            </a>
        @else
            <div class="d-flex justify-content-center align-items-center bg-light text-muted border rounded"
                style="width: 100%; height: 200px;">
                <span class="fs-5">Foto Profil Tidak Tersedia</span>
            </div>
        @endif

        <div class="card-body">
            <form action="{{ site_url("participants/" . $participant->id) }}" method="post" enctype="multipart/form-data">
                <div class="d-none">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                </div>
                <div class="row">
                    <!-- Data User -->
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email"
                            class="form-control {{ isset(session("errors")["email"]) ? "is-invalid" : "" }}" name="email"
                            id="email" value="{{ old("email", $user->email) }}">
                        @error("email")
                            <div class="invalid-feedback">
                                {{ session("errors")["email"] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text"
                            class="form-control {{ isset(session("errors")["username"]) ? "is-invalid" : "" }}"
                            name="username" id="username" value="{{ old("username", $user->username) }}">
                        @error("username")
                            <div class="invalid-feedback">
                                {{ session("errors")["username"] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="password" class="form-label">Password (kosongkan jika tidak diubah)</label>
                        <input type="password"
                            class="form-control {{ isset(session("errors")["password"]) ? "is-invalid" : "" }}"
                            name="password" id="password">
                        @error("password")
                            <div class="invalid-feedback">
                                {{ session("errors")["password"] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="avatar" class="form-label">Foto Profil</label>
                        <input type="file"
                            class="form-control {{ isset(session("errors")["avatar"]) ? "is-invalid" : "" }}"
                            name="avatar" id="avatar">

                        @error("avatar")
                            <div class="invalid-feedback">
                                {{ session("errors")["avatar"] }}
                            </div>
                        @enderror
                    </div>

                    <!-- Data Partisipan -->
                    <div class="col-md-6 mb-3">
                        <label for="full_name" class="form-label">Nama Lengkap</label>
                        <input type="text"
                            class="form-control {{ isset(session("errors")["full_name"]) ? "is-invalid" : "" }}"
                            name="full_name" id="full_name" value="{{ old("full_name", $participant->full_name) }}">
                        @error("full_name")
                            <div class="invalid-feedback">
                                {{ session("errors")["full_name"] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="institution" class="form-label">Institusi</label>
                        <input type="text"
                            class="form-control {{ isset(session("errors")["institution"]) ? "is-invalid" : "" }}"
                            name="institution" id="institution"
                            value="{{ old("institution", $participant->institution) }}">
                        @error("institution")
                            <div class="invalid-feedback">
                                {{ session("errors")["institution"] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="level">Tingkat Pendidikan</label>
                            <select name="level" id="level"
                                class="form-control {{ isset(session("errors")["level"]) ? "is-invalid" : "" }}" required>
                                <option value="" disabled>Pilih Tingkat Pendidikan</option>
                                @foreach (["SMA", "SMK", "D3", "S1", "S2", "Other"] as $level)
                                    <option value="{{ $level }}"
                                        {{ old("level", $participant->level) == $level ? "selected" : "" }}>
                                        {{ $level }}
                                    </option>
                                @endforeach
                            </select>
                            @error("level")
                                <div class="invalid-feedback">
                                    {{ session("errors")["level"] }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date"
                            class="form-control {{ isset(session("errors")["start_date"]) ? "is-invalid" : "" }}"
                            name="start_date" id="start_date" value="{{ old("start_date", $participant->start_date) }}">
                        @error("start_date")
                            <div class="invalid-feedback">
                                {{ session("errors")["start_date"] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date"
                            class="form-control {{ isset(session("errors")["end_date"]) ? "is-invalid" : "" }}"
                            name="end_date" id="end_date" value="{{ old("end_date", $participant->end_date) }}">
                        @error("end_date")
                            <div class="invalid-feedback">
                                {{ session("errors")["end_date"] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status"
                            class="form-control {{ isset(session("errors")["status"]) ? "is-invalid" : "" }}" required>
                            <option value="" disabled>Pilih Status</option>
                            @foreach (["Active", "Completed", "Dropped"] as $status)
                                <option value="{{ $status }}"
                                    {{ old("status", $participant->status) == $status ? "selected" : "" }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                        @error("status")
                            <div class="invalid-feedback">
                                {{ session("errors")["status"] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="mentor_id" class="form-label">Pembimbing</label>
                        <select class="form-select" name="mentor_id" id="mentor_id">
                            <option selected>Select one</option>
                            @foreach ($mentors as $mentor)
                                <option value="{{ $mentor->id }}"
                                    {{ $participant->mentor_id === $mentor->id ? "selected" : "" }}>
                                    {{ $mentor->username }}</option>
                            @endforeach

                        </select>

                        @error("mentor_id")
                            <div class="invalid-feedback">
                                {{ session("errors")["mentor_id"] }}
                            </div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
