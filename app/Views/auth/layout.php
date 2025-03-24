<!DOCTYPE html>
<html lang="en">


<head>
    <title><?= $title ?? $GLOBALS["companyName"]  ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <link rel="icon" href="<?= base_url($GLOBALS["companyLogo"] ?? "/assets/images/favicon.svg") ?>"
        type="image/x-icon">

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
       @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
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
                    <a href="/">
                        <img src="<?= base_url($GLOBALS["companyLogo"] ?? "/assets/images/favicon.svg") ?>" alt="img" style="width: 60px; height:60px;">
                    </a>
                </div>

                <div class="row justify-content-center mb-0 pb-0" style="width: 100%; max-width: 480px;">
                    <?= view('App\Views\auth\_message_block') ?>
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