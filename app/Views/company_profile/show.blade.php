@extends("components.layout")

@include("layouts.fancybox")

@section("header")
    <li class="breadcrumb-item">
        <a href="#">Edit Profil Perusahaan</a>
    </li>
@endsection

@section("content")
    <!-- Signature Pad Library -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const canvas = document.getElementById("signature-pad");
            const ctx = canvas.getContext("2d");
            const signaturePad = new SignaturePad(canvas, {
                minWidth: 1,
                maxWidth: 3,
                penColor: "black"
            });

            const clearButton = document.getElementById("clear-signature");
            const signatureInput = document.getElementById("signature-data");
            const signatureJsonInput = document.getElementById("signature-code");
            const signatureContainer = document.getElementById("signature-container");
            const signatureImage = document.getElementById("signature-image");
            const editSignatureButton = document.getElementById("edit-signature");
            const signaturePadContainer = document.getElementById("signature-pad-container");

            let savedSignatureJson = {!! json_encode($company->signature_code) !!};

            // ✅ Tampilkan tanda tangan sebagai gambar jika ada
            if (signatureImage.src && signatureImage.src !== "") {
                signatureContainer.style.display = "block";
                signaturePadContainer.style.display = "none";
            }

            // ✅ Jika ada stroke tanda tangan di database, muat ulang
            function loadSavedSignature() {
                if (savedSignatureJson && savedSignatureJson !== "null") {
                    signaturePad.fromData(JSON.parse(savedSignatureJson));
                }
            }

            loadSavedSignature(); // Muat tanda tangan saat pertama kali halaman dibuka

            // 🔥 Fungsi untuk mereset ukuran canvas agar Signature Pad bisa digunakan kembali
            function resizeCanvas() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                const width = canvas.offsetWidth;
                const height = 300; // Tinggi 300px agar lebih fleksibel
                canvas.width = width * ratio;
                canvas.height = height * ratio;
                ctx.scale(ratio, ratio);
                signaturePad.clear(); // Bersihkan canvas agar ukuran sesuai
            }

            // **Tombol "Ubah Tanda Tangan"**
            editSignatureButton.addEventListener("click", function() {
                signatureContainer.style.display = "none";
                signaturePadContainer.style.display = "block";
                signaturePad.clear(); // Bersihkan tanda tangan sebelumnya
                resizeCanvas(); // Pastikan canvas sesuai
                loadSavedSignature(); // Jika ada tanda tangan sebelumnya, muat ulang
            });

            // **Tombol "Hapus Tanda Tangan"**
            clearButton.addEventListener("click", function() {
                signaturePad.clear();
                signatureInput.value = "";
                signatureJsonInput.value = "";
            });

            // **Simpan tanda tangan sebelum form disubmit**
            document.querySelector("form").addEventListener("submit", function() {
                if (!signaturePad.isEmpty()) {
                    signatureInput.value = signaturePad.toDataURL("image/png"); // Simpan sebagai gambar
                    signatureJsonInput.value = JSON.stringify(signaturePad.toData()); // Simpan stroke JSON
                }
            });

            window.addEventListener("resize", resizeCanvas);
            resizeCanvas();
        });
    </script>

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
                        <div class="text-end">
                            <button type="button" id="edit-signature" class="btn btn-warning my-2">Ubah Tanda
                                Tangan</button>
                        </div>
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
