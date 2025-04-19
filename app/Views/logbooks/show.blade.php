@extends("components.layout")

@section("header")
    <li class="breadcrumb-item">
        <a href="javascript:history.back()">
            Logbook
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">
            Detail Logbook
        </a>
    </li>
@endsection

@section("content")
    <div class="card rounded">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label fw-bold">Tanggal</label>
                <div class="form-control bg-light" readonly>
                    {{ date("d M Y", strtotime($logbook->date)) }}
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Isi Logbook</label>
                <div class="border p-3 rounded bg-light" style="min-height: 150px">
                    {!! $logbook->activity !!}
                </div>
            </div>
        </div>
    </div>
@endsection
