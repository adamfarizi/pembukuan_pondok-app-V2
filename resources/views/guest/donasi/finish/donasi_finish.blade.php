@extends('guest/app_guest')
@section('header')
    {{-- Header --}}
    <div class="container">
        <header class="d-flex py-3 mb-4 px-5">
            <a href="/"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="{{ asset('images/pondok/logo.png') }}" alt="" class="bi me-2" width="50">
                {{-- <span class="fs-4"><h4 class="mt-2">Pondok Pesantren Al-Huda</h4></span> --}}
            </a>
            <ul class="nav nav-pills text-right">
                <li class="nav-item"><a href="/#" class="nav-link text-secondary" aria-current="page">Beranda</a></li>
                <li class="nav-item"><a href="/#tentangpondok" class="nav-link text-secondary">Tentang Pondok</a></li>
                <li class="nav-item"><a href="/#areapondok" class="nav-link text-secondary">Area Pondok</a></li>
                <li class="nav-item"><a href="/#kontak" class="nav-link text-secondary">Kontak Kami</a></li>
            </ul>
        </header>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="overlay">
                        <img src="{{ asset('images/pondok/area_pondok/area_pondok2.jpg') }}" class="card-img-top"
                            alt="">
                        <div class="overlay-background">
                            <div class="overlay-text">
                                <h1 class="mb-2 fw-bold">Donasi Pondok Pesantren</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card p-4" style="background-color: #f5f5f5; border:none;">
                            <div class="card-body row">
                                <div class="col-3"></div>
                                <div class="col-lg-6 text-center">
                                    <div class="text-center align-items-center">
                                        <img src="{{ asset('images/pondok/asset4.png') }}" alt="" class="img-fluid" style="height: 40vh;">
                                    </div>
                                    <h2 class="fw-bold p-black p-navy mt-2" style="display: flex; align-items: center;">
                                        <i class="bi bi-check-circle-fill text-success" style="margin-right: 10px;"></i>
                                        Terima Kasih atas Donasi Anda !
                                    </h2>
                                    <br>
                                    <p class="mb-0">Untuk konfirmasi lebih lanjut atau informasi lebih detail, silakan menghubungi admin
                                        dengan nomor berikut:</p>
                                    <h3 class="fw-bold p-black p-navy my-3">+628123456789 (Admin)</h3>
                                    <div class="mt-4">
                                        <a type="button" class="btn btn-primary col-12" href="{{ url('/') }}">Selesai</a>
                                    </div>
                                </div>
                                <div class="col-3"></div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
