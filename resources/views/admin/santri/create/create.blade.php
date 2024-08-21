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
                <h5 class="mb-0">Santri</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Santri</li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Data Santri</li>
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
                                        <h5 class="mb-0 text-white line-height">{{Auth::user()->nama_admin}}</h5>
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
        {{-- Form Create --}}
        <div class="container-fluid">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Tambah Data Santri</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <p>Lengkapi form dibawah dengan benar untuk menambah data. Form dengan tanda <span class="text-danger">*</span>, wajib diisi !</p>
                    <form action="{{ url('/admin/santri/create/action') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <h5 class="mb-2">IDENTITAS CALON SANTRI</h5>
                            <div class="form-group">
                                <label for="nama_santri">Nama Santri <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_santri" name="nama_santri"
                                    value="{{ old('nama_santri') }}" placeholder="Masukkan Nama Lengkap" required>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="no_induk">No Induk <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_induk" name="no_induk"
                                        value="{{ old('no_induk') }}" placeholder="Masukkan No Induk" required>
                                </div>
                                <div class="col mb-3">
                                    <label for="status_santri">Status Santri <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status_santri"
                                        id="status_santri" required>
                                        <option value="mukim" @if (old('staus_santri') == 'mukim') selected @endif>Mukim (Tinggal)</option>
                                        <option value="tidak_mukim" @if (old('staus_santri') == 'tidak_mukim') selected @endif>Tidak Mukim (Pulang)</option>
                                    </select>
                                </div>
                                <div class="col mb-3">
                                    <label for="tingkatan">Tingkatan <span class="text-danger">*</span></label>
                                    <select class="form-control" name="tingkatan"
                                        id="tingkatan" required>
                                        <option value="1" @if (old('tingkatan') == '1') selected @endif>Kelas 1</option>
                                        <option value="2" @if (old('tingkatan') == '2') selected @endif>Kelas 2</option>
                                        <option value="3" @if (old('tingkatan') == '3') selected @endif>Kelas 3</option>
                                        <option value="4" @if (old('tingkatan') == '4') selected @endif>Kelas 4</option>
                                        <option value="5" @if (old('tingkatan') == '5') selected @endif>Kelas 5</option>
                                        <option value="6" @if (old('tingkatan') == '6') selected @endif>Kelas 6</option>
                                        <option value="1_TSA" @if (old('tingkatan') == '1_TSA') selected @endif>1 TSA</option>
                                        <option value="2_TSA" @if (old('tingkatan') == '2_TSA') selected @endif>2 TSA</option>
                                        <option value="3_TSA" @if (old('tingkatan') == '3_TSA') selected @endif>3 TSA</option>
                                        <option value="pengurus" @if (old('tingkatan') == 'pengurus') selected @endif>Pengurus</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_identitas">No Identitas Santri (KTP/SIM) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="no_identitas" name="no_identitas"
                                    value="{{ old('no_identitas') }}" placeholder="Masukkan No Identitas" required>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tempat_lahir_santri">Tempat Lahir Santri<span
                                            class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="tempat_lahir_santri"
                                            name="tempat_lahir_santri" value="{{ old('tempat_lahir_santri') }}"
                                            placeholder="contoh. Madiun" required>
                                    </div>                              
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tanggal_lahir_santri">Tanggal Lahir Santri<span
                                            class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggal_lahir_santri"
                                            name="tanggal_lahir_santri" value="{{ old('tanggal_lahir_santri') }}"
                                            required>
                                    </div>                              
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="jenis_kelamin_santri">Jenis Kelamin Santri <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="jenis_kelamin_santri"
                                            id="jenis_kelamin_santri" required>
                                            <option value="laki-laki" @if (old('jenis_kelamin_santri') == 'laki-laki') selected @endif>
                                                Laki Laki</option>
                                            <option value="perempuan" @if (old('jenis_kelamin_santri') == 'perempuan') selected @endif>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="rt">RT <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="rt"
                                        name="rt" placeholder="RT" value="{{ old('rt') }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="rw">RW <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="rw"
                                        name="rw" placeholder="RW" value="{{ old('rw') }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="dusun">Dusun <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="dusun"
                                        name="dusun" placeholder="Dusun" value="{{ old('dusun') }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="desa">Desa <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="desa"
                                        name="desa" placeholder="Desa" value="{{ old('desa') }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="kecamatan">Kecamatan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kecamatan"
                                        name="kecamatan" placeholder="Kecamatan" value="{{ old('kecamatan') }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="kab_kota">Kabupaten/Kota <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kab_kota"
                                        name="kab_kota" placeholder="Kabupaten/Kota" value="{{ old('kab_kota') }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="provinsi">Provinsi <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="provinsi"
                                        name="provinsi" placeholder="Provinsi" value="{{ old('provinsi') }}" required>
                                </div>
                                <div class="col-md-3 mb-3"">
                                    <label for="kode_pos">Kode Pos <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kode_pos"
                                        name="kode_pos" placeholder="Kode Pos" value="{{ old('kode_pos') }}" required>
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="no_hp_santri">No Hp Santri </label>
                                        <input type="number" class="form-control" id="no_hp_santri" name="no_hp_santri"
                                            value="{{ old('no_hp_santri') }}" placeholder="Masukkan No HP">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email_santri">Email Santri <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email_santri" name="email_santri"
                                            value="{{ old('email_santri') }}" placeholder="Masukkan Email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="jumlah_saudara_kandung">Jumlah Saudara Kandung </label>
                                    <input type="number" class="form-control" id="jumlah_saudara_kandung"
                                        name="jumlah_saudara_kandung" placeholder="Jumlah Saudara Kandung" value="{{ old('jumlah_saudara_kandung') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="anak_ke">Anak ke </label>
                                    <input type="number" class="form-control" id="anak_ke"
                                        name="anak_ke" placeholder="Anak ke" value="{{ old('anak_ke') }}">
                                </div>
                            </div> 
                            <h5 class="mt-2 mb-2">IDENTITAS ORANG TUA CALON SANTRI</h5>
                            <div class="form-group">
                                <label for="nama_ayah">Nama Ayah <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                    value="{{ old('nama_ayah') }}" placeholder="Masukkan Nama Ayah" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_ibu">Nama Ibu <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                    value="{{ old('nama_ibu') }}" placeholder="Masukkan Nama Ibu" required>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pendidikan_ayah">Pendidikan Ayah </label>
                                        <input type="text" class="form-control" id="pendidikan_ayah"
                                            name="pendidikan_ayah" value="{{ old('pendidikan_ayah') }}" placeholder="Masukkan Pendidikan Ayah">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pendidikan_ibu">Pendidikan Ibu </label>
                                        <input type="text" class="form-control" id="pendidikan_ibu"
                                            name="pendidikan_ibu" value="{{ old('pendidikan_ibu') }}" placeholder="Masukkan Pendidikan Ibu">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pekerjaan_ayah">Pekerjaan Ayah </label>
                                        <input type="text" class="form-control" id="pekerjaan_ayah"
                                            name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" placeholder="Masukkan Pekerjaan Ayah">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pekerjaan_ibu">Pekerjaan Ibu </label>
                                        <input type="text" class="form-control" id="pekerjaan_ibu"
                                            name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" placeholder="Masukkan Pekerjaan Ibu">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pendapatan_ayah_perbulan">Pendapatan Perbulan Ayah </label>
                                        <input type="number" class="form-control" id="pendapatan_ayah_perbulan"
                                            name="pendapatan_ayah_perbulan" value="{{ old('pendapatan_ayah_perbulan') }}" placeholder="Masukkan Pendapatan Perbulan Ayah">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pendapatan_ibu_perbulan">Pendapatan Perbulan Ibu </label>
                                        <input type="number" class="form-control" id="pendapatan_ibu_perbulan"
                                            name="pendapatan_ibu_perbulan" value="{{ old('pendapatan_ibu_perbulan') }}" placeholder="Masukkan Pendapatan Perbulan Ibu">
                                    </div>
                                </div>
                            </div>
                            <h5 class="mt-2 mb-2">IDENTITAS WALI CALON SANTRI</h5>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="nama_wali">Nama Wali <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nama_wali" name="nama_wali" placeholder="Masukkan Nama Wali Santri" value="{{ old('nama_wali') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="no_identitas_wali">No. Identitas Wali (KTP/SIM) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="no_identitas_wali" name="no_identitas_wali" placeholder="Masukkan No Identitas Wali Santri" value="{{ old('no_identitas_wali') }}" required>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="tempat_lahir_wali">Tempat Lahir Wali <span
                                                        class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="tempat_lahir_wali"
                                                        name="tempat_lahir_wali" value="{{ old('tempat_lahir_wali') }}"
                                                        placeholder="contoh. Madiun" required>
                                                </div>                              
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="tanggal_lahir_wali">Tanggal Lahir Wali <span
                                                        class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="tanggal_lahir_wali"
                                                        name="tanggal_lahir_wali" value="{{ old('tanggal_lahir_wali') }}"
                                                        required>
                                                </div>                              
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label for="rt_wali">RT <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="rt_wali" name="rt_wali" placeholder="RT" value="{{ old('rt_wali') }}" required>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="rw_wali">RW <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="rw_wali" name="rw_wali" placeholder="RW" value="{{ old('rw_wali') }}" required>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="dusun_wali">Dusun <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="dusun_wali" name="dusun_wali" placeholder="Dusun" value="{{ old('dusun_wali') }}" required>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="desa_wali">Desa <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="desa_wali" name="desa_wali" placeholder="Desa" value="{{ old('desa_wali') }}" required>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="kecamatan_wali">Kecamatan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="kecamatan_wali" name="kecamatan_wali" placeholder="Kecamatan" value="{{ old('kecamatan_wali') }}" required>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="kab_kota_wali">Kabupaten/Kota <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="kab_kota_wali" name="kab_kota_wali" placeholder="Kabupaten/Kota" value="{{ old('kab_kota_wali') }}" required>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="provinsi_wali">Provinsi <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="provinsi_wali" name="provinsi_wali" placeholder="Provinsi" value="{{ old('provinsi_wali') }}" required>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="kode_pos_wali">Kode Pos <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="kode_pos_wali" name="kode_pos_wali" placeholder="Kode Pos" value="{{ old('kode_pos_wali') }}" required>
                                            </div>                                        
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="no_hp_wali_pendaftar">No Hp Wali <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="no_hp_wali" name="no_hp_wali" placeholder="Masukkan No Hp Wali Santri" value="{{ old('no_hp_wali') }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email_wali_pendaftar">Email Wali<span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email_wali" name="email_wali" placeholder="Masukkan Email Wali Santri" value="{{ old('email_wali') }}" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status_wali">Status Wali Sebagai <span class="text-danger">*</span></label>
                                            <select class="form-control" name="status_wali"
                                                id="status_wali" required>
                                                <option value="Ayah Kandung" @if (old('status_wali') == 'Ayah Kandung') selected @endif>Ayah Kandung</option>
                                                <option value="Ibu Kandung" @if (old('status_wali') == 'Ibu Kandung') selected @endif>Ibu Kandung</option>
                                                <option value="Paman" @if (old('status_wali') == 'Paman') selected @endif>Paman</option>
                                                <option value="Bibi" @if (old('status_wali') == 'Bibi') selected @endif>Bibi</option>
                                                <option value="Lainnya" @if (old('status_wali') == 'Lainnya') selected @endif>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <label for="pendidikan_wali">Pendidikan Wali </label>
                                                <input type="text" class="form-control" id="pendidikan_wali" name="pendidikan_wali" placeholder="Pendidikan" value="{{ old('pendidikan_wali') }}">
                                            </div>
                                            <div class="col-md-4 ">
                                                <label for="pekerjaan_wali">Pekerjaan Wali </label>
                                                <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" placeholder="Pekerjaan" value="{{ old('pekerjaan_wali') }}">
                                            </div>
                                            <div class="col-md-4 ">
                                                <label for="pendapatan_wali_perbulan">Pendapatan Perbulan Wali </label>
                                                <input type="number" class="form-control" id="pendapatan_wali_perbulan" name="pendapatan_wali_perbulan" placeholder="Pendapatan Perbulan" value="{{ old('pendapatan_wali_perbulan') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        @php
                                            function generatePassword($length = 8)
                                            {
                                                $chars =
                                                    'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                                                $password = '';
                                                for ($i = 0; $i < $length; $i++) {
                                                    $password .= $chars[rand(0, strlen($chars) - 1)];
                                                }
                                                return $password;
                                            }
                                        @endphp
                                        <label for="password_wali_santri">Password Wali Santri<span
                                                class="text-danger">*</span><span class="text-muted ml-2">(Token harap disimpan!)</span></label>
                                        <input type="text" class="form-control text-dark" id="password_wali_santri"
                                            name="password_wali_santri" value="{{ generatePassword() }}" required>
                                    </div>
                                </div>
                            </div>
                            <h5 class="mt-2 mb-2">BERKAS CALON SANTRI</h5>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="ktp_santri">KTP Santri<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control-file" id="ktp_santri"
                                            name="ktp_santri" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kk_santri">KK Santri<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control-file" id="kk_santri" name="kk_santri"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="akta_santri">Akta Kelahiran Santri<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control-file" id="akta_santri"
                                            name="akta_santri" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pas_foto_santri">Pas Foto Santri<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control-file" id="pas_foto_santri"
                                            name="pas_foto_santri" required>
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
