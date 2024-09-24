<!DOCTYPE html>


<html lang="en">

<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }} - {{ $title }}</title>

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{ env('APP_NAME') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="{{ env('APP_NAME') }}">
    <meta name="generator" content="{{ env('APP_NAME') }}">

    <!-- theme meta -->
    <meta name="theme-name" content="{{ env('APP_NAME') }}" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/{{ asset('frontend/') }}/images/favicon.png" />

    <!--
  Essential stylesheets
  =====================================-->
    <link rel="stylesheet" href="{{ asset('frontend/') }}/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/') }}/plugins/icofont/icofont.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/') }}/plugins/slick-carousel/slick/slick.css">
    <link rel="stylesheet" href="{{ asset('frontend/') }}/plugins/slick-carousel/slick/slick-theme.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend/') }}/css/style.css">

</head>

<body id="top">


    @include('layouts.header_frontend')


    <section class="section service gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-title">
                        <h2>{{ $title }}</h2>
                        <div class="divider mx-auto my-4"></div>
                        <img src="{{ Storage::url($alat->foto_alat) }}"
                            style="max-width: 400px;height:200px; object-fit:cover;">
                        <div class="divider mx-auto my-4"></div>
                        <h4>Cara Penggunaan</h4>
                        <p>{{ $alat->cara_pakai }}</p>
                        <h4>Kelebihan {{ $alat->nama_alat }}</h4>
                        <p>{{ $alat->kelebihan }}</p>
                        <h4>Kekurangan {{ $alat->nama_alat }}</h4>
                        <p>{{ $alat->kekurangan }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- footer Start -->

    @include('layouts.footer_frontend')


    <!--
    Essential Scripts
    =====================================-->
    <script src="{{ asset('frontend/') }}/plugins/jquery/jquery.js"></script>
    <script src="{{ asset('frontend/') }}/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="{{ asset('frontend/') }}/plugins/slick-carousel/slick/slick.min.js"></script>
    <script src="{{ asset('frontend/') }}/plugins/shuffle/shuffle.min.js"></script>

    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA"></script>
    <script src="{{ asset('frontend/') }}/plugins/google-map/gmap.js"></script>

    <script src="{{ asset('frontend/') }}/js/script.js"></script>

</body>

</html>
