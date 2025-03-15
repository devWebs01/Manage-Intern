@extends("components.layout")

@section("header")
    <li class="breadcrumb-item">
        <a href="{{ site_url("assessment-indicators") }}">Indikator Penilaian</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">Edit Indikator</a>
    </li>
@endsection

@section("content")
    <div class="card rounded">
        <div class="card-header">
            <h4>Edit Indikator Penilaian</h4>
        </div>
        <div class="card-body">
            <form action="{{ site_url("assessment-indicators/" . $indicator->id) }}" method="post">
                <div class="d-none">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                </div>

                <div class="mb-3">
                    <label for="component" class="form-label">Komponen Penilaian</label>
                    <input type="text" name="component" id="component"
                        class="form-control 
                    {{ isset(session("errors")["component"]) ? "is-invalid" : "" }}"
                        value="{{ old("component", $indicator->component) }}
                    "
                        placeholder="Masukkan indikator">

                    @error("component")
                        <div class="invalid-feedback">
                            {{ session("errors")["component"] }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Indikator</button>
            </form>
        </div>
    </div>
@endsection
