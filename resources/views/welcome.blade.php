<!DOCTYPE html>


<html lang="en">

<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }}</title>

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

    <!-- Slider Start -->
    <section class="banner"
        style="background: url({{ asset('img/background-kb.jpeg') }}) no-repeat; background-size:cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-xl-7">
                    <div class="block">
                        <div class="divider mb-3"></div>
                        <span class="text-uppercase text-sm letter-spacing ">{{ env('APP_NAME') }}</span>
                        <h1 class="mb-3 mt-3">{{ env('APP_NAME') }}</h1>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="feature-block d-lg-flex justify-content-center">
                        @foreach (App\Models\Puskesmas::all() as $item)
                            <div class="feature-item mb-5 mb-lg-0">
                                <div class="feature-icon mb-4">
                                    <i class="icofont-surgeon-alt"></i>
                                </div>
                                <span>Puskesmas</span>
                                <h4 class="mb-3">{{ $item->nama_puskesmas }}</h4>
                                <p class="mb-4">{{ $item->alamat_puskesmas }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cta-section  mt-4">
        <div class="">
            <div class="cta position-relative">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-stat">
                            <i class="icofont-doctor"></i>
                            <span class="h3 counter" data-count="{{ App\Models\Sasaran::sum('jumlah') }}">0</span>k
                            <p>Pasangan Usia Subur</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-stat">
                            <i class="icofont-flag"></i>
                            <span class="h3 counter" data-count="{{ App\Models\Ekseptor::count() }}">0</span>+
                            <p>KB Aktif</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="section service gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-title">
                        <h2>Alat Kontrasepsi</h2>
                        <div class="divider mx-auto my-4"></div>
                        <p>Penggunaan alat kontrasepsi yang tepat dapat membantu perencanaan keluarga dan menjaga
                            kesehatan reproduksi </p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                @foreach (App\Models\AlatKontrasepsi::all() as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="service-item mb-4">
                            <div class="icon d-flex align-items-center">
                                <img src="{{ Storage::url($item->foto_alat) }}"
                                    style="width: 80px;height:80px; object-fit:cover;">
                                <h4 class="mt-3 mb-3">{{ $item->nama_alat }}</h4>
                            </div>

                            <div class="content">
                                <p class="mb-4">{{ Str::limit($item->cara_pakai, 100) }}</p>
                                <div class="text-center">

                                    <a href="{{ url('/detail', $item->kode_alat) }}" class="btn btn-main btn-sm">Detail
                                        Alat</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


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
