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
                <h5 class="mb-0">Daftar Mata Pelajaran</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Informasi</li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Mata Pelajaran</li>
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
                                        <h5 class="mb-0 text-white line-height">{{Auth::user()->nama_wali_santri}}</h5>
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
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Daftar Mata Pelajaran</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                            <table class="table">
                               <thead>
                                  <tr>
                                     <th scope="col">#</th>
                                     <th scope="col">Mata Pelajaran</th>
                                     <th class="text-center" scope="col">Keterangan</th>
                                  </tr>
                               </thead>
                               <tbody>
                                  <tr>
                                     <th scope="row">1</th>
                                     <td>Al-Quran dan Tajwid</td>
                                     <td>Pembelajaran tentang bacaan Al-Qur’an, tajwid (pengucapan yang benar), 
                                        serta pemahaman dan penafsiran terhadap ayat-ayat Al-Qur’an.</td>
                                  </tr>
                                  <tr>
                                     <th scope="row">2</th>
                                     <td>Bahasa Arab</td>
                                     <td>Pembelajaran tata bahasa, kosakata, serta kemampuan membaca, menulis, dan berbicara dalam bahasa Arab.</td>
                                  </tr>
                                  <tr>
                                     <th scope="row">3</th>
                                     <td>Fiqh</td>
                                     <td>Pembelajaran tentang prinsip-prinsip hukum Islam yang meliputi ibadah, muamalah (urusan sosial-ekonomi), dan hukum keluarga, 
                                        serta bagaimana menerapkannya dalam kehidupan sehari-hari.</td>
                                  </tr>
                                  <tr>
                                     <th scope="row">4</th>
                                     <td>Hadist</td>
                                     <td>Pembelajaran tentang hadis-hadis yang berhubungan dengan etika, hukum Islam, dan nasihat kehidupan sehari-hari.</td>
                                  </tr>
                                  <tr>
                                     <th scope="row">5</th>
                                     <td>Aqidah</td>
                                     <td>Pembelajaran tentang prinsip-prinsip dasar Islam, seperti keimanan kepada Allah, malaikat, kitab-kitab suci, rasul-rasul, 
                                        hari kiamat, dan takdir.</td>
                                  </tr>
                                  <tr>
                                     <th scope="row">6</th>
                                     <td>Sirah Nabawiyyah</td>
                                     <td>Pembelajaran tentang sejarah hidup Nabi, peristiwa-peristiwa penting dalam sejarah Islam, 
                                        serta pelajaran moral dan nilai-nilai yang dapat dipetik dari kehidupan Nabi.</td>
                                  </tr>
                                  <tr>
                                     <th scope="row">7</th>
                                     <td>Tazkiyatun Nafs</td>
                                     <td>Pelajaran ini bertujuan untuk memperbaiki akhlak dan membentuk kepribadian yang baik. 
                                        Peserta didik mempelajari tentang akhlak terpuji, seperti sabar, ikhlas, tawakal, dan sebagainya.</td>
                                  </tr>
                                  <tr>
                                     <th scope="row">8</th>
                                     <td>Tarikh</td>
                                     <td>Pelajaran ini mencakup sejarah perkembangan Islam dari masa awal hingga masa sekarang. 
                                        Para santri mempelajari tentang peristiwa-peristiwa penting, tokoh-tokoh penting dalam sejarah Islam, 
                                        dan pengaruhnya terhadap peradaban Islam.</td>
                                  </tr>
                               </tbody>
                            </table>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection