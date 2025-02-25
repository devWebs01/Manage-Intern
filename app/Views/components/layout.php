<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Spica Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?= base_url('/assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('/assets/vendors/css/vendor.bundle.base.css') ?>">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url('/assets/css/style.css') ?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url('/assets/images/favicon.png') ?>" />
</head>
<body>
  <div class="container-scroller d-flex">
   
    <!-- partial:./partials/_sidebar.html -->
  <?= $this->include('components/sidebar') ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
      <?= $this->include('components/navbar') ?>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
        <footer class="footer">
          <div class="card">
            <div class="card-body">
              <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a> templates</span>
              </div>
            </div>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="<?= base_url('/assets/vendors/js/vendor.bundle.base.js') ?>">

  </script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?= base_url('/assets/vendors/chart.js/Chart.min.js') ?>">

  </script>
  <script src="<?= base_url('/assets/js/jquery.cookie.js') ?>" type="text/javascript">

  </script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?= base_url('/assets/js/off-canvas.js') ?>">

  </script>
  <script src="<?= base_url('/assets/js/hoverable-collapse.js') ?>">

  </script>
  <script src="<?= base_url('/assets/js/template.js') ?>">

  </script>
  <!-- endinject -->
  <!-- plugin js for this page -->
    <script src="<?= base_url('/assets/js/jquery.cookie.js') ?>" type="text/javascript">

    </script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="<?= base_url('/assets/js/dashboard.js') ?>">

  </script>
  <!-- End custom js for this page-->
</body>

</html>