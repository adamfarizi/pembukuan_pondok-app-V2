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
                                <h1 class="mb-2 fw-bold">Pendaftaran Santri Baru</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card p-4" style="background-color: #f5f5f5; border:none;">
                            <div class="card-body row">
                                <div class="col-lg-6">
                                    <h2 class="fw-bold p-black p-navy mt-2" style="display: flex; align-items: center;">
                                        <i class="bi bi-check-circle-fill text-success" style="margin-right: 10px;"></i>
                                        Pendaftaran Berhasil !
                                    </h2>
                                    <br>
                                    <p class="mb-0">Lakukan pendaftaran ulang di pondok pesantren dengan menunjukkan
                                        <strong>kode
                                            pendaftaran</strong> berikut:
                                    </p>
                                    <h3 class="fw-bold p-black p-navy my-3">{{ $kode_pendaftaran }}</h3>
                                    <p class="mb-0">Berikut adalah berkas yang perlu dibawa ketika daftar ulang.</p>
                                    <ol>
                                        <li>Berkas <strong>KTP Pendaftar</strong> asli beserta foto copy.</li>
                                        <li>Berkas <strong>Kartu Keluarga Pendaftar</strong> asli beserta foto copy.</li>
                                        <li>Berkas <strong>Akta Kelahiran Pendaftar</strong> asli beserta foto copy.</li>
                                        <li>Berkas <strong>Pas Foto Pendaftar</strong> asli.</li>
                                    </ol>
                                    <p class="fw-bold">Jadikan satu berkas didalam map warna merah untuk putra dan kuning
                                        untuk putri</p>
                                    <br>
                                    <div class="mt-4">
                                        <a type="button" class="btn btn-primary col-12"
                                            href="{{ url('/') }}">Selesai</a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="text-center align-items-center">
                                        <img src="{{ asset('images/pondok/asset4.png') }}" alt="" class="img-fluid"
                                            style="height: 65vh;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
