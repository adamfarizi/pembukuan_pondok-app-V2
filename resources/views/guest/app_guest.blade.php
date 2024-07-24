<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="{{ asset('assets/js/color-modes.js') }}"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pondok Pesantren Al-Huda | @yield('title', $title)</title>
    <link rel="icon" type="image/png" href="{{ asset('images/pondok/logo.png') }}">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Questrial&display=swap"
        rel="stylesheet">
    <style>
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }

        a {
            text-decoration: none;
        }

        .overlay {
            position: relative;
            display: inline-block;
        }
        .overlay img {
            display: block;
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        .overlay-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Hitam transparan */
            display: flex;
            justify-content: center;
            align-items: center;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .overlay-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets/css/font.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/headers.css') }}" rel="stylesheet">
</head>

<body class="pt-0" data-bs-theme="light">
    @yield('header')
    <main>
        @yield('content')
        <div class="px-5 mx-5">
            {{-- Footer --}}
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 px-5 border-top">
                <p class="col-md-4 mb-0 text-body-secondary">&copy; 2024 Pondok Pesantren Al-Huda</p>

                <ul class="nav col-md-8 justify-content-end">
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Beranda</a></li>
                    <li class="nav-item"><a href="#tentangpondok" class="nav-link px-2 text-body-secondary">Tentang Pondok</a></li>
                    <li class="nav-item"><a href="#areapondok" class="nav-link px-2 text-body-secondary">Area Pondok</a></li>
                    <li class="nav-item"><a href="#kontak" class="nav-link px-2 text-body-secondary">Kontak Kami</a></li>
                </ul>
            </footer>
        </div>
    </main>
    <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
    @yield('js')
    <script>
        // Menangani penutupan alert
        document.addEventListener('DOMContentLoaded', function() {
            var alertCloseButtons = document.querySelectorAll('.btn-tutup');

            alertCloseButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var alert = this.closest('.alert');
                    if (alert) {
                        alert.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>
