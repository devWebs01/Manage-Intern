 @include("layouts.print")

 @php
     function getAssessmentCategory($score)
     {
         if ($score >= 86 && $score <= 100) {
             return "Sangat Memuaskan";
         } elseif ($score >= 71 && $score <= 85) {
             return "Memuaskan";
         } else {
             return "Cukup Memuaskan";
         }
     }
 @endphp

 <div class="container-fluid pm-certificate-container">
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
         <h1 class="fw-bolder certificate-title mt-5 display-6 text-uppercase col-8">
             {{ $company->company_name }}
         </h1>
         <h3 class="fw-bolder text-uppercase mt-5">piagam penghargaan</h3>
         <p class="certificate-subtitle">Diberikan kepada :</p>
         <h3 class="fw-bold fullName my-3 display-6">{{ $participant->full_name }}</h3>
         <div class="row justify-content-center">
             <p class="sans col-10 lh-lg">
                 Telah melaksanakan : <br />
                 Program Magang Kerja pada {{ $company->company_name }}
                 <br>
                 Selama
                 {{ Carbon\Carbon::parse($participant->start_date)->diffInMonths($participant->end_date) }} Bulan
                 terhitung
                 mulai tanggal
                 {{ Carbon\Carbon::parse($participant->start_date)->format("d F Y") . " - " . Carbon\Carbon::parse($participant->end_date)->format("d F Y") }}
                 <br />
                 Dengan hasil : <strong>
                     {{ getAssessmentCategory($participant->assessments->avg("score")) }}

                 </strong>
             </p>
         </div>
         <div class="row mt-1 text-center justify-content-center">
             <div class="col-8">
                 <p class="certificate-subtitle">Jambi, {{ Carbon\Carbon::today()->format("d F Y") }}</p>
                 <div>
                     @if (!empty($company->signature))
                         <img src="{{ base_url($company->signature) }}" class="img-fluid signature-img"
                             alt="" />
                     @else
                         <div class="my-3 py-3 text-white"></div>
                     @endif
                 </div>
                 <p class="fw-bolder underline col-4">{{ $company->representative_name }}</p>
                 <p>{{ $company->position }}</p>
             </div>
         </div>
     </div>
 </div>

 <br>
 <div class="page-break"></div>

 <div class="container-fluid pm-certificate-container">
     <div class="row mb-5 align-items-center">
         <div class="col text-start">
             <div class="info-row">
                 <span class="info-label">Nama Lengkap</span>
                 <span class="info-value">: {{ $participant->full_name }}</span>
             </div>
             <div class="info-row">
                 <span class="info-label">Institusi</span>
                 <span class="info-value">: {{ $participant->institution }}</span>
             </div>
             <div class="info-row">
                 <span class="info-label">Pelaksanaan Magang</span>
                 <span class="info-value">: {{ Carbon\Carbon::parse($participant->start_date)->format("d F Y") }}
                     s.d
                     {{ Carbon\Carbon::parse($participant->end_date)->format("d F Y") }}</span>
             </div>
         </div>
         <div class="col-4">
             <div class="text-end certificate-header">
                 <img src="{{ base_url($company->company_logo) }}" alt="Company Logo"
                     style="width: 90px; height: 90px;">
             </div>

         </div>

     </div>
     <table class="table table-bordered table-sm text-center">
         <thead>
             <tr>
                 <th>Komponen</th>
                 <th>Angka</th>
                 <th>Dengan Huruf</th>
             </tr>
         </thead>
         <tbody>
             @foreach ($participant->assessments as $assessment)
                 <tr>
                     <td>{{ $assessment->indicator->component }}</td>
                     <td>{{ $assessment->score }}</td>
                     <td>
                         <span class="text-capitalize">
                             {{ numfmt_format(numfmt_create("id_ID", NumberFormatter::SPELLOUT), $assessment->score) }}
                         </span>
                     </td>
                 </tr>
             @endforeach
         </tbody>
     </table>

     <div class="row mt-5 pt-5">
         <div class="col text-start">

             <p class="fw-bold">Kriteria Total Nilai Pembimbing Perusaaan :</p>
             <ul class="list-unstyled">
                 <li>86-100: Sangat Memuaskan</li>
                 <li>71-85: Memuaskan</li>
                 <li>&#8804; 70: Cukup Memuaskan</li>
             </ul>

         </div>
         <div class="col-4">
             <div class="text-center">
                 <p>Jambi, {{ date("d F Y") }}</p>
                 <p>{{ $company->position }}</p>
                 <div>
                     @if (!empty($company->signature))
                         <img src="{{ base_url($company->signature) }}" class="img-fluid signature-img"
                             alt="" />
                     @else
                         <div class="my-3 py-3 text-white"></div>
                     @endif
                 </div>
                 <b>{{ $company->representative_name }}</b>
             </div>
         </div>
     </div>
 </div>
