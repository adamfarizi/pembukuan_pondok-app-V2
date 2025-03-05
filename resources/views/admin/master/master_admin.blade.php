@extends('admin/app_admin')
@section('navbar')
    <!-- TOP Nav Bar -->
    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <div class="iq-sidebar-logo">
                <div class="top-logo">
                    <a href="index.html" class="logo">
                        <span>Al-Huda Admin</span>
                    </a>
                </div>
            </div>
            {{-- Halaman --}}
            <div class="navbar-breadcrumb">
                <h5 class="mb-0">Master Admin</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Master Admin</li>
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
                                        <h5 class="mb-0 text-white line-height">{{ Auth::user()->nama_admin }}</h5>
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
    <div id="content-page" class="content-page">
        <div class="container-fluid col-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card iq-mb-3 text-white bg-secondary">
                        <div class="card-body">
                            <h4 class="card-title text-white">Informasi</h4>
                            <blockquote class="blockquote mb-0">
                                <p class="font-size-14">
                                    "Data master berisi informasi penting yang mengatur nominal untuk empat jenis tagihan:
                                    daftar baru, daftar ulang, semester, dan iuran bulanan. Admin dapat mengubah rincian
                                    setiap tagihan sesuai kebutuhan. Jika proses pembuatan tagihan otomatis gagal, admin
                                    juga dapat membuat tagihan daftar ulang, semester, dan iuran bulanan secara manual untuk
                                    memastikan kelancaran sistem pembayaran."
                                </p>
                                <footer class="blockquote-footer text-white font-size-12">Developer</footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Alert -->
        <div class="container-fluid">
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
        <div class="d-flex">
            @php
                // Daftar Baru
                $daftar_baru_mukim_l = $daftar_baru
                    ->where('jenis_mukim', 'mukim')
                    ->where('jenis_santri', 'l')
                    ->sum('total_pembayaran');
                $daftar_baru_mukim_p = $daftar_baru
                    ->where('jenis_mukim', 'mukim')
                    ->where('jenis_santri', 'p')
                    ->sum('total_pembayaran');
                $daftar_baru_non_mukim_l = $daftar_baru
                    ->where('jenis_mukim', 'tdk_mukim')
                    ->where('jenis_santri', 'l')
                    ->sum('total_pembayaran');
                $daftar_baru_non_mukim_p = $daftar_baru
                    ->where('jenis_mukim', 'tdk_mukim')
                    ->where('jenis_santri', 'p')
                    ->sum('total_pembayaran');

                // Daftar Ulang
                $daftar_ulang_mukim_l = $daftar_ulang
                    ->where('jenis_mukim', 'mukim')
                    ->where('jenis_santri', 'l')
                    ->sum('total_pembayaran');
                $daftar_ulang_mukim_p = $daftar_ulang
                    ->where('jenis_mukim', 'mukim')
                    ->where('jenis_santri', 'p')
                    ->sum('total_pembayaran');
                $daftar_ulang_non_mukim_l = $daftar_ulang
                    ->where('jenis_mukim', 'tdk_mukim')
                    ->where('jenis_santri', 'l')
                    ->sum('total_pembayaran');
                $daftar_ulang_non_mukim_p = $daftar_ulang
                    ->where('jenis_mukim', 'tdk_mukim')
                    ->where('jenis_santri', 'p')
                    ->sum('total_pembayaran');

                // Semester
                $semester_mukim_l = $semester
                    ->where('jenis_mukim', 'mukim')
                    ->where('jenis_santri', 'l')
                    ->sum('total_pembayaran');
                $semester_mukim_p = $semester
                    ->where('jenis_mukim', 'mukim')
                    ->where('jenis_santri', 'p')
                    ->sum('total_pembayaran');
                $semester_non_mukim_l = $semester
                    ->where('jenis_mukim', 'tdk_mukim')
                    ->where('jenis_santri', 'l')
                    ->sum('total_pembayaran');
                $semester_non_mukim_p = $semester
                    ->where('jenis_mukim', 'tdk_mukim')
                    ->where('jenis_santri', 'p')
                    ->sum('total_pembayaran');
                // Iuran
                $iuran_mukim_l = $iuran
                    ->where('jenis_mukim', 'mukim')
                    ->where('jenis_santri', 'l')
                    ->sum('total_pembayaran');
                $iuran_mukim_p = $iuran
                    ->where('jenis_mukim', 'mukim')
                    ->where('jenis_santri', 'p')
                    ->sum('total_pembayaran');
                $iuran_non_mukim_l = $iuran
                    ->where('jenis_mukim', 'tdk_mukim')
                    ->where('jenis_santri', 'l')
                    ->sum('total_pembayaran');
                $iuran_non_mukim_p = $iuran
                    ->where('jenis_mukim', 'tdk_mukim')
                    ->where('jenis_santri', 'p')
                    ->sum('total_pembayaran');
            @endphp
            {{-- Daftar Baru --}}
            <div class="container-fluid col-sm-3">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Daftar Baru</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="row">
                                    <ul class="col" style="list-style-type:circle; padding-left: 10%;">
                                        <h5>Mukim</h5>
                                        <li>Laki-laki : </li>
                                        <h6>Rp. {{ number_format($daftar_baru_mukim_l, 0, ',', '.') }}</h6>
                                        <li>Perempuan : </li>
                                        <h6>Rp. {{ number_format($daftar_baru_mukim_p, 0, ',', '.') }}</h6>
                                    </ul>
                                    <ul class="col" style="list-style-type:circle; padding-left: 10%;">
                                        <h5>Non Mukim</h5>
                                        <li>Laki-laki : </li>
                                        <h6>Rp. {{ number_format($daftar_baru_non_mukim_l, 0, ',', '.') }}</h6>
                                        <li>Perempuan : </li>
                                        <h6>Rp. {{ number_format($daftar_baru_non_mukim_p, 0, ',', '.') }}</h6>
                                    </ul>
                                </div>
                                <a type="button" href="{{ url('/admin/master_admin/rincian/daftar_baru') }}"
                                    class="btn btn-primary btn-block">Ubah</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Daftar Ulang --}}
            <div class="container-fluid col-sm-3">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Daftar Ulang</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="row">
                                    <ul class="col" style="list-style-type:circle; padding-left: 10%;">
                                        <h5>Mukim</h5>
                                        <li>Laki-laki : </li>
                                        <h6>Rp. {{ number_format($daftar_ulang_mukim_l, 0, ',', '.') }}</h6>
                                        <li>Perempuan : </li>
                                        <h6>Rp. {{ number_format($daftar_ulang_mukim_p, 0, ',', '.') }}</h6>
                                    </ul>
                                    <ul class="col" style="list-style-type:circle; padding-left: 10%;">
                                        <h5>Non Mukim</h5>
                                        <li>Laki-laki : </li>
                                        <h6>Rp. {{ number_format($daftar_ulang_non_mukim_l, 0, ',', '.') }}</h6>
                                        <li>Perempuan : </li>
                                        <h6>Rp. {{ number_format($daftar_ulang_non_mukim_p, 0, ',', '.') }}</h6>
                                    </ul>
                                </div>
                                <a type="button" href="{{ url('/admin/master_admin/rincian/daftar_ulang') }}"
                                    class="btn btn-primary btn-block">Ubah</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Semester --}}
            <div class="container-fluid col-sm-3">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Semester</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="row">
                                    <ul class="col" style="list-style-type:circle; padding-left: 10%;">
                                        <h5>Mukim</h5>
                                        <li>Laki-laki : </li>
                                        <h6>Rp. {{ number_format($semester_mukim_l, 0, ',', '.') }}</h6>
                                        <li>Perempuan : </li>
                                        <h6>Rp. {{ number_format($semester_mukim_p, 0, ',', '.') }}</h6>
                                    </ul>
                                    <ul class="col" style="list-style-type:circle; padding-left: 10%;">
                                        <h5>Non Mukim</h5>
                                        <li>Laki-laki : </li>
                                        <h6>Rp. {{ number_format($semester_non_mukim_l, 0, ',', '.') }}</h6>
                                        <li>Perempuan : </li>
                                        <h6>Rp. {{ number_format($semester_non_mukim_p, 0, ',', '.') }}</h6>
                                    </ul>
                                </div>
                                <a type="button" href="{{ url('/admin/master_admin/rincian/semester') }}"
                                    class="btn btn-primary btn-block">Ubah</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Iuran --}}
            <div class="container-fluid col-sm-3">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Iuran</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="row">
                                    <ul class="col" style="list-style-type:circle; padding-left: 10%;">
                                        <h5>Mukim</h5>
                                        <li>Laki-laki : </li>
                                        <h6>Rp. {{ number_format($iuran_mukim_l, 0, ',', '.') }}</h6>
                                        <li>Perempuan : </li>
                                        <h6>Rp. {{ number_format($iuran_mukim_p, 0, ',', '.') }}</h6>
                                    </ul>
                                    <ul class="col" style="list-style-type:circle; padding-left: 10%;">
                                        <h5>Non Mukim</h5>
                                        <li>Laki-laki : </li>
                                        <h6>Rp. {{ number_format($iuran_non_mukim_l, 0, ',', '.') }}</h6>
                                        <li>Perempuan : </li>
                                        <h6>Rp. {{ number_format($iuran_non_mukim_p, 0, ',', '.') }}</h6>
                                    </ul>
                                </div>
                                <a type="button" href="{{ url('/admin/master_admin/rincian/iuran') }}"
                                    class="btn btn-primary btn-block">Ubah</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            {{-- Tagihan Daftar Ulang --}}
            <div class="container-fluid col">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Tagihan Daftar Ulang Tahun {{ $year }}</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="form-group">
                                    <label for="daftar_ulang_baru">Jumlah tagihan santri :</label>
                                    <div class="text-center mt-3">
                                        <h2 class="mb-3"><span>{{ $tagihan_total_daftar_ulang . ' santri' }}</span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="daftar_ulang_baru">Jumlah santri yang <b>belum lunas</b> :</label>
                                    <div class="text-center mt-3">
                                        <h2 class="mb-5"><span>{{ $tagihan_daftar_ulang . ' santri' }}</span></h2>
                                    </div>
                                </div>
                                <form action="{{ route('create_tagihan') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="jenis_pembayaran" value="daftar_ulang">
                                    <button type="submit" class="btn btn-primary btn-block">Buat Tagihan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Tagihan Semester --}}
            <div class="container-fluid col">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Tagihan Semester {{ ucfirst($smt) }}</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="form-group">
                                    <label for="daftar_ulang_baru">Jumlah tagihan santri :</label>
                                    <div class="text-center mt-3">
                                        <h2 class="mb-3"><span
                                                class="">{{ $tagihan_total_semester . ' santri' }}</span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="daftar_ulang_baru">Jumlah santri yang <b>belum lunas</b> :</label>
                                    <div class="text-center mt-3">
                                        <h2 class="mb-5"><span
                                                class="">{{ $tagihan_semester . ' santri' }}</span>
                                        </h2>
                                    </div>
                                </div>
                                <form action="{{ route('create_tagihan') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="jenis_pembayaran" value="tamrin">
                                    <button type="submit" class="btn btn-primary btn-block">Buat Tagihan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Tagihan Bulanan --}}
            <div class="container-fluid col">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Tagihan Bulanan Bulan {{ $month }}</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="form-group">
                                    <label for="daftar_ulang_baru">Jumlah tagihan santri :</label>
                                    <div class="text-center mt-3">
                                        <h2 class="mb-3"><span
                                                class="">{{ $tagihan_total_bulanan . ' santri' }}</span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="daftar_ulang_baru">Jumlah santri yang <b>belum lunas</b> :</label>
                                    <div class="text-center mt-3">
                                        <h2 class="mb-5"><span class="">{{ $tagihan_bulanan . ' santri' }}</span>
                                        </h2>
                                    </div>
                                </div>
                                <form action="{{ route('create_tagihan') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="jenis_pembayaran" value="iuran_bulanan">
                                    <button type="submit" class="btn btn-primary btn-block">Buat Tagihan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Tabel --}}
        @if (auth()->user()->role == 'super_admin')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Data Admin</h4>
                                </div>
                                <div class="text-right">
                                    <a type="button" class="btn btn-primary mt-1" href="" data-toggle="modal"
                                        data-target="#createModal">
                                        Tambah Admin
                                    </a>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="table-responsive pb-3 pt-3 px-3">
                                    <table id="tableAdmin" class="table" role="grid"
                                        aria-describedby="user-list-page-info" style="width: 100%; min-height: 200px;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Admin</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if (auth()->user()->role == 'super_admin')
        <!-- Modal Create Admin-->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ url('/admin/master_admin/create') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_admin">Nama Admin <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_admin" name="nama_admin" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="no_hp_admin">No Hp <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_hp_admin" name="no_hp_admin"
                                        required>
                                </div>
                                <div class="col form-group">
                                    <label for="role">Role <span class="text-danger">*</span></label>
                                    <select class="form-control" id="role" name="role" required>
                                        <option selected="" disabled="">Pilih Jenis Role</option>
                                        <option value="super_admin">Super Admin</option>
                                        <option value="admin_pembayaran">Admin Pembayaran</option>
                                        <option value="admin_penilaian">Admin Penilaian</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Admin-->
        @foreach ($admins as $admin)
            <div class="modal fade" id="editModal{{ $admin->id_admin }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Admin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{ url('/admin/master_admin/edit/' . $admin->id_admin) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama_admin">Nama Admin <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_admin" name="nama_admin"
                                        value="{{ $admin->nama_admin }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $admin->email }}">
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="no_hp_admin">No Hp <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="no_hp_admin" name="no_hp_admin"
                                            value="{{ $admin->no_hp_admin }}">
                                    </div>
                                    <div class="col form-group">
                                        <label for="role">Role <span class="text-danger">*</span></label>
                                        <select class="form-control" id="role" name="role">
                                            <option selected="" disabled="">Pilih Jenis Role</option>
                                            <option value="super_admin"
                                                {{ $admin->role == 'super_admin' ? 'selected' : '' }}>
                                                Super Admin</option>
                                            <option value="admin_pembayaran"
                                                {{ $admin->role == 'admin_pembayaran' ? 'selected' : '' }}>Admin Pembayaran
                                            </option>
                                            <option value="admin_penilaian"
                                                {{ $admin->role == 'admin_penilaian' ? 'selected' : '' }}>Admin Penilaian
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password_lama">Password Lama <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password_lama" name="password_lama">
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="password">Password Baru <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="col form-group">
                                        <label for="password_confirmation">Konfirmasi Password Baru <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Modal Delete Admin-->
        @foreach ($admins as $admin)
            <div class="modal fade" id="deleteModal{{ $admin->id_admin }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{ url('/admin/master_admin/delete/' . $admin->id_admin) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body px-4">
                                <div class="text-center">
                                    <img src="{{ asset('images/local/danger.png') }}" width="80px" alt="">
                                    <h3 class="mt-4">Anda yakin ingin hapus {{ $admin->nama_admin }}?</h3>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

@endsection
@section('js')
    {{-- Table Admin --}}
    <script>
        $(document).ready(function() {
            $('#tableAdmin').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ secure_url('admin/master_admin') }}",
                columns: [
                    // Kolom nomor urut
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama_admin',
                        name: 'nama_admin'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role',
                        render: function(data, type, full, meta) {
                            if (data === 'super_admin') {
                                return '<span class="badge badge-pill badge-primary">Super Admin</span>';
                            } else if (data === 'admin_pembayaran') {
                                return '<span class="badge badge-pill badge-warning">Admin Pembayaran</span>';
                            } else {
                                return '<span class="badge badge-pill badge-success">Admin Penilaian</span>';
                            }
                        }
                    },
                    // Kolom aksi (tombol Info, Edit, Delete)
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return '<td class="text-center">' +
                                '<div class="d-flex align-items-center list-user-action">' +
                                '<a data-placement="top" title="Edit" href="#" data-target="#editModal' +
                                full.id_admin + '" data-toggle="modal" data-id="' + full
                                .id_admin + '">' +
                                '<i class="ri-pencil-line"></i>' +
                                '</a>' +
                                '<a data-placement="top" title="Delete" href="#" data-target="#deleteModal' +
                                full.id_admin + '" data-toggle="modal" data-id="' + full
                                .id_admin + '">' +
                                '<i class="ri-delete-bin-line"></i>' +
                                '</a>' +
                                '</div>' +
                                '</td>';
                        }
                    }
                ],
                lengthMenu: [
                    [10, 25, 50, 100, -1], // Jumlah entries per halaman, -1 untuk Tampilkan Semua Data
                    ['10', '25', '50', '100', 'Semua']
                ]
            });
        });
    </script>
@endsection
