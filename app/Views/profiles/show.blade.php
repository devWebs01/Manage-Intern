@extends("components.layout")

@include("layouts.fancybox")

@section("header")
    <li class="breadcrumb-item">
        <a href="javascript:history.back()">
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
    @if (session("success"))
        <div class="alert alert-success">
            {{ session("success") }}
        </div>
    @endif

    <div class="card rounded">

        @if (!empty($profile->avatar))
            <a href="{{ base_url($profile->avatar) }}" data-fancybox data-caption="Foto profil">
                <img src="{{ base_url($profile->avatar) }}" alt="Foto profil" class="card-img-top" width="100%"
                    height="200px" style="object-fit: cover;">
            </a>
        @else
            <div class="d-flex justify-content-center align-items-center bg-light text-muted border rounded"
                style="width: 100%; height: 200px;">
                <span class="fs-5">Foto Profil Tidak Tersedia</span>
            </div>
        @endif

        <div class="card-body">
            <form action="{{ site_url("profiles/" . User()->id) }}" method="post" enctype="multipart/form-data">
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

                    @if ($profile->role === "PARTICIPANT")
                        <!-- Data Partisipan -->
                        <div class="col-md-12 mb-3">
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
                                value="{{ old("start_date", $profile->participant->start_date ?? "") }}" disabled>
                            @if (session("errors.start_date"))
                                <div class="invalid-feedback">
                                    {{ session("errors.start_date") }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">Tanggal Selesai</label>
                            <input type="date"
                                class="form-control {{ session("errors.end_date") ? "is-invalid" : "" }}" name="end_date"
                                id="end_date" value="{{ old("end_date", $profile->participant->end_date ?? "") }}"
                                disabled>
                            @if (session("errors.end_date"))
                                <div class="invalid-feedback">
                                    {{ session("errors.end_date") }}
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
