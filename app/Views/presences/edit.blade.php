@extends("components.layout")

@section("header")
    <li class="breadcrumb-item">
        <a href="javascript:history.back()">
            Absensi
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">
            Jam Keluar
        </a>
    </li>
@endsection

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{ site_url("presences/" . $presence->id) }}" method="post">
                <div class="d-none">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" name="date" class="form-control" value="{{ $presence->date }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="check_in" class="form-label">Jam Masuk</label>
                    <input type="time" name="check_in" class="form-control" value="{{ $presence->check_in }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="check_out" class="form-label">Jam Keluar</label>
                    <input type="time" name="check_out" class="form-control"
                        value="{{ Carbon\Carbon::now("Asia/Jakarta")->format("H:i:s") }}" readonly>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
