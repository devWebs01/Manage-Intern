<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <title>Magang di PTPN4 - Peluang & Pengalaman</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="keywords" content="PTPN4, Magang, Internship, Peluang Karir, Pengalaman Industri" />
    <meta name="description" content="Selamat datang di portal magang PTPN4. Temukan berbagai program magang, workshop, dan kegiatan pendukung untuk memulai karir Anda." />

    <!-- Favicon -->
    <link href="<?= base_url($GLOBALS["companyLogo"] ?? "/assets/images/favicon.svg")  ?>" rel="icon" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <style>
       @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
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
          <a href="<?= base_url('/') ?>" class="navbar-brand">
            <img class="img" src="<?= base_url($GLOBALS["companyLogo"] ?? "/assets/images/favicon.svg")  ?>" alt="Logo PTPN4" style="width: 60px; height:60px;" />
          </a>
          <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
          </button>
         <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="<?= base_url('/') ?>" class="nav-item nav-link">Beranda</a>

                <?php if (logged_in()): ?>
                    <a href="<?= base_url('/dashboard') ?>" class="nav-item nav-link">Dashboard</a>
                <?php else: ?>
                    <a href="<?= base_url('/login') ?>" class="nav-item nav-link">Masuk</a>
                <?php endif; ?>
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
                      Selamat Datang di <strong class="text-primary">Portal Magang PTPN4</strong>
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
                      Bergabung Bersama <strong class="text-primary">PTPN4</strong>
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
                <img class="img-fluid bg-white w-100 mb-3 wow fadeIn" data-wow-delay="0.1s" src="https://www.ptpn4.co.id/assets/img/portfolio/3.jpeg" alt="Magang" />
                <img class="img-fluid bg-white w-50 wow fadeIn" data-wow-delay="0.2s" src="https://www.ptpn4.co.id/assets/img/kopi.jpeg" alt="Magang" />
              </div>
              <div class="col-6">
                <img class="img-fluid bg-white w-50 mb-3 wow fadeIn" data-wow-delay="0.3s" src="https://www.ptpn4.co.id/assets/img/ca_karet.jpeg" alt="Magang" />
                <img class="img-fluid bg-white w-100 wow fadeIn" data-wow-delay="0.4s" src="https://www.ptpn4.co.id/assets/img/ca_karet1.jpeg" alt="Magang" />
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
          
          </div>
        </div>
      </div>
    </div>
    <!-- Tentang Program Magang End -->

    <!-- Program & Kegiatan Start -->
    <div class="container-fluid" style="background: #f8f9fa;">
      <div class="container py-5">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px">
          <p class="fs-5 fw-medium fst-italic text-primary">Program Kami</p>
          <h1 class="display-6">Buka Jalan Menuju Karir Impian</h1>
        </div>
        <div class="owl-carousel product-carousel wow fadeInUp" data-wow-delay="0.5s">
          <a data-fancybox="gallery" href="https://www.ptpn4.co.id/assets/img/galeri/sawit/5.jpeg" class="d-block product-item rounded">
            <img src="https://www.ptpn4.co.id/assets/img/galeri/sawit/5.jpeg" alt="Program Magang" />
          </a>
          <a data-fancybox="gallery" href="https://www.ptpn4.co.id/assets/img/galeri/karet/ca_leather.jpeg" class="d-block product-item rounded">
            <img src="https://www.ptpn4.co.id/assets/img/galeri/karet/ca_leather.jpeg" alt="Program Magang" />
          </a>
          <a data-fancybox="gallery" href="https://www.ptpn4.co.id/assets/img/galeri/pabrik/tr.jpeg" class="d-block product-item rounded">
            <img src="https://www.ptpn4.co.id/assets/img/galeri/pabrik/tr.jpeg" alt="Program Magang" />
          </a>
          <a data-fancybox="gallery" href="https://www.ptpn4.co.id/assets/img/galeri/pabrik/lori.jpeg" class="d-block product-item rounded">
            <img src="https://www.ptpn4.co.id/assets/img/galeri/pabrik/lori.jpeg" alt="Program Magang" />
          </a>
          <a data-fancybox="gallery" href="https://www.ptpn4.co.id/assets/img/galeri/kopi/IMG-20230922-WA0002.jpg" class="d-block product-item rounded">
            <img src="https://www.ptpn4.co.id/assets/img/galeri/kopi/IMG-20230922-WA0002.jpg" alt="Program Magang" />
          </a>
          <a data-fancybox="gallery" href="https://www.ptpn4.co.id/assets/img/galeri/teh/3.jpeg" class="d-block product-item rounded">
            <img src="https://www.ptpn4.co.id/assets/img/galeri/teh/3.jpeg" alt="Program Magang" />
          </a>
         
        </div>
      </div>
    </div>
    <!-- Program & Kegiatan End -->

    <!-- Video Testimoni Start -->
    <div class="container-fluid video">
      <div class="container">
        <div class="row g-0">
          <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
            <div class="py-5">
              <h1 class="display-6 mb-4">
                Saksikan Perjalanan Magang Kami
              </h1>
              <p class="fw-normal lh-base fst-italic text-white mb-5">
                Simak cerita para peserta magang yang telah merasakan manfaat nyata dari program kami.
              </p>
             
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
         
          <div class="modal-body">
            <div class="ratio ratio-16x9">
             <iframe width="560" height="315" src="https://www.youtube.com/embed/iAERC958ZG8?si=bHkG0h0ZBJ0vB-bv" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Video End -->

    <!-- Hak Cipta Start -->

   <footer class="py-4">
	<div class="container">
		<div class="row align-items-center py-4">
			<div class="col-12 col-lg-3 text-center text-lg-start"><img alt="Free Frontend Logo" class="img-fluid mb-3" height="" src="<?= base_url($GLOBALS["companyLogo"] ?? "/assets/images/favicon.svg")  ?>" width="60" height="60"></div>
			<div class="col-12 col-lg-6 navbar-expand text-center">
				<ul class="list-unstyled d-block d-lg-flex justify-content-center mb-3 mb-lg-0">
					<li class="nav-item">
						<a class="text-dark text-decoration-none me-lg-3" href="/">Beranda</a>
					</li>
					<li class="nav-item">
						<a class="text-dark text-decoration-none me-lg-3" href="<?= base_url('/login') ?>">Masuk</a>
					</li>
				</ul>
			</div>
			<div class="col-12 col-lg-3 text-center text-lg-end">
				<a class="me-2" href="https://www.ptpn4.co.id/main/galeri">
       <i class='bx bxl-twitter'></i>
      </a> 
      <a class="me-2" href="https://www.ptpn4.co.id/main/galeri#">
        <i class='bx bxl-facebook-circle'></i>
      </a> 
      <a class="me-2" href="https://www.ptpn4.co.id/main/galeri#">
       <i class='bx bxl-instagram' ></i>
      </a>
			</div>
		</div>
		<div class="row pb-3">
			<div class="col-12 text-center small text-muted">
				© <?= Carbon\Carbon::now()->format("Y") ?> 
❤
 <?= $GLOBALS["companyName"] ?>. Semua hak dilindungi undang-undang.
			</div>
		</div>
	</div>
</footer>
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

     <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });
    </script>
  </body>
</html>
