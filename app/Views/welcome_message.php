<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <title>Magang di PTPN4 - Peluang & Pengalaman</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="keywords" content="PTPN4, Magang, Internship, Peluang Karir, Pengalaman Industri" />
    <meta name="description" content="Selamat datang di portal magang PTPN4. Temukan berbagai program magang, workshop, dan kegiatan pendukung untuk memulai karir Anda." />

    <!-- Favicon -->
    <link href="<?= base_url('guest/img/favicon.ico') ?>" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('guest/lib/animate/animate.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('guest/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('guest/css/bootstrap.min.css') ?>" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="<?= base_url('guest/css/style.css') ?>" rel="stylesheet" />

    <style>
            
    .carousel-caption {
    background: none;
    }
    </style>
  </head>
  <body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
      <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <div class="container-fluid bg-white sticky-top">
      <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-2 py-lg-0">
          <a href="<?= base_url('index.html') ?>" class="navbar-brand">
            <img class="img-fluid" src="<?= base_url('guest/img/ptpn4_logo.png') ?>" alt="Logo PTPN4" />
          </a>
          <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
              <a href="<?= base_url('index.html') ?>" class="nav-item nav-link active">Beranda</a>
              <a href="<?= base_url('tentang.html') ?>" class="nav-item nav-link">Tentang</a>
              <a href="<?= base_url('program.html') ?>" class="nav-item nav-link">Program</a>
              <a href="<?= base_url('kontak.html') ?>" class="nav-item nav-link">Kontak</a>
            </div>
            <div class="border-start ps-4 d-none d-lg-block">
              <button type="button" class="btn btn-sm p-0">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </nav>
      </div>
    </div>
    <!-- Navbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid px-0 mb-5">
      <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="w-100" src="https://www.ptpn4.co.id/assets/img/portfolio/2.jpeg" alt="Kegiatan Magang" />
            <div class="carousel-caption">
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-lg-7 text-center">
                    <p class="fs-4 text-white animated zoomIn">
                      Selamat Datang di <strong class="text-dark">Portal Magang PTPN4</strong>
                    </p>
                    <h1 class="display-1 text-white mb-4 animated zoomIn">
                      Mulai Karir Anda dengan Pengalaman Nyata
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="w-100" src="https://www.ptpn4.co.id/assets/img/ca_lori.jpeg" alt="Pengalaman Magang" />
            <div class="carousel-caption">
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-lg-7 text-center">
                    <p class="fs-4 text-white animated zoomIn">
                      Bergabung Bersama <strong class="text-dark">PTPN4</strong>
                    </p>
                    <h1 class="display-1 text-white mb-4 animated zoomIn">
                      Raih Ilmu, Inovasi, dan Jejaring Profesional
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Sebelumnya</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Berikutnya</span>
        </button>
      </div>
    </div>
    <!-- Carousel End -->

    <!-- Tentang Program Magang Start -->
    <div class="container-xxl py-5">
      <div class="container">
        <div class="row g-5">
          <div class="col-lg-6">
            <div class="row g-3">
              <div class="col-6 text-end">
                <img class="img-fluid bg-white w-100 mb-3 wow fadeIn" data-wow-delay="0.1s" src="<?= base_url('guest/img/tentang-1.jpg') ?>" alt="Magang" />
                <img class="img-fluid bg-white w-50 wow fadeIn" data-wow-delay="0.2s" src="<?= base_url('guest/img/tentang-3.jpg') ?>" alt="Magang" />
              </div>
              <div class="col-6">
                <img class="img-fluid bg-white w-50 mb-3 wow fadeIn" data-wow-delay="0.3s" src="<?= base_url('guest/img/tentang-4.jpg') ?>" alt="Magang" />
                <img class="img-fluid bg-white w-100 wow fadeIn" data-wow-delay="0.4s" src="<?= base_url('guest/img/tentang-2.jpg') ?>" alt="Magang" />
              </div>
            </div>
          </div>
          <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
            <div class="section-title">
              <p class="fs-5 fw-medium fst-italic text-primary">Tentang Program Magang</p>
              <h1 class="display-6">
                Program Magang PTPN4 untuk Meningkatkan Kompetensi Anda
              </h1>
            </div>
            <p class="mb-4">
              Program magang PTPN4 memberikan kesempatan belajar langsung di lingkungan industri perkebunan yang profesional. Dapatkan pengalaman nyata, pelatihan intensif, dan bimbingan dari para ahli.
            </p>
            <a href="<?= base_url('tentang.html') ?>" class="btn btn-primary rounded-pill py-3 px-5">Selengkapnya</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Tentang Program Magang End -->

    <!-- Program & Kegiatan Start -->
    <div class="container-fluid py-5 my-5" style="background: #f8f9fa;">
      <div class="container py-5">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px">
          <p class="fs-5 fw-medium fst-italic text-primary">Program Kami</p>
          <h1 class="display-6">Buka Jalan Menuju Karir Impian</h1>
        </div>
        <div class="owl-carousel product-carousel wow fadeInUp" data-wow-delay="0.5s">
          <a href="<?= base_url('program.html#magang') ?>" class="d-block product-item rounded">
            <img src="<?= base_url('guest/img/program-1.jpg') ?>" alt="Program Magang" />
            <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
              <h4 class="text-primary">Program Magang</h4>
              <span class="text-body">Raih pengalaman praktis di lapangan.</span>
            </div>
          </a>
          <a href="<?= base_url('program.html#workshop') ?>" class="d-block product-item rounded">
            <img src="<?= base_url('guest/img/program-2.jpg') ?>" alt="Workshop & Pelatihan" />
            <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
              <h4 class="text-primary">Workshop & Pelatihan</h4>
              <span class="text-body">Tingkatkan skill melalui sesi interaktif.</span>
            </div>
          </a>
          <a href="<?= base_url('program.html#mentoring') ?>" class="d-block product-item rounded">
            <img src="<?= base_url('guest/img/program-3.jpg') ?>" alt="Mentoring & Networking" />
            <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
              <h4 class="text-primary">Mentoring & Networking</h4>
              <span class="text-body">Terhubung dengan para profesional industri.</span>
            </div>
          </a>
        </div>
      </div>
    </div>
    <!-- Program & Kegiatan End -->

    <!-- Video Testimoni Start -->
    <div class="container-fluid video my-5">
      <div class="container">
        <div class="row g-0">
          <div class="col-lg-6 py-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="py-5">
              <h1 class="display-6 mb-4">
                Saksikan Perjalanan <span class="text-white">Magang</span> Kami
              </h1>
              <p class="fw-normal lh-base fst-italic text-white mb-5">
                Simak kisah dan testimoni para peserta magang yang telah merasakan manfaat nyata dari program kami.
              </p>
              <a class="btn btn-light rounded-pill py-3 px-5" href="<?= base_url('testimoni.html') ?>">Lihat Testimoni</a>
            </div>
          </div>
          <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
            <div class="h-100 d-flex align-items-center justify-content-center" style="min-height: 300px">
              <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                <span></span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Video Testimoni End -->

    <!-- Modal Video Start -->
    <div class="modal modal-video fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content rounded-0">
          <div class="modal-header">
            <h3 class="modal-title" id="videoModalLabel">Video Perjalanan Magang</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="ratio ratio-16x9">
              <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always" allow="autoplay"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Video End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
      <div class="container py-5">
        <div class="row g-5">
          <div class="col-lg-3 col-md-6">
            <h4 class="text-primary mb-4">Kantor Kami</h4>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>Jl. Contoh Alamat, Kota, Indonesia</p>
            <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i>+62 123 4567</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>info@ptpn4.co.id</p>
            <div class="d-flex pt-3">
              <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
              <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
              <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-youtube"></i></a>
              <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-linkedin-in"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <h4 class="text-primary mb-4">Tautan Cepat</h4>
            <a class="btn btn-link" href="<?= base_url('tentang.html') ?>">Tentang Kami</a>
            <a class="btn btn-link" href="<?= base_url('kontak.html') ?>">Hubungi Kami</a>
            <a class="btn btn-link" href="<?= base_url('program.html') ?>">Program Magang</a>
            <a class="btn btn-link" href="#">Syarat & Ketentuan</a>
            <a class="btn btn-link" href="#">Dukungan</a>
          </div>
          <div class="col-lg-3 col-md-6">
            <h4 class="text-primary mb-4">Jam Operasional</h4>
            <p class="mb-1">Senin - Jumat</p>
            <h6 class="text-light">08:00 - 17:00 WIB</h6>
            <p class="mb-1">Sabtu</p>
            <h6 class="text-light">08:00 - 12:00 WIB</h6>
            <p class="mb-1">Minggu</p>
            <h6 class="text-light">Libur</h6>
          </div>
          <div class="col-lg-3 col-md-6">
            <h4 class="text-primary mb-4">Newsletter</h4>
            <p>Dapatkan informasi terbaru seputar program magang dan kegiatan kami.</p>
            <div class="position-relative w-100">
              <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="email" placeholder="Email Anda" />
              <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Daftar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer End -->

    <!-- Hak Cipta Start -->
    <div class="container-fluid copyright py-4">
      <div class="container">
        <div class="row">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            &copy; <a class="fw-medium" href="#">Portal Magang PTPN4</a>, Seluruh Hak Cipta Dilindungi.
          </div>
          <div class="col-md-6 text-center text-md-end">
            Dirancang Oleh <a class="fw-medium" href="https://htmlcodex.com">HTML Codex</a> | Distribusikan Oleh <a class="fw-medium" href="https://themewagon.com">ThemeWagon</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Hak Cipta End -->

    <!-- Tombol Kembali ke Atas -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('guest/lib/wow/wow.min.js') ?>"></script>
    <script src="<?= base_url('guest/lib/easing/easing.min.js') ?>"></script>
    <script src="<?= base_url('guest/lib/waypoints/waypoints.min.js') ?>"></script>
    <script src="<?= base_url('guest/lib/owlcarousel/owl.carousel.min.js') ?>"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('guest/js/main.js') ?>"></script>
  </body>
</html>
