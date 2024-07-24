<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ponpes Al-Huda | @yield('title', $title)</title>
    <link rel="icon" type="image/png" href="{{ asset('images/pondok/logo.png') }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('css/typography.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.11.0/r-2.5.0/rr-1.4.1/sc-2.3.0/sb-1.6.0/datatables.min.css"
        rel="stylesheet">
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Sidebar  -->
        <div class="iq-sidebar">
            <div class="iq-sidebar-logo d-flex justify-content-between">
                <a href="index.html">
                    <span>Ponpes Al-Huda</span>
                </a>
            </div>
            <div id="sidebar-scrollbar">
                <nav class="iq-sidebar-menu">
                    <ul id="iq-sidebar-toggle" class="iq-menu">
                        <li class="iq-menu-title">
                            <i class="ri-separator"></i><span>Main</span>
                        </li>
                        <li class="@if (request()->routeIs('wali-beranda')) active @endif">
                            <a href="{{ route('wali-beranda') }}" class="iq-waves-effect">
                                <i class="ri-home-4-line"></i><span>Beranda</span>
                            </a>
                        </li>
                        <li class="@if (request()->routeIs('tagihan')) active @endif">
                            <a href="{{ route('tagihan') }}" class="iq-waves-effect"><i
                                    class="ri-chat-check-line"></i><span>Tagihan</span>
                            </a>
                        </li>
                        <li class="@if (request()->routeIs('cek_nilai') || request()->routeIs('cek_hafalan') || request()->routeIs('cek_point')) active @endif">
                            <a href="#progres" class="iq-waves-effect collapsed" data-toggle="collapse"
                                aria-expanded="false"><i class="ri-pages-line"></i><span>Progres Santri</span>
                                <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                            </a>
                            <ul id="progres" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="@if (request()->routeIs('cek_nilai')) active @endif"><a href="{{ route('cek_nilai') }}">Cek
                                        Nilai</a></li>
                                <li class="@if (request()->routeIs('cek_hafalan')) active @endif"><a href="{{ route('cek_hafalan') }}">Cek
                                        Hafalan</a></li>
                                <li class="@if (request()->routeIs('cek_point')) active @endif"><a href="{{ route('cek_point') }}">Cek
                                        Point</a>
                                </li>
                            </ul>
                        </li>
                        <li class="@if (request()->routeIs('daftar_pengajar') || request()->routeIs('daftar_mata_pelajaran')) active @endif" >
                            <a href="#informasi" class="iq-waves-effect collapsed" data-toggle="collapse" 
                                aria-expanded="false"><i class="ri-list-check"></i><span>Informasi</span>
                                <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                            </a>
                            <ul id="informasi" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="@if (request()->routeIs('daftar_pengajar')) active @endif"><a href="{{ route('daftar_pengajar') }}">Daftar Pengajar</a></li>
                                <li class="@if (request()->routeIs('daftar_mata_pelajaran')) active @endif"><a href="{{ route('daftar_mata_pelajaran') }}">Daftar Mata Pelajaran</a>
                                </li>
                            </ul>
                        </li>
                        <li class="@if (request()->routeIs('data_pribadi_santri')) active @endif">
                            <a href="{{ route('data_pribadi_santri') }}" class="iq-waves-effect"><i
                                    class="ri-user-line"></i><span>Data Pribadi Santri</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="p-3"></div>
            </div>
        </div>
        @yield('navbar')
        @yield('content')
    </div>
    <!-- Wrapper END -->
    <!-- Footer -->
    <footer class="bg-white iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    Copyright 2020 <a href="#">Sofbox</a> All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Appear JavaScript -->
    <script src="{{ asset('js/jquery.appear.js') }}"></script>
    <!-- Countdown JavaScript -->
    <script src="{{ asset('js/countdown.min.js') }}"></script>
    <!-- Counterup JavaScript -->
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <!-- Wow JavaScript -->
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <!-- Apexcharts JavaScript -->
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    <!-- Slick JavaScript -->
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <!-- Select2 JavaScript -->
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="{{ asset('js/smooth-scrollbar.js') }}"></script>
    <!-- lottie JavaScript -->
    <script src="{{ asset('js/lottie.js') }}"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('js/chart-custom.js') }}"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('js/custom.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.11.0/r-2.5.0/rr-1.4.1/sc-2.3.0/sb-1.6.0/datatables.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

    <script>
        // Script untuk menutup alert setelah beberapa detik
        window.onload = function() {
            setTimeout(function() {
                document.getElementById("success-alert").style.display = "none";
                document.getElementById("error-alert").style.display = "none";
            }, 5000); // Waktu dalam milidetik (5000 ms = 5 detik)
        };
    </script>
    @yield('js')
</body>

</html>
