@extends("components.layout")

@section("header")
    <li class="breadcrumb-item">
        <a href="{{ site_url("participants") }}">
            Absensi
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">
            Jam Masuk
        </a>
    </li>
@endsection

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{ site_url("presences") }}" method="post">
               
                <div class="d-none">
                    {{ csrf_field() }}
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" value="{{ Carbon\Carbon::now('Asia/Jakarta')->format("Y-m-d") }}" name="date"
                        class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label for="check_in" class="form-label">Jam Masuk</label>
                    <input type="time" value="{{ Carbon\Carbon::now('Asia/Jakarta')->format("H:i:s") }}" name="check_in"
                        class="form-control" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
