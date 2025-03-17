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
