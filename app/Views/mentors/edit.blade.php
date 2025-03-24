@extends("components.layout")

@include("layouts.fancybox")

@section("header")
    <li class="breadcrumb-item">
        <a href="{{ base_url("/mentors") }}">
            Pembimbing
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ base_url("/mentors/create") }}">
            {{ $user->username }}
        </a>
    </li>
@endsection

@section("content")
    <div class="card">
        @if (!empty($user->avatar))
            <a href="{{ base_url($user->avatar) }}" data-fancybox data-caption="Foto profil">
                <img src="{{ base_url($user->avatar) }}" alt="Foto profil" class="card-img-top" width="100%" height="200px"
                    style="object-fit: cover;">
            </a>
        @else
            <div class="d-flex justify-content-center align-items-center bg-light text-muted border rounded"
                style="width: 100%; height: 200px;">
                <span class="fs-5">Foto Profil Tidak Tersedia</span>
            </div>
        @endif

        <div class="card-body">

            <form action="{{ site_url("mentors/" . $user->id) }}" method="post" enctype="multipart/form-data">
                <div class="d-none">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email"
                            class="form-control {{ isset(session("errors")["email"]) ? "is-invalid" : "" }}" name="email"
                            id="email" value="{{ $user->email ?? "" }}">

                        @error("email")
                            <div class="invalid-feedback">
                                {{ session("errors")["email"] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Nama Lengkap</label>
                        <input type="text"
                            class="form-control {{ isset(session("errors")["username"]) ? "is-invalid" : "" }}"
                            name="username" id="username" value="{{ $user->username ?? "" }}">

                        @error("username")
                            <div class="invalid-feedback">
                                {{ session("errors")["username"] }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="password" class="form-label">Password (kosongkan jika tidak ingin mengubah)</label>
                        <input type="password"
                            class="form-control {{ isset(session("errors")["password"]) ? "is-invalid" : "" }}"
                            name="password" id="password">

                        @error("password")
                            <div class="invalid-feedback">
                                {{ session("errors")["password"] }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label for="avatar" class="form-label">Foto Profil</label>
                    <input type="file" class="form-control {{ isset(session("errors")["avatar"]) ? "is-invalid" : "" }}"
                        name="avatar" id="avatar">

                    @error("avatar")
                        <div class="invalid-feedback">
                            {{ session("errors")["avatar"] }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
