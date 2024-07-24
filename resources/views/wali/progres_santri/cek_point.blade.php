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
                <h5 class="mb-0">Cek Point</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Progres Santri</li>
                        <li class="breadcrumb-item active" aria-current="page">Cek Point</li>
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
        <!-- Alert -->
        <div class="container-fluid">
            <div class="row">
                <!-- PDF Viewer Card -->
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Daftar Point Pelanggaran Santri</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <a type="button" href="#" class="btn btn-lg" id="toggleCardBody"><i
                                        class="ri-arrow-down-s-line"></i> Perbesar</a>
                            </div>
                        </div>
                        <div class="iq-card-body" id="cardBody" style="display: none;">
                            <div class="pdf-viewer mb-4">
                                <iframe src="{{ asset('assets/local/point_santri.pdf') }}" width="100%" height="500px">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Card -->
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Cek Point Santri</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <p>Selamat datang di halaman Cek Nilai Santri Pondok Pesantren Al Huda. Berikut adalah point
                                santri pada semester <b>{{ $currentSemester['semester'] }}</b>, tahun ajaran
                                <b>{{ $currentSemester['tahun'] }}.</b>
                            </p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th class="text-center" scope="col">Tanggal</th>
                                            <th class="text-center" scope="col">Jenis Pelanggaran</th>
                                            <th class="" scope="col">Deskripsi Pelanggaran</th>
                                            <th class="text-center" scope="col">Point</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($point_santris as $point_santri)
                                            @php

                                                $tanggal_point = \Carbon\Carbon::parse(
                                                    $point_santri->tanggal_point_santri,
                                                )->translatedFormat('d F Y'); // Format tanggal dengan hari dan bulan dalam bahasa Indonesia

                                                $jam_point = \Carbon\Carbon::parse(
                                                    $point_santri->tanggal_point_santri,
                                                )->format('H:i'); // Format waktu

                                            @endphp
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td class="text-center">{{ $tanggal_point }}</td>
                                                <td class="text-center">
                                                    @switch($point_santri->jenis_point_santri)
                                                        @case('A')
                                                            Pelanggaran Kehadiran
                                                        @break

                                                        @case('B')
                                                            Pelanggaran Etika, Kesusilaan, dan Perkelahian
                                                        @break

                                                        @case('C')
                                                            Pelanggaran Administrasi
                                                        @break

                                                        @case('D')
                                                            Pelanggaran Permainan dan Barang atau Benda Terlarang
                                                        @break

                                                        @case('E')
                                                            Pelanggaran Tindakan Pengrusakan dan Kriminal
                                                        @break

                                                        @default
                                                            Lainnya
                                                    @endswitch
                                                </td>
                                                <td style="max-width: 200px;">
                                                    {{ $point_santri->deskripsi_point_santri }}
                                                </td>
                                                <td class="text-center">{{ $point_santri->jumlah_point_santri }}</td>
                                            </tr>
                                            @empty
                                                <tr class="text-center">
                                                    <td colspan="6">Tidak ada data</td>
                                                </tr>
                                            @endforelse
                                            <tr class="border">
                                                <td colspan="3"></td>
                                                <th>Total Point : </th>
                                                <td class="text-center">{{ $point_santris->sum('jumlah_point_santri') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row text-white">
                                    @php
                                        $totalPoint = $point_santris->sum('jumlah_point_santri');
                                    @endphp

                                    @if ($totalPoint <= 0)
                                        <div class="col-12">
                                            <div class="alert bg-primary" role="alert">
                                                Santri tidak melakukan pelanggaran pada semester ini !
                                            </div>
                                        </div>
                                    @elseif ($totalPoint <= 50)
                                        <div class="col-12">
                                            <div class="alert bg-danger" role="alert">
                                                <div>
                                                    <p class="mb-0">Santri memiliki point pelanggaran sejumlah
                                                        <b>{{ $totalPoint }} point</b>. Berikut adalah beberapa sanksi yang
                                                        akan diberikan :
                                                    </p>
                                                    <ol>
                                                        <li>Peringatan tertulis.</li>
                                                        <li>Tugas tambahan atau pengabdian masyarakat.</li>
                                                        <li>Pembatasan kegiatan ekstrakurikuler.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($totalPoint <= 100)
                                        <div class="col-12">
                                            <div class="alert bg-danger" role="alert">
                                                <div>
                                                    <p class="mb-0">Santri memiliki point pelanggaran sejumlah
                                                        <b>{{ $totalPoint }} point</b>. Berikut adalah beberapa sanksi yang
                                                        akan diberikan :
                                                    </p>
                                                    <ol>
                                                        <li>Peringatan tertulis dan pertemuan dengan orang tua/wali.</li>
                                                        <li>Mengikuti program bimbingan dan konseling.</li>
                                                        <li>Dibatasi dalam kegiatan sosial atau organisasi.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($totalPoint <= 150)
                                        <div class="col-12">
                                            <div class="alert bg-danger" role="alert">
                                                <div>
                                                    <p class="mb-0">Santri memiliki point pelanggaran sejumlah
                                                        <b>{{ $totalPoint }} point</b>. Berikut adalah beberapa sanksi yang
                                                        akan diberikan :
                                                    </p>
                                                    <ol>
                                                        <li>Dikenakan denda atau pembayaran kompensasi.</li>
                                                        <li>Dilarang mengikuti kegiatan khusus.</li>
                                                        <li>Dilarang menggunakan fasilitas tertentu di pesantren.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($totalPoint <= 200)
                                        <div class="col-12">
                                            <div class="alert bg-danger" role="alert">
                                                <div>
                                                    <p class="mb-0">Santri memiliki point pelanggaran sejumlah
                                                        <b>{{ $totalPoint }} point</b>. Berikut adalah beberapa sanksi yang
                                                        akan diberikan :
                                                    </p>
                                                    <ol>
                                                        <li>Dikeluarkan dari kegiatan atau acara penting di pesantren.</li>
                                                        <li>Penundaan sementara keanggotaan organisasi atau komite.</li>
                                                        <li>Perluasan sanksi administratif yang lebih serius.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Point Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Konten modal di sini -->
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col">Nama Pelanggaran</th>
                                    <th scope="col" class="text-center">Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-center">1</th>
                                    <td>Terlambat</td>
                                    <td class="text-center">5</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">2</th>
                                    <td>Membawa HP</td>
                                    <td class="text-center">25</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">3</th>
                                    <td>Melanggar Tata Tertib</td>
                                    <td class="text-center">10</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">4</th>
                                    <td>Tidak mengkuti kegiatan tanpa izin</td>
                                    <td class="text-center">20</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center">5</th>
                                    <td>Terlambat shalat fardhu</td>
                                    <td class="text-center">5</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toggleButton = document.getElementById('toggleCardBody');
                const cardBody = document.getElementById('cardBody');

                toggleButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    if (cardBody.style.display !== 'none') {
                        cardBody.style.display = 'none';
                        toggleButton.innerHTML = '<i class="ri-arrow-down-s-line"></i> Perbesar';
                    } else {
                        cardBody.style.display = 'block';
                        toggleButton.innerHTML = '<i class="ri-arrow-up-s-line"></i> Perkecil';
                    }
                });
            });
        </script>
    @endsection
