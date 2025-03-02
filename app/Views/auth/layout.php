<!DOCTYPE html>
<html lang="en">


<head>
    <title><?= $title ?? '' ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">


    <link rel="icon" href="<?= base_url('/assets/images/favicon.svg') ?>" type="image/x-icon">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">

    <link rel="stylesheet" href="<?= base_url('/assets/fonts/tabler-icons.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('/assets/fonts/feather.css') ?>">

    <link rel="stylesheet" href="<?= base_url('/assets/fonts/fontawesome.css') ?>">

    <link rel="stylesheet" href="<?= base_url('/assets/fonts/material.css') ?>">

    <link rel="stylesheet" href="<?= base_url('/assets/css/style.css') ?>" id="main-style-link">
    <link rel="stylesheet" href="<?= base_url('/assets/css/style-preset.css') ?>">

    <style>
        <blade import|%20url(%26%2339%3Bhttps%3A%2F%2Ffonts.googleapis.com%2Fcss2%3Ffamily%3DPoppins%3Aital%2Cwght%400%2C100%3B0%2C200%3B0%2C300%3B0%2C400%3B0%2C500%3B0%2C600%3B0%2C700%3B0%2C800%3B0%2C900%3B1%2C100%3B1%2C200%3B1%2C300%3B1%2C400%3B1%2C500%3B1%2C600%3B1%2C700%3B1%2C800%3B1%2C900%26display%3Dswap%26%2339%3B)%3B>* {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>


</head>

<body>

    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>


    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="auth-header">
                    <a href="#">
                        <img src="../assets/images/logo-dark.svg" alt="img">
                    </a>
                </div>

                <div class="row justify-content-center mb-0 pb-0" style="width: 100%; max-width: 480px;">
                    <?= view('App\Views\Auth\_message_block') ?>
                </div>
                <div class="card mb-5">
                    <?= $this->renderSection('main') ?>
                </div>
                <div class="auth-footer row">
                    <!-- <div class=""> -->

                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('/assets/js/plugins/popper.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/plugins/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/plugins/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/fonts/custom-font.js') ?>"></script>
    <script src="<?= base_url('/assets/js/pcoded.js') ?>"></script>
    <script src="<?= base_url('/assets/js/plugins/feather.min.js') ?>"></script>

</body>


</html>