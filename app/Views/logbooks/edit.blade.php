@extends("components.layout")

@section("header")
    <li class="breadcrumb-item">
        <a href="{{ site_url("logbooks") }}">
            Logbook
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">
            Edit Logbook
        </a>
    </li>
@endsection

@include("layouts.summernote")

@section("content")
    <div class="card rounded">
        <div class="card-body">
            <form action="{{ site_url("logbooks/" . $logbook->id) }}" method="post">
                <div class="d-none">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <!-- Jika participant_id tidak boleh diubah, tetap set sebagai hidden -->
                    <input type="hidden" name="participant_id" id="participant_id"
                        value="{{ user()->id ?? $logbook->participant_id }}" readonly>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date"
                            class="form-control
                        @error("date")
                        is-invalid
                        @enderror"
                            name="date" id="date" value="{{ $logbook->date }}">

                        @error("date")
                            <div class="invalid-feedback">
                                {{ session("errors")["date"] }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="activity" class="form-label">Isi Logbook</label>
                        <textarea
                            class="form-control
                        @error("activity")
                        is-invalid
                        @enderror"
                            name="activity" id="summernote" rows="10">{{ $logbook->activity }}</textarea>

                        @error("activity")
                            <div class="invalid-feedback">
                                {{ session("errors")["activity"] }}
                            </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
