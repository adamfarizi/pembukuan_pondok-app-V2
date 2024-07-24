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
                <h5 class="mb-0">Edit Santri</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Santri</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Data Santri</li>
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
                                        <h5 class="mb-0 text-white line-height">Nama User</h5>
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
        {{-- Form Edit --}}
        <div class="container-fluid">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Tambah Data Santri</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <p>Lengkapi form dibawah dengan benar untuk menambah data.</p>
                    <form action="{{ url('/admin/santri/edit/' . $santri->id_santri . '/action') }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_santri">Nama Santri <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_santri" name="nama_santri"
                                    value="{{ $santri->nama_santri }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tempat_tanggal_lahir_santri">Tempat, Tanggal Lahir <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="tempat_tanggal_lahir_santri"
                                    name="tempat_tanggal_lahir_santri" value="{{ $santri->tempat_tanggal_lahir_santri }}"
                                    required>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="no_hp_santri">No Hp Santri <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="no_hp_santri" name="no_hp_santri"
                                            value="{{ $santri->no_hp_santri }}" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email_santri">Email Santri <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email_santri" name="email_santri"
                                            value="{{ $santri->email_santri }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="jenis_kelamin_santri">Jenis Kelamin Santri <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="jenis_kelamin_santri"
                                            id="jenis_kelamin_santri" required>
                                            <option value="laki-laki" @if ($santri->jenis_kelamin_santri == 'laki-laki') selected @endif>
                                                Laki Laki</option>
                                            <option value="perempuan" @if ($santri->jenis_kelamin_santri == 'perempuan') selected @endif>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="status_santri">Status Santri <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status_santri" id="status_santri" required>
                                            <option value="menetap" @if ($santri->status_santri == 'menetap') selected @endif>
                                                Menetap</option>
                                            <option value="pulang" @if ($santri->status_santri == 'pulang') selected @endif>Pulang
                                                Pergi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat_santri">Alamat Santri <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat_santri" name="alamat_santri" rows="2" required>{{ $santri->alamat_santri }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nama_wali_santri">Nama Wali Santri <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_wali_santri"
                                            name="nama_wali_santri" value="{{ $wali_santri->nama_wali_santri }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="no_hp_wali_santri">No Hp Wali Santri <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="no_hp_wali_santri"
                                            name="no_hp_wali_santri" value="{{ $wali_santri->no_hp }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email_wali_santri">Email Wali Santri <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email_wali_santri"
                                            name="email_wali_santri" value="{{ $wali_santri->email }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat_wali_santri">Alamat Wali Santri <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat_wali_santri" name="alamat_wali_santri" rows="2" required>{{ $wali_santri->alamat_wali_santri }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="ktp_santri">KTP Santri <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control-file mb-3" id="ktp_santri"
                                            name="ktp_santri">
                                        @if ($santri->ktp_santri !== null)
                                            <img src="{{ asset('berkas_santri/ktp_santri/' . $santri->ktp_santri) }}"
                                                alt="KTP Santri" style="max-width: 460px; border-radius: 20px;">
                                        @else
                                            <div class="bg-light" style="width: 460px; border-radius:20px;">
                                                <p class="text-center text-secondary"
                                                    style="padding-top: 100px; padding-bottom:100px;">Gambar tidak ada.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kk_santri">KK Santri <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control-file mb-3" id="kk_santri"
                                            name="kk_santri">
                                        @if ($santri->kk_santri !== null)
                                            <img src="{{ asset('berkas_santri/kk_santri/' . $santri->kk_santri) }}"
                                                alt="KK Santri" style="max-width: 460px; border-radius: 20px;">
                                        @else
                                            <div class="bg-light" style="width: 460px; border-radius:20px;">
                                                <p class="text-center text-secondary"
                                                    style="padding-top: 100px; padding-bottom:100px;">Gambar tidak ada.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="akta_santri">Akta Santri <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control-file mb-3" id="akta_santri"
                                            name="akta_santri">
                                        @if ($santri->akta_santri !== null)
                                            <img src="{{ asset('berkas_santri/akta_santri/' . $santri->akta_santri) }}"
                                                alt="KTP Santri" style="max-width: 460px; border-radius: 20px;">
                                        @else
                                            <div class="bg-light" style="width: 460px; border-radius:20px;">
                                                <p class="text-center text-secondary"
                                                    style="padding-top: 100px; padding-bottom:100px;">Gambar tidak ada.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pas_foto_santri">Pas Foto Santri <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control-file mb-3" id="pas_foto_santri"
                                            name="pas_foto_santri">
                                        @if ($santri->pas_foto_santri !== null)
                                            <img src="{{ asset('berkas_santri/pas_foto_santri/' . $santri->pas_foto_santri) }}"
                                                alt="KK Santri" style="max-width: 460px; border-radius: 20px;">
                                        @else
                                            <div class="bg-light" style="width: 460px; border-radius:20px;">
                                                <p class="text-center text-secondary"
                                                    style="padding-top: 100px; padding-bottom:100px;">Gambar tidak ada.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a type="button" href="{{ route('santri') }}" class="btn iq-bg-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
