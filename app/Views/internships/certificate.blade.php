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
            max-width: 1000px;
            background-color: white;
            padding: 30px;
            color: #333;
            font-family: "Open Sans", sans-serif;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
            margin: auto;
            position: relative;
        }

        .pm-certificate-container p {
            font-weight: 500;
            font-style: normal;

        }

        .pm-certificate-border {
            background: #fff;
            padding: 20px;
            border: 2px solid #e1e5f0;
            position: relative;
            /* Tambahan untuk background */
            background-image: url('{{ base_url($company->company_logo) }}');
            background-size: 30%;
            /* Mengecilkan ukuran background */
            background-position: center;
            background-repeat: no-repeat;
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
    </style>

    <div class="container pm-certificate-container">
        <div class="certificate-image top-left">
            <img src="{{ base_url("certificate/25e4d3ea-f67a-46a6-8105-dc29848f29a0.svg") }}" alt="Logo Kiri" />
        </div>
        <div class="certificate-image top-right">
            <img src="{{ base_url("certificate/25e4d3ea-f67a-46a6-8105-dc29848f29a0.svg") }}" alt="Logo Kanan" />
        </div>
        <div class="certificate-image bottom-left">
            <img src="{{ base_url("certificate/c2293968-24c7-4262-8c79-dc4613f34d48.svg") }}" alt="Logo Kiri Bawah" />
        </div>
        <div class="certificate-image bottom-right">
            <img src="{{ base_url("certificate/c2293968-24c7-4262-8c79-dc4613f34d48.svg") }}" alt="Logo Kanan Bawah" />
        </div>
        <div class="border border-white p-3 pm-certificate-border text-center">
            <h1 class="fw-bolder certificate-title mt-5 display-5 text-uppercase">
                {{ $company->company_name }}
            </h1>
            <h3 class="fw-bolder text-uppercase">piagam penghargaan</h3>
            <p class="certificate-subtitle">Diberikan kepada :</p>
            <h3 class="fw-bold fullName my-4 display-6">{{ $participant->full_name }}</h3>
            <div class="row justify-content-center">
                <p class="sans col-10 lh-lg">
                    Telah melaksanakan : <br />
                    Program Magang Kerja pada {{ $company->company_name }}
                    <br>
                    Selama
                    {{ Carbon\Carbon::parse($participant->start_date)->diffInMonths($participant->end_date) }} Bulan
                    terhitung
                    mulai tanggal
                    {{ Carbon\Carbon::parse($participant->start_date)->format("d M Y") . " - " . Carbon\Carbon::parse($participant->end_date)->format("d M Y") }}
                    <br />
                    Dengan hasil : <strong>Sangat Memuaskan</strong>
                </p>
            </div>
            <div class="row mt-3 text-center justify-content-center">
                <div class="col-8">
                    <p class="certificate-subtitle">Jambi, {{ Carbon\Carbon::today()->format("d M Y") }}</p>
                    <div>
                        @if (!empty($company->signature))
                            <img src="{{ base_url($company->signature) }}" class="img-fluid w-50" alt="" />
                        @endif
                    </div>
                    <p class="fw-bolder underline col-4">{{ $company->representative_name }}</p>
                    <p>{{ $company->position }}</p>
                </div>
            </div>
        </div>
    </div>
