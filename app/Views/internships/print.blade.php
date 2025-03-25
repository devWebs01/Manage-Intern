<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title ?? $GLOBALS["companyName"] }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" href="{{ base_url($GLOBALS["companyLogo"] ?? "/assets/images/favicon.svg") }}"
        type="image/x-icon">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">

    <link rel="stylesheet" href="{{ base_url("/assets/fonts/tabler-icons.min.css") }}">

    <link rel="stylesheet" href="{{ base_url("/assets/fonts/feather.css") }}">

    <link rel="stylesheet" href="{{ base_url("/assets/fonts/fontawesome.css") }}">

    <link rel="stylesheet" href="{{ base_url("/assets/fonts/material.css") }}">

    <link rel="stylesheet" href="{{ base_url("/assets/css/style.css") }}" id="main-style-link">
    <link rel="stylesheet" href="{{ base_url("/assets/css/style-preset.css") }}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .btn {
            border-radius: var(--bs-border-radius) !important;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        .certificate-container {
            width: 100%;
            max-width: 900px;
            background: white;
            padding: 40px;
            margin: 50px auto;
            border: 10px solid #d4af37;
            /* Warna emas */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>

    @yield("styles")

</head>

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">

    @include("internships.certificate")

    <script src="{{ base_url("/assets/js/plugins/popper.min.js") }}"></script>
    <script src="{{ base_url("/assets/js/plugins/simplebar.min.js") }}"></script>
    <script src="{{ base_url("/assets/js/plugins/bootstrap.min.js") }}"></script>
    <script src="{{ base_url("/assets/js/fonts/custom-font.js") }}"></script>
    <script src="{{ base_url("/assets/js/pcoded.js") }}"></script>
    <script src="{{ base_url("/assets/js/plugins/feather.min.js") }}"></script>

    @yield("scripts")
    <script>
        window.onload = function() {
            window.print();
        };
    </script>

</body>

</html>
