@extends("components.layout")

@section("header")
    <li class="breadcrumb-item">
        <a href="/users">
            Admin
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="/users/create">
            Admin Baru
        </a>
    </li>
@endsection

@section("content")
    <div class="card">
        <div class="card-body">

            <form action="{{ site_url("users") }}" method="post">
                <div class="d-none">
                    {{ csrf_field() }}
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email"
                            class="form-control {{ isset(session("errors")["email"]) ? "is-invalid" : "" }}" name="email"
                            id="email" value="{{ old("email") }}">

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
                            name="username" id="username" value="{{ old("username") }}">

                        @error("username")
                            <div class="invalid-feedback">
                                {{ session("errors")["username"] }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="password" class="form-label">password</label>
                        <input type="password"
                            class="form-control {{ isset(session("errors")["password"]) ? "is-invalid" : "" }}"
                            name="password" id="password" value="{{ old("password") }}">

                        @error("password")
                            <div class="invalid-feedback">
                                {{ session("errors")["password"] }}
                            </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
