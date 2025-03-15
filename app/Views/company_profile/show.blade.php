@extends("components.layout")

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

                <div class="mb-3">
                    <label for="signature" class="form-label">Tanda Tangan (Gambar)</label>
                    <input type="file" class="form-control" name="signature" id="signature">
                    @if (!empty($company->signature))
                        <img src="{{ base_url($company->signature) }}" alt="Tanda Tangan" class="mt-2 img-fluid"
                            width="200">
                    @endif
                </div>

                <div class="mb-3">
                    <label for="company_logo" class="form-label">Logo Perusahaan</label>
                    <input type="file" class="form-control" name="company_logo" id="company_logo">
                    @if (!empty($company->company_logo))
                        <img src="{{ base_url($company->company_logo) }}" alt="Logo Perusahaan" class="mt-2 img-fluid"
                            width="150">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
