@extends("components.layout")

@section("header")
    <li class="breadcrumb-item">
        <a href="#">
            Edit Profil Perusahaan
        </a>
    </li>
@endsection

@section("content")
    <div class="card rounded">
        <div class="card-body">
            <form action="{{ site_url('company-profile/update') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                
                <div class="mb-3">
                    <label for="company_name" class="form-label">Nama Perusahaan</label>
                    <input type="text" class="form-control" name="company_name" id="company_name"
                        value="{{ old('company_name', $company->company_name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="representative_name" class="form-label">Nama Pimpinan</label>
                    <input type="text" class="form-control" name="representative_name" id="representative_name"
                        value="{{ old('representative_name', $company->representative_name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="position" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" name="position" id="position"
                        value="{{ old('position', $company->position ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="signature_image" class="form-label">Tanda Tangan (Gambar)</label>
                    <input type="file" class="form-control" name="signature_image" id="signature_image">
                    @if (!empty($company->signature_image))
                        <img src="{{ base_url($company->signature_image) }}" alt="Tanda Tangan" class="mt-2" width="200">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
