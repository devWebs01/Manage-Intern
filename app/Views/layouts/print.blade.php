   <style>
       @import url("https://fonts.googleapis.com/css2?family=Carattere&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

       .fullName {
           font-family: "Carattere", cursive;
           font-weight: 400;
           font-style: normal;
       }

       .certificate-title {
           font-family: "Inter", sans-serif;
           font-optical-sizing: auto;
           font-style: normal;
           font-weight: bolder;
           place-self: center;
       }

       .certificate-subtitle {
           font-family: "Poppins", sans-serif;
           font-weight: 400;
           font-style: normal;
       }

       .underline {
           border-bottom: 1px solid #777;
           padding: 5px;
           margin-bottom: 15px;
           justify-self: center;
       }

       .pm-empty-space {
           height: 80px;
           width: 100%;
       }

       .pm-certificate-container {
           max-width: 100%;
           height: auto;
           background-color: white;
           color: #333;
           font-family: "Open Sans", sans-serif;
           box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
           margin: 0;
           position: relative;
           padding: 20px;
           /* Tambahkan padding agar konten tidak menempel */
       }

       @page {
           size: A4 landscape;
           margin: 0;
       }

       /* Hanya berlaku saat print */
       @media print {
           .pm-certificate-container {
               width: 100%;
               box-shadow: none;
               margin: 0;
           }

           body {
               background: none;
           }

           .no-print {
               display: none !important;
           }
       }

       .pm-certificate-container p {
           font-weight: 500;
           font-style: normal;
       }

       .pm-certificate-border {
           position: relative;
           /* Dibutuhkan untuk pseudo-element */
           padding: 20px;
           border: 2px solid #e1e5f0;
           background-color: white;
           /* Warna dasar tetap putih */
       }

       .pm-certificate-border::before {
           content: "";
           position: absolute;
           top: 0;
           left: 0;
           width: 100%;
           height: 100%;
           background-image: url('{{ base_url($company->company_logo) }}');
           background-size: 30%;
           background-position: center;
           background-repeat: no-repeat;
           opacity: 0.3;
           /* Hanya background yang transparan */
           /* Menempatkan di belakang konten */
       }

       .certificate-image {
           position: absolute;
           width: 150px;
           height: 150px;
       }

       .top-left {
           top: 1px;
           left: 0.1px;
           z-index: 1;
           transform: rotate(90deg) scaleY(-1);
       }

       .top-right {
           top: 1px;
           right: 0.1px;
           transform: rotate(90deg);
           z-index: 1;
       }

       .bottom-left {
           width: 70.2868px;
           height: 104.764px;
           bottom: -15px;
           left: 1px;
           z-index: 1;
           transform: rotate(45deg);
       }

       .bottom-right {
           width: 70.2868px;
           height: 104.764px;
           bottom: -15px;
           right: 1px;
           z-index: 1;
           transform: scale(-1, 1) rotate(45deg);
       }

       .info-row {
           display: flex;
           align-items: baseline;
       }

       .info-label {
           width: 200px;
           /* Sesuaikan dengan kebutuhan */
           font-weight: bold;
       }

       .info-value {
           flex-grow: 1;
       }

       .page-break {
           page-break-before: always;
       }

       .signature-img {
           max-width: 200px;
           /* batas lebar maksimal */
           max-height: 100px;
           /* batas tinggi maksimal */
           width: auto;
           height: auto;
       }

       @media print {
           .signature-img {
               max-width: 200px;
               max-height: 100px;
           }
       }
   </style>
