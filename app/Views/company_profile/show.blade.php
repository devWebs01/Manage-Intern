@extends("components.layout")

@include("layouts.fancybox")

@section("header")
    <li class="breadcrumb-item">
        <a href="#">Edit Profil Perusahaan</a>
    </li>
@endsection

@section("content")
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

                <div class="row">
                    <div class="col-md-6">
                        @if (!empty($company->signature))
                            <a href="{{ base_url($company->signature) }}" data-fancybox data-caption="Tanda Tangan">
                                <img src="{{ base_url($company->signature) }}" alt="Tanda Tangan" class="my-2"
                                    width="100%" height="200px" style="object-fit: cover;">

                            </a>
                        @else
                            <div class="my-2 d-flex justify-content-center align-items-center bg-light text-muted border rounded"
                                style="width: 100%; height: 200px;">
                                <span class="fs-5">Tanda Tangan Tidak Tersedia</span>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="signature" class="form-label">Tanda Tangan (Gambar)</label>
                            <input type="file" class="form-control" name="signature" id="signature">
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if (!empty($company->company_logo))
                            <a href="{{ base_url($company->company_logo) }}" data-fancybox data-caption="Logo Perusahaan">
                                <img src="{{ base_url($company->company_logo) }}" alt="Logo Perusahaan" class="my-2"
                                    width="100%" height="200px" style="object-fit: cover;">
                            </a>
                        @else
                            <div class="my-2 d-flex justify-content-center align-items-center bg-light text-muted border rounded"
                                style="width: 100%; height: 200px;">
                                <span class="fs-5">Tanda Tangan Tidak Tersedia</span>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="company_logo" class="form-label">Logo Perusahaan</label>
                            <input type="file" class="form-control" name="company_logo" id="company_logo">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
