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
                <li class="nav-item"><a href="#" class="nav-link text-primary" aria-current="page">Beranda</a></li>
                <li class="nav-item"><a href="#tentangpondok" class="nav-link text-secondary">Tentang Pondok</a></li>
                <li class="nav-item"><a href="#areapondok" class="nav-link text-secondary">Area Pondok</a></li>
                <li class="nav-item"><a href="#kontak" class="nav-link text-secondary">Kontak Kami</a></li>
            </ul>
        </header>
    </div>
@endsection
@section('content')
    {{-- Content --}}
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="px-5 pt-5 p-navy">
                    <h1 class="fw-bold p-black" style="font-size: 50px;">Layanan Informasi Pondok Pesantren</h1>
                    <h1 class="fw-bold p-black" style="font-size: 50px;">"Al-Huda"</h1>
                </div>
                <div class="px-5 mt-5 mb-5">
                    <h6 class="">Layanan Informasi Pondok Pesantren Al-Huda adalah sebuah platform atau situs web yang
                        bertujuan untuk
                        menyediakan informasi terkait dengan Pondok Pesantren Al-Huda.
                    </h6>
                </div>
                <div class="row px-5">
                    <div class="col-lg-4">
                        <button class="btn btn-primary d-inline-flex align-items-center" type="button"
                            onclick="location.href='{{ url('/pendaftaran-santri-baru') }}'">
                            Pendaftaran
                            <span class="ms-3"><i class="bi bi-chevron-right"></i></span>
                        </button>
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-link d-inline-flex align-items-center" type="button"
                            onclick="location.href='#formlogin'" style="text-decoration: none">
                            Login Website
                            <span class="ms-3"><i class="bi bi-chevron-right"></i></span>
                        </button>
                    </div>
                    <div class="col-lg-4">
                        <a class="btn btn-link d-inline-flex align-items-center" type="button"
                            href="{{ url('/donasi') }}" style="text-decoration: none">
                            Donasi
                            <span class="ms-3"><i class="bi bi-chevron-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <img src="{{ asset('images/pondok/asset1.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="container marketing">
        {{-- Tentang Pondok --}}
        <div id="tentangpondok" class="container mt-5 row p-5 align-items-center">
            <div class="col-md-6">
                <h1 class="fw-bold p-black p-navy">Pondok Pesantren Al-Huda</h1>
                <p class="mt-3">Pondok Pesantren Al Huda adalah lembaga pendidikan Islam yang memiliki
                    komitmen kuat untuk memberikan pendidikan berkualitas dan pembinaan karakter kepada santri.
                    Dengan didasarkan pada nilai-nilai keislaman, pesantren kami bertujuan membentuk generasi penerus
                    yang tidak hanya cerdas secara akademis, tetapi juga berakhlak mulia.
                </p>
                <div class="row mt-5">
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-navy pb-0">
                                <h3 class="fw-bold">{{ $total_santri }} <span class="ms-2"><i class="bi bi-people-fill"></i></span></h3>
                                <p>Santri dan Santriwati</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-navy pb-0">
                                <h3 class="fw-bold">{{ $total_guru }} <span class="ms-2"><i class="bi bi-people-fill"></i></span></h3>
                                <p>Tenaga Pendidik</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img class="img-fluid" src="images/pondok/pondok_area2.png" role="img"
                    style="object-fit: cover; border-radius: 15px;">
            </div>
        </div>
        {{-- Visi Misi --}}
        <div class="container mt-5">
            <div class="card border-light mb-3 mx-4 px-5 py-4" style="background-color: #dbeefc; border-radius:15px;">
                <div class="card-body p-navy">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <h1 class="fw-bold p-black">Visi Pondok</h1>
                        </div>
                        <div class="col-lg-7">
                            <ul>
                                <li>Membangun generasi yang beriman, bertakwa, berilmu, dan berakhlakul karimah melalui pendidikan yang komprehensif dan terpadu, 
                                    serta menjadikan Pondok Pesantren Al Huda sebagai pusat unggulan dalam pengembangan ilmu agama dan ilmu pengetahuan.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-light mb-3 mx-4 px-5 py-4" style="background-color: #dbeefc; border-radius:15px;">
                <div class="card-body p-navy">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <h1 class="fw-bold p-black">Misi Pondok</h1>
                        </div>
                        <div class="col-lg-7">
                            <ul>
                                <li>Meningkatkan Kualitas Pendidikan Agama</li>
                                <li>Membina Akhlakul Karimah</li>
                                <li>Mengembangkan Potensi Diri Santri</li>
                                <li>Membangun Lingkungan yang Islami</li>
                                <li>Mendorong Kepedulian Sosial dan Dakwah</li>
                                <li>Memperkuat Hubungan dengan Masyarakat</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5 p-5 pb-0">
            <h1 class="col-8 fw-bold p-black p-navy mb-4">Apasih manfaat belajar di Pondok Pesantren Al-Huda ?</h1>
            <div class="row p-navy mb-4">
                <div class="col">
                    <div class="row p-3" style="background-color: #dbeefc; border-radius:15px;">
                        <div class="col-2 text-center align-self-center">
                            <img src="{{ asset('images/pondok/koran.png') }}" alt="" width="80">
                        </div>
                        <div class="col">
                            <h4 class="fw-bold">Pendidikan Agama yang Mendalam</h4>
                            <p>Pondok pesantren merupakan lembaga pendidikan yang fokus pada pendalaman ilmu agama Islam.
                                Para santri diajarkan Al-Qur'an, hadis, fiqh, akhlak, dan berbagai cabang ilmu agama
                                lainnya. Hal ini memungkinkan para santri untuk mendapatkan pemahaman yang mendalam tentang
                                ajaran Islam dan menerapkannya dalam kehidupan sehari-hari.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-navy mb-4 justify-content-between">
                <div class="col me-2">
                    <div class="row p-3" style="background-color: #dbeefc; border-radius:15px;">
                        <div class="col-4 text-center align-self-center">
                            <img src="{{ asset('images/pondok/opportunity.png') }}" alt="" width="80">
                        </div>
                        <div class="col">
                            <h4 class="fw-bold">Pengembangan Kemandirian</h4>
                            <p>Di pondok pesantren, para santri tinggal dan belajar secara mandiri di lingkungan yang
                                terstruktur, mengembangkan kemandirian, tanggung jawab, dan kepemimpinan melalui kegiatan
                                sehari-hari.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col ms-2">
                    <div class="row p-3" style="background-color: #dbeefc; border-radius:15px;">
                        <div class="col-4 text-center align-self-center">
                            <img src="{{ asset('images/pondok/agreement.png') }}" alt="" width="80">
                        </div>
                        <div class="col">
                            <h4 class="fw-bold">Pendidikan Karakter dan Etika</h4>
                            <p>Pondok pesantren menanamkan nilai-nilai moral dan etika yang tinggi kepada para santrinya,
                                membentuk individu yang jujur, disiplin, bertanggung jawab, dan menghormati sesama manusia.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-navy mb-4 justify-content-between">
                <div class="col me-2">
                    <div class="row p-3" style="background-color: #dbeefc; border-radius:15px;">
                        <div class="col-4 text-center align-self-center">
                            <img src="{{ asset('images/pondok/content-writing.png') }}" alt="" width="80">
                        </div>
                        <div class="col">
                            <h4 class="fw-bold">Pengembangan Keterampilan Hidup</h4>
                            <p>Selain ilmu agama, pondok pesantren memberikan pelatihan keterampilan praktis seperti
                                pertanian, tata boga, kerajinan tangan, dan lainnya.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col ms-2">
                    <div class="row p-3" style="background-color: #dbeefc; border-radius:15px;">
                        <div class="col-4 text-center align-self-center">
                            <img src="{{ asset('images/pondok/mountain.png') }}" alt="" width="80">
                        </div>
                        <div class="col">
                            <h4 class="fw-bold">Pembentukan Kepribadian yang Kokoh</h4>
                            <p>Belajar di pondok pesantren membentuk kepribadian yang kokoh dan kuat dengan mengajarkan
                                kesabaran, ketekunan, dan keuletan dalam menghadapi cobaan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Galleri --}}
        <div id="areapondok" class="container mt-5 p-5">
            <h1 class="fw-bold p-black p-navy mb-4">Area Pondok</h1>
            <div id="carouselExample" class="carousel slide carousel-fade mb-0" data-bs-ride="carousel"
                data-bs-interval="3000">
                <div class="carousel-inner" style="border-radius: 15px;">
                    @foreach ($imageNames as $index => $imageName)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('images/pondok/area_pondok/' . $imageName) }}"
                                class="d-block w-100 img-fluid" alt="{{ $imageName }}" style="object-fit: cover;">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        {{-- Kontak --}}
        <div id="kontak" class="container mt-5 p-5">
            <div class="row align-items-center">
                <div class="col-12 col-lg-8">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.357019913914!2d111.47367157477133!3d-8.267217041766779!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e793f8702ac8951%3A0x58518eb6ffb8d3d7!2sPONDOK%20PESANTREN%20AL%20HUDA%20BANJAR%20PANGGUL!5e0!3m2!1sen!2sid!4v1709801452881!5m2!1sen!2sid"
                        width="100%" height="450" style="border:0; object-fit: cover; border-radius:15px;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col">
                    <h1 class="fw-bold p-black p-navy">Kontak Kami</h1>
                    <div class="row mb-2">
                        <div class="col row">
                            <div class="col-1 p-navy"><i class="bi bi-geo-alt-fill"></i></div>
                            <div class="col">RT.011/RW.002, Pagersari, Banjar, Panggul, Trenggalek Regency, East Java
                                66364</div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col row">
                            <div class="col-1 p-navy"><i class="bi bi-telephone-fill"></i></div>
                            <div class="col">081234xxxxx</div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col row">
                            <div class="col-1 p-navy">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                                </svg>
                            </div>
                            <div class="col">pondokpesantrenalhuda@gmail.com</div>
                        </div>
                    </div>
                    <div class="row mt-4 mb-2">
                        <h5 class="fw-bold p-navy">Sosial Media Kami</h5>
                        <div class="col-2 row">
                            <div class="col">
                                <a class="icon-link p-navy" href="#" style="font-size: 25px">
                                    <i class="bi bi-instagram"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-2 row">
                            <div class="col">
                                <a class="icon-link p-navy" href="#" style="font-size: 25px">
                                    <i class="bi bi-youtube"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-2 row">
                            <div class="col">
                                <a class="icon-link p-navy" href="#" style="font-size: 25px">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Form Login --}}
    <div class="container mt-5 mb-5 pb-5 px-5" id="formlogin">
        <div class="card" style="border: none">
            <div class="card-body row">
                <div class="col">
                    <img class="" src="{{ asset('images/pondok/asset2.png') }}" alt="" width="70%">
                </div>
                <div class="col">
                    <h1 class="mb-0 fw-bold p-navy">Login Website</h1>
                    <p>Masukkan email dan password untuk mengakses website.</p>
                    {{-- Notifikasi --}}
                    @if ($errors->any())
                        @foreach ($errors->all() as $err)
                            <div class="z-index-2">
                                <div class="alert text-white bg-danger" role="alert">
                                    <div class="iq-alert-icon">
                                        <i class="ri-information-line"></i>
                                    </div>
                                    <div class="iq-alert-text"><b>Gagal ! </b> {{ $err }}</div>
                                    <button class="btn btn-tutup text-white" type="button" data-dismiss="alert"
                                        aria-label="Close">
                                        <i class="ri-close-line"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <form class="mt-4" action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control mb-0" id="exampleInputEmail1" name="email"
                                placeholder="Masukkan Email">
                        </div>
                        <div class="form-group mt-3">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control mb-0" id="exampleInputPassword1" name="password"
                                placeholder="Masukkan Password">
                        </div>
                        <div class="checkbox mt-3">
                            <label><input type="checkbox" name="remember" value="true"> Remember me</label>
                        </div>
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
