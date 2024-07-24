@extends('wali/app_wali')
@section('navbar')
    <!-- TOP Nav Bar -->
    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <div class="iq-sidebar-logo">
                <div class="top-logo">
                    <a href="index.html" class="logo">
                        <span>Ponpes Al-Huda</span>
                    </a>
                </div>
            </div>
            {{-- Halaman --}}
            <div class="navbar-breadcrumb">
                <h5 class="mb-0">Data Pribadi Santri</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Pribadi Santri</li>
                    </ul>
                </nav>
            </div>
            {{-- Logo Kanan --}}
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ri-menu-3-line"></i>
                </button>
                <div class="iq-menu-bt align-self-center">
                    <div class="wrapper-menu">
                        <div class="line-menu half start"></div>
                        <div class="line-menu"></div>
                        <div class="line-menu half end"></div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-list">
                        {{-- FullScreen --}}
                        <li class="nav-item iq-full-screen"><a href="#" class="iq-waves-effect" id="btnFullscreen">
                                <i class="ri-fullscreen-line"></i></a></li>
                    </ul>
                </div>
                <ul class="navbar-list">
                    <li>
                        <a href="#" class="search-toggle iq-waves-effect bg-white text-white"><img
                                src="{{ asset('images/local/user-1.png') }}" class="img-fluid rounded" alt="user"></a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height shadow-none m-0">
                                <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white line-height">{{ Auth::user()->nama_wali_santri }}</h5>
                                        <span class="text-white font-size-12">Online</span>
                                    </div>
                                    <a href="profile.html" class="iq-sub-card iq-bg-primary-hover">
                                        <div class="media align-items-center">
                                            <div class="rounded iq-card-icon iq-bg-primary">
                                                <i class="ri-file-user-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Profil Saya</h6>
                                                <p class="mb-0 font-size-12">Tampilkan data pribadi saya.</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="privacy-setting.html" class="iq-sub-card iq-bg-primary-secondary-hover">
                                        <div class="media align-items-center">
                                            <div class="rounded iq-card-icon iq-bg-secondary">
                                                <i class="ri-lock-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Setelan Privasi</h6>
                                                <p class="mb-0 font-size-12">Kontrol parameter privasi Anda.</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="d-inline-block w-100 text-center p-3">
                                        <form action="{{ url('/logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class="iq-bg-danger iq-sign-btn btn-block">Keluar<i
                                                    class="ri-login-box-line ml-2"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
@section('content')
    <!-- Page Content  -->
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                {{-- Card Head --}}
                <div class="col-sm-12">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body profile-page p-0">
                            <div class="profile-header">
                                <div class="cover-container">
                                    <div class="rounded" style="position: relative;">
                                        <div class="rounded"
                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
                                        </div>
                                        <img src="{{ asset('images/local/bg-3.png') }}" alt="profile-bg"
                                            class="rounded img-fluid w-100" style="height: 25vh; object-fit: cover;">
                                    </div>
                                </div>
                                <div class="profile-info p-4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="user-detail pl-5">
                                                <div class="d-flex flex-wrap align-items-center">
                                                    <div class="profile-img pr-4">
                                                        @if ($santri->pas_foto_santri)
                                                            <img src="{{ asset('berkas_santri/pas_foto_santri/' . $santri->pas_foto_santri) }}"
                                                                alt="profile-img" class="avatar-130 img-fluid"
                                                                style="object-fit:cover;" />
                                                        @else
                                                            <img src="{{ asset('images/page-img/15.jpg') }}"
                                                                alt="profile-img" class="avatar-130 img-fluid"
                                                                style="object-fit:cover;" />
                                                        @endif
                                                    </div>
                                                    <div class="profile-detail d-flex align-items-center">
                                                        <h3>{{ $santri->nama_santri }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Alert -->
                <div class="container-fluid">
                    <div class="alert bg-light bg" role="alert">
                        <div class="iq-alert-text">Hubungi <b>Admin</b> jika terdapat data yang tidak sesuai.</div>
                    </div>
                    @if (session('success'))
                        <div id="success-alert" class="alert text-white bg-success" role="alert">
                            <div class="iq-alert-icon">
                                <i class="ri-checkbox-circle-line"></i>
                            </div>
                            <div class="iq-alert-text"><b>Berhasil !</b> {{ session('success') }}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $err)
                            <div id="error-alert" class="alert text-white bg-danger" role="alert">
                                <div class="iq-alert-icon">
                                    <i class="ri-information-line"></i>
                                </div>
                                <div class="iq-alert-text"><b>Gagal ! </b> {{ $err }}</div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        {{-- Kolom Kiri --}}
                        <div class="col-lg-5 profile-left">
                            {{-- Card About Santri --}}
                            <div class="iq-card iq-card-block iq-card-stretch">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Informasi Pribadi</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <div class="about-info m-0 p-0">
                                        <div class="row">
                                            <div class="col-4">Email</div>
                                            <div class="col-8"><a href="mailto:{{ $santri->email_santri }}">: <span
                                                        class="text-primary">{{ $santri->email_santri }}</span></a></div>
                                            <div class="col-4">No Telepon</div>
                                            <div class="col-8"><a href="tel:{{ $santri->no_hp_santri }}">: <span
                                                        class="text-primary">{{ $santri->no_hp_santri }}</span></a></div>
                                            <div class="col-4">Tahun Masuk</div>
                                            <div class="col-8">: {{ $santri->tahun_masuk }}</div>
                                            <div class="col-4">Jenis Kelamin</div>
                                            <div class="col-8">: {{ ucfirst($santri->jenis_kelamin_santri) }}</div>
                                            <div class="col-4">TTL</div>
                                            <div class="col-8">: {{ $santri->tempat_tanggal_lahir_santri }}</div>
                                            <div class="col-4">Alamat</div>
                                            <div class="col-8">: {{ $wali->alamat_wali_santri }}</div>
                                            <div class="col-4 mt-2">Berkas Santri</div>
                                            <div class="col-8">:</div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <a class="text-primary" data-placement="top" title="KTP"
                                                    href="#" data-target="#ktpModal" data-toggle="modal"><i
                                                        class="ri-file-fill"></i> KTP</a>
                                            </div>
                                            <div class="col">
                                                <a class="text-primary" data-placement="top" title="KK"
                                                    href="#" data-target="#kkModal" data-toggle="modal"><i
                                                        class="ri-file-fill"></i> KK</a>
                                            </div>
                                            <div class="col">
                                                <a class="text-primary" data-placement="top" title="Akta"
                                                    href="#" data-target="#aktaModal" data-toggle="modal"><i
                                                        class="ri-file-fill"></i>
                                                    Akta</a>
                                            </div>
                                            <div class="col">
                                                <a class="text-primary" data-placement="top" title="Pas Foto"
                                                    href="#" data-target="#pasfotoModal" data-toggle="modal"><i
                                                        class="ri-file-fill"></i> Pas
                                                    Foto</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Card About Wali Santri --}}
                            <div class="iq-card iq-card-block iq-card-stretch">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Informasi Wali Santri</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <div class="about-info m-0 p-0">
                                        <div class="row">
                                            <div class="col-4">Nama</div>
                                            <div class="col-8">: {{ $wali->nama_wali_santri }}</div>
                                            <div class="col-4">Email</div>
                                            <div class="col-8"><a href="mailto:{{ $wali->email }}">: <span
                                                        class="text-primary">{{ $wali->email }}</span></a></div>
                                            <div class="col-4">No Telepon</div>
                                            <div class="col-8"><a href="tel:{{ $wali->no_hp }}">: <span
                                                        class="text-primary">{{ $wali->no_hp }}</span></a></div>
                                            <div class="col-4">Alamat</div>
                                            <div class="col-8">: {{ $wali->alamat_wali_santri }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Kolom Kanan --}}
                        <div class="col-lg-7 profile-right">
                            {{-- Riwayat --}}
                            <div class="iq-card iq-card-block iq-card-stretch">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Riwayat Pembayaran Santri</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body" style="max-height: 300px; overflow-y: auto;">
                                    <ul class="m-0 p-0">
                                        @if (!$RiwayatPembayaran->isEmpty())
                                            @foreach ($RiwayatPembayaran as $pembayaran)
                                                @php

                                                    $tanggal_pembayaran = \Carbon\Carbon::parse(
                                                        $pembayaran->tanggal_pembayaran,
                                                    )->translatedFormat('d F Y'); // Format tanggal dengan hari dan bulan dalam bahasa Indonesia

                                                    $variabel_jam = \Carbon\Carbon::parse(
                                                        $pembayaran->tanggal_pembayaran,
                                                    )->format('H:i'); // Format waktu

                                                @endphp
                                                <li class="d-flex mb-1">
                                                    <div class="news-icon"><i class="ri-chat-check-fill"></i></div>
                                                    <div class="news-detail mt-1">
                                                        <p class="mb-0">
                                                            Pembayaran
                                                            @if ($pembayaran->jenis_pembayaran == 'daftar_ulang')
                                                                <span class="text-danger">Daftar Ulang</span>
                                                            @elseif ($pembayaran->jenis_pembayaran == 'iuran_bulanan')
                                                                <span class="text-warning">Iuran Bulanan</span>
                                                            @else
                                                                <span class="text-success">Tamrin</span>
                                                            @endif
                                                            untuk semester {{ $pembayaran->semester_ajaran }} tahun
                                                            {{ $pembayaran->tahun_ajaran }} sejumlah
                                                            {{ 'RP ' . number_format($pembayaran->jumlah_pembayaran, 0, ',', '.') }},
                                                            dibayar pada {{ $tanggal_pembayaran }} jam {{ $variabel_jam }}
                                                            dan diterima dan diterima oleh
                                                            {{ $pembayaran->user->nama_admin }}
                                                        </p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <p class="text-center">Tidak ada tagihan</p>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal KTP --}}
    <div class="modal fade" id="ktpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">KTP Santri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-dark" id="dynamicContent">
                    <div class="px-3 py-2">
                        <div class="mt-2 text-center">
                            @if ($santri->ktp_santri === null)
                                <div class="bg-light" style="width: 440px; height: 300px; border-radius: 20px;">
                                    <p class="text-center text-secondary" style="padding-top: 100px;">Gambar tidak ada.
                                    </p>
                                </div>
                            @else
                                <img src="{{ asset('berkas_santri/ktp_santri/' . $santri->ktp_santri) }}"
                                    alt="KTP Santri" class="img-fluid" style="max-width: 440px; border-radius: 20px;">
                                <p class="mt-2"><a
                                        href="{{ asset('berkas_santri/ktp_santri/' . $santri->ktp_santri) }}"
                                        download>Download KTP</a></p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal KK --}}
    <div class="modal fade" id="kkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">KK Santri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-dark" id="dynamicContent">
                    <div class="px-3 py-2">
                        <div class="mt-2 text-center">
                            @if ($santri->kk_santri === null)
                                <div class="bg-light" style="width: 600px; height: 400px; border-radius: 20px;">
                                    <p class="text-center text-secondary" style="padding-top: 150px;">Gambar tidak ada.
                                    </p>
                                </div>
                            @else
                                <img src="{{ asset('berkas_santri/kk_santri/' . $santri->kk_santri) }}" alt="KK Santri"
                                    class="img-fluid" style="max-width: 600px; border-radius: 20px;">
                                <p class="mt-2"><a href="{{ asset('berkas_santri/kk_santri/' . $santri->kk_santri) }}"
                                        download>Download KK</a></p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Akta --}}
    <div class="modal fade" id="aktaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Akta Santri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-dark" id="dynamicContent">
                    <div class="px-3 py-2">
                        <div class="mt-2 text-center">
                            @if ($santri->akta_santri === null)
                                <div class="bg-light" style="width: 600px; height: 400px; border-radius: 20px;">
                                    <p class="text-center text-secondary" style="padding-top: 150px;">Gambar tidak ada.
                                    </p>
                                </div>
                            @else
                                <img src="{{ asset('berkas_santri/akta_santri/' . $santri->akta_santri) }}"
                                    alt="Akta Santri" class="img-fluid" style="max-width: 600px; border-radius: 20px;">
                                <p class="mt-2"><a
                                        href="{{ asset('berkas_santri/akta_santri/' . $santri->akta_santri) }}"
                                        download>Download Akta</a></p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Pas Foto --}}
    <div class="modal fade" id="pasfotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Pas Foto Santri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-dark" id="dynamicContent">
                    <div class="px-3 py-2">
                        <div class="mt-2 text-center">
                            @if ($santri->pas_foto_santri === null)
                                <div class="bg-light" style="width: 440px; height: 300px; border-radius: 20px;">
                                    <p class="text-center text-secondary" style="padding-top: 100px;">Gambar tidak ada.
                                    </p>
                                </div>
                            @else
                                <img src="{{ asset('berkas_santri/pas_foto_santri/' . $santri->pas_foto_santri) }}"
                                    alt="Pas Foto Santri" class="img-fluid"
                                    style="max-width: 440px; border-radius: 20px;">
                                <p class="mt-2"><a
                                        href="{{ asset('berkas_santri/pas_foto_santri/' . $santri->pas_foto_santri) }}"
                                        download>Download Pas Foto</a></p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
