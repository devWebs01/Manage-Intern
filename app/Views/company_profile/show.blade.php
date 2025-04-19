@extends("components.layout")

@include("layouts.fancybox")

@section("header")
    <li class="breadcrumb-item">
        <a href="#">Edit Profil Perusahaan</a>
    </li>
@endsection

@section("content")
    @include("layouts.signature")

    <div class="card rounded">
        <div class="card-body">
            @if (session("success"))
                <div class="alert alert-success">
                    {{ session("success") }}
                </div>
            @endif

            <form action="{{ site_url("company-profile/update") }}" method="post" enctype="multipart/form-data">
                <div class="d-none">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                </div>

                <div class="mb-3">
                    <label for="company_name" class="form-label">Nama Perusahaan</label>
                    <input type="text" class="form-control" name="company_name" id="company_name"
                        value="{{ old("company_name", $company->company_name ?? "") }}" required>
                </div>

                <div class="mb-3">
                    <label for="representative_name" class="form-label">Nama Pimpinan</label>
                    <input type="text" class="form-control" name="representative_name" id="representative_name"
                        value="{{ old("representative_name", $company->representative_name ?? "") }}" required>
                </div>

                <div class="mb-3">
                    <label for="position" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" name="position" id="position"
                        value="{{ old("position", $company->position ?? "") }}" required>
                </div>

                <div class="mb-3">
                    @if (!empty($company->company_logo))
                        <a href="{{ base_url($company->company_logo) }}" data-fancybox data-caption="Logo Perusahaan">
                            <img src="{{ base_url($company->company_logo) }}" alt="Logo Perusahaan" class="border my-2"
                                width="100%" height="200px" style="object-fit: cover;">
                        </a>
                    @else
                        <div class="my-2 d-flex justify-content-center align-items-center bg-light text-muted border rounded"
                            style="width: 100%; height: 200px;">
                            <span class="fs-5">Logo Tidak Tersedia</span>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="company_logo" class="form-label">Logo Perusahaan</label>
                        <input type="file" class="form-control" name="company_logo" id="company_logo">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanda Tangan Digital</label>

                    <!-- Jika tanda tangan sudah ada, tampilkan sebagai gambar -->
                    <div id="signature-container" class="mb-3"
                        style="display: {{ !empty($company->signature) ? "block" : "none" }};">
                        <img id="signature-image"
                            src="{{ !empty($company->signature) ? base_url($company->signature) : "" }}"
                            class="img-fluid w-100 border">

                        @if (empty($company->signature))
                            <button type="button" id="edit-signature" class="btn btn-primary my-2">Buat Tanda
                                Tangan</button>
                        @else
                            <div class="d-flex justify-content-between">
                                <button type="button" id="edit-signature" class="btn btn-warning my-2">Ubah Tanda
                                    Tangan</button>
                                <a href="{{ base_url("company-profile/delete-signature") }}"
                                    class="btn btn-danger my-2">Hapus Tanda
                                    Tangan</a>
                            </div>
                        @endif
                    </div>

                    <!-- Signature Pad untuk menggambar ulang -->
                    <div id="signature-pad-container" class="mb-3"
                        style="display: {{ !empty($company->signature) ? "none" : "block" }};">
                        <div class="rounded">
                            <canvas id="signature-pad" class="border w-100"
                                style="border: 2px dotted #CCCCCC; cursor: crosshair;"></canvas>
                        </div>
                        <input type="hidden" name="signature_data" id="signature-data">
                        <input type="hidden" name="signature_code" id="signature-code">
                        <div class="text-end">
                            <button type="button" id="clear-signature" class="btn btn-danger my-2">Reset</button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
