<!DOCTYPE html>
<html lang="en">


<head>
    <title>{{ $title ?? '' }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">


    <link rel="icon" href="{{ base_url('/assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">

    <link rel="stylesheet" href="{{ base_url('/assets/fonts/tabler-icons.min.css') }}">

    <link rel="stylesheet" href="{{ base_url('/assets/fonts/feather.css') }}">

    <link rel="stylesheet" href="{{ base_url('/assets/fonts/fontawesome.css') }}">

    <link rel="stylesheet" href="{{ base_url('/assets/fonts/material.css') }}">

    <link rel="stylesheet" href="{{ base_url('/assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ base_url('/assets/css/style-preset.css') }}">

    @yield('styles')

</head>



<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">

    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>


    @include('components.sidebar')

    @include('components.header')

    <div class="pc-container">
        <div class="pc-content">

            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/dashboard">
                                        Dashboard
                                    </a>
                                </li>
                                @yield('header')
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')

        </div>
    </div>

    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm my-1">
                    <p class="m-0">Mantis &#9829; crafted by Team <a href="https://themeforest.net/user/codedthemes"
                            target="_blank">Codedthemes</a> Distributed by <a
                            href="https://themewagon.com/">ThemeWagon</a>.</p>
                </div>
                <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        <li class="list-inline-item"><a href="">Home</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ base_url('/assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ base_url('/assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ base_url('/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ base_url('/assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ base_url('/assets/js/pcoded.js') }}"></script>
    <script src="{{ base_url('/assets/js/plugins/feather.min.js') }}"></script>

    @yield('scripts')

</body>


</html>
