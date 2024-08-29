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
                <h5 class="mb-0">Informasi Calon pendaftar</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pendaftaran</li>
                        <li class="breadcrumb-item active" aria-current="page">Informasi Calon pendaftar</li>
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
    <div id="content-page" class="content-page">
        {{-- Data Pendaftar --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Verifikasi Data Pendaftar {{ $pendaftar->nama_pendaftar }}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <form id="verification-form" action="{{ url('/admin/pendaftaran/verifikasi/'. $pendaftar->id_pendaftar) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Step 1: Data Santri -->
                                <div id="step-1" class="step">
                                    <p class="text-danger"><span><i class="ri-information-line"></i></span> Verifikasi data
                                        calon santri dibawah dan ubah jika ada perbedaan dengan data asli!</p>
                                    <div class="form-group">
                                        <label for="nama_pendaftar">Nama Calon Santri <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_pendaftar" name="nama_pendaftar"
                                            value="{{ $pendaftar->nama_pendaftar }}" required>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="no_induk">No Induk <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="no_induk" name="no_induk"
                                                value="{{ old('no_induk') }}" placeholder="Masukkan No Induk" required>
                                        </div>
                                        <div class="col mb-3">
                                            <label for="status_pendaftar">Status Calon Santri <span class="text-danger">*</span></label>
                                            <select class="form-control" name="status_pendaftar"
                                                id="status_pendaftar" required>
                                                <option value="mukim" @if ( $pendaftar->status_pendaftar == 'mukim') selected @endif>Mukim (Tinggal)</option>
                                                <option value="tidak_mukim" @if ( $pendaftar->status_pendaftar == 'tidak_mukim') selected @endif>Tidak Mukim (Pulang)</option>
                                            </select>
                                        </div>
                                        <div class="col mb-3">
                                            <label for="tingkatan_pendaftar">Tingkatan <span class="text-danger">*</span></label>
                                            <select class="form-control" name="tingkatan_pendaftar"
                                                id="tingkatan_pendaftar" required>
                                                <option value="1" @if ( $pendaftar->tingkatan_pendaftar == '1') selected @endif>Kelas 1</option>
                                                <option value="2" @if ( $pendaftar->tingkatan_pendaftar == '2') selected @endif>Kelas 2</option>
                                                <option value="3" @if ( $pendaftar->tingkatan_pendaftar == '3') selected @endif>Kelas 3</option>
                                                <option value="4" @if ( $pendaftar->tingkatan_pendaftar == '4') selected @endif>Kelas 4</option>
                                                <option value="5" @if ( $pendaftar->tingkatan_pendaftar == '5') selected @endif>Kelas 5</option>
                                                <option value="6" @if ( $pendaftar->tingkatan_pendaftar == '6') selected @endif>Kelas 6</option>
                                                <option value="1_TSA" @if ( $pendaftar->tingkatan_pendaftar == '1_TSA') selected @endif>1 TSA</option>
                                                <option value="2_TSA" @if ( $pendaftar->tingkatan_pendaftar == '2_TSA') selected @endif>2 TSA</option>
                                                <option value="3_TSA" @if ( $pendaftar->tingkatan_pendaftar == '3_TSA') selected @endif>3 TSA</option>
                                                <option value="pengurus" @if ( $pendaftar->tingkatan_pendaftar == 'pengurus') selected @endif>Pengurus</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_identitas">No Identitas Calon Santri (KTP/SIM)</label>
                                        <input type="text" class="form-control" id="no_identitas"
                                            name="no_identitas" placeholder="Masukkan No Identitas" value="{{ $pendaftar->no_identitas }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="tempat_lahir_pendaftar">Tempat
                                                Lahir Calon Santri <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="tempat_lahir_pendaftar"
                                                name="tempat_lahir_pendaftar"
                                                placeholder="contoh. Surabaya" value="{{ $pendaftar->tempat_lahir_pendaftar }}" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="tanggal_lahir_pendaftar">Tanggal
                                                Lahir Calon Santri <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="tanggal_lahir_pendaftar"
                                                name="tanggal_lahir_pendaftar" value="{{ $pendaftar->tanggal_lahir_pendaftar }}" required>
                                        </div>
                                        <div class="col form-group">
                                            <label for="jenis_kelamin_pendaftar">Jenis Kelamin Calon Santri <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="jenis_kelamin_pendaftar"
                                                id="jenis_kelamin_pendaftar" required>
                                                <option value="laki-laki" @if ($pendaftar->jenis_kelamin_pendaftar == 'laki-laki') selected @endif>
                                                    Laki Laki</option>
                                                <option value="perempuan" @if ($pendaftar->jenis_kelamin_pendaftar == 'perempuan') selected @endif>
                                                    Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="rt">RT <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="rt"
                                                name="rt" placeholder="RT" value="{{ $pendaftar->rt }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="rw">RW <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="rw"
                                                name="rw" placeholder="RW" value="{{ $pendaftar->rw }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="dusun">Dusun <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="dusun"
                                                name="dusun" placeholder="Dusun" value="{{ $pendaftar->dusun }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="desa">Desa <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="desa"
                                                name="desa" placeholder="Desa" value="{{ $pendaftar->desa }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="kecamatan">Kecamatan <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="kecamatan"
                                                name="kecamatan" placeholder="Kecamatan" value="{{ $pendaftar->kecamatan }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="kab_kota">Kabupaten/Kota <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="kab_kota"
                                                name="kab_kota" placeholder="Kabupaten/Kota" value="{{ $pendaftar->kab_kota }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="provinsi">Provinsi <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="provinsi"
                                                name="provinsi" placeholder="Provinsi" value="{{ $pendaftar->provinsi }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="kode_pos">Kode Pos <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="kode_pos"
                                                name="kode_pos" placeholder="Kode Pos" value="{{ $pendaftar->kode_pos }}" required>
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-3">
                                                <label for="no_hp_pendaftar">No Hp Calon Santri </label>
                                                <input type="number" class="form-control" id="no_hp_pendaftar"
                                                    name="no_hp_pendaftar" value="{{ $pendaftar->no_hp_pendaftar }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group mb-3">
                                                <label for="email_pendaftar">Email Calon Santri <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email_pendaftar"
                                                    name="email_pendaftar" value="{{ $pendaftar->email_pendaftar }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mulai_masuk_tanggal">Mulai Masuk Tanggal <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="mulai_masuk_tanggal"
                                            name="mulai_masuk_tanggal" placeholder="Mulai Masuk Tanggal" value="{{ $pendaftar->mulai_masuk_tanggal }}" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="jumlah_saudara_kandung">Jumlah Saudara Kandung </label>
                                            <input type="number" class="form-control" id="jumlah_saudara_kandung"
                                                name="jumlah_saudara_kandung" placeholder="Jumlah Saudara Kandung" value="{{ $pendaftar->jumlah_saudara_kandung }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="anak_ke">Anak ke </label>
                                            <input type="number" class="form-control" id="anak_ke"
                                                name="anak_ke" placeholder="Anak ke" value="{{ $pendaftar->anak_ke }}">
                                        </div>
                                    </div> 
                                    <hr>
                                    <div class="mt-3">
                                        <button type="button" id="next-button-1"
                                            class="btn btn-primary">Selanjutnya</button>
                                        <a type="button" href="{{ route('pendaftaran') }}"
                                            class="btn iq-bg-secondary">Kembali</a>
                                    </div>
                                </div>

                                <!-- Step 2: Data Orang Tua -->
                                <div id="step-2" class="step d-none">
                                    <p class="text-danger"><span><i class="ri-information-line"></i></span> Verifikasi
                                        data orang tua dari calon santri dibawah dan ubah jika ada perbedaan dengan data asli!
                                    </p>
                                    <div class="form-group">
                                        <label for="nama_ayah_pendaftar">Nama Ayah <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_ayah_pendaftar"
                                            name="nama_ayah_pendaftar" placeholder="Masukkan Nama Ayah" value="{{ $pendaftar->nama_ayah_pendaftar }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_ibu_pendaftar">Nama Ibu <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_ibu_pendaftar"
                                            name="nama_ibu_pendaftar" placeholder="Masukkan Nama Ibu" value="{{ $pendaftar->nama_ibu_pendaftar }}" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="pendidikan_ayah">Pendidikan Ayah</label>
                                            <input type="text" class="form-control" id="pendidikan_ayah"
                                                name="pendidikan_ayah" placeholder="Masukkan Pendidikan Ayah" value="{{ $pendaftar->pendidikan_ayah }}" >
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="pendidikan_ibu">Pendidikan Ibu</label>
                                            <input type="text" class="form-control" id="pendidikan_ibu"
                                                name="pendidikan_ibu" placeholder="Masukkan Pendidikan Ibu" value="{{ $pendaftar->pendidikan_ibu }}" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                            <input type="text" class="form-control" id="pekerjaan_ayah"
                                                name="pekerjaan_ayah" placeholder="Masukkan Pekerjaan Ayah" value="{{ $pendaftar->pekerjaan_ayah }}" >
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                            <input type="text" class="form-control" id="pekerjaan_ibu"
                                                name="pekerjaan_ibu" placeholder="Masukkan Pekerjaan Ibu" value="{{ $pendaftar->pekerjaan_ibu }}" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="pendapatan_ayah_perbulan">Pendapatan Perbulan Ayah</label>
                                            <input type="number" class="form-control" id="pendapatan_ayah_perbulan"
                                                name="pendapatan_ayah_perbulan" placeholder="Masukkan Pendapatan Perbulan Ayah" value="{{ $pendaftar->pendapatan_ayah_perbulan }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="pendapatan_ibu_perbulan">Pendapatan Perbulan Ibu</label>
                                            <input type="number" class="form-control" id="pendapatan_ibu_perbulan"
                                                name="pendapatan_ibu_perbulan" placeholder="Masukkan Pendapatan Perbulan Ibu" value="{{ $pendaftar->pendapatan_ibu_perbulan }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mt-3">
                                        <button type="button" id="next-button-2"
                                            class="btn btn-primary">Selanjutnya</button>
                                        <button type="button" id="back-button-1"
                                            class="btn iq-bg-secondary">Kembali</button>
                                    </div>
                                </div>

                                <!-- Step 3: Data Wali -->
                                <div id="step-3" class="step d-none">
                                    <p class="text-danger"><span><i class="ri-information-line"></i></span> Verifikasi
                                        data wali dari calon santri dibawah dan ubah jika ada perbedaan dengan data asli!
                                    </p>
                                    <div class="form-group">
                                        <label for="nama_wali_pendaftar">Nama Wali <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_wali_pendaftar"
                                            name="nama_wali_pendaftar"
                                            value="{{ $pendaftar->nama_wali_pendaftar }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_identitas_wali">No. Identitas Wali (KTP/SIM) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="no_identitas_wali" name="no_identitas_wali" value="{{ $pendaftar->no_identitas_wali }}" placeholder="Masukkan No Identitas" required>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <label for="tempat_lahir_wali">Tempat Lahir Wali <span
                                                    class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="tempat_lahir_wali"
                                                    name="tempat_lahir_wali" value="{{ $pendaftar->tempat_lahir_wali }}"
                                                    placeholder="contoh. Madiun" required>
                                            </div>                              
                                        </div>
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <label for="tanggal_lahir_wali">Tanggal Lahir Wali <span
                                                    class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="tanggal_lahir_wali"
                                                    name="tanggal_lahir_wali" value="{{ $pendaftar->tanggal_lahir_wali }}"
                                                    required>
                                            </div>                              
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="rt_wali">RT <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="rt_wali" name="rt_wali" placeholder="RT" value="{{ $pendaftar->rt_wali }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="rw_wali">RW <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="rw_wali" name="rw_wali" placeholder="RW" value="{{ $pendaftar->rw_wali }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="dusun_wali">Dusun <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="dusun_wali" name="dusun_wali" placeholder="Dusun" value="{{ $pendaftar->dusun_wali }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="desa_wali">Desa <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="desa_wali" name="desa_wali" placeholder="Desa" value="{{ $pendaftar->desa_wali }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="kecamatan_wali">Kecamatan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="kecamatan_wali" name="kecamatan_wali" placeholder="Kecamatan" value="{{ $pendaftar->kecamatan_wali }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="kab_kota_wali">Kabupaten/Kota <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="kab_kota_wali" name="kab_kota_wali" placeholder="Kabupaten/Kota" value="{{ $pendaftar->kab_kota_wali }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="provinsi_wali">Provinsi <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="provinsi_wali" name="provinsi_wali" placeholder="Provinsi" value="{{ $pendaftar->provinsi_wali }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="kode_pos_wali">Kode Pos <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="kode_pos_wali" name="kode_pos_wali" placeholder="Kode Pos" value="{{ $pendaftar->kode_pos_wali }}" required>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="no_hp_wali_pendaftar">No Hp Wali <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="no_hp_wali_pendaftar"
                                                    name="no_hp_wali_pendaftar"
                                                    value="{{ $pendaftar->no_hp_wali_pendaftar }}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="email_wali_pendaftar">Email Wali <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email_wali_pendaftar"
                                                    name="email_wali_pendaftar"
                                                    value="{{ $pendaftar->email_wali_pendaftar }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status_wali">Status Wali Sebagai <span class="text-danger">*</span></label>
                                        <select class="form-control" name="status_wali"
                                            id="status_wali" required>
                                            <option value="Ayah Kandung" @if ($pendaftar->status_wali == 'Ayah Kandung') selected @endif>Ayah Kandung</option>
                                            <option value="Ibu Kandung" @if ($pendaftar->status_wali == 'Ibu Kandung') selected @endif>Ibu Kandung</option>
                                            <option value="Paman" @if ($pendaftar->status_wali == 'Paman') selected @endif>Paman</option>
                                            <option value="Bibi" @if ($pendaftar->status_wali == 'Bibi') selected @endif>Bibi</option>
                                            <option value="Lainnya" @if ($pendaftar->status_wali == 'Lainnya') selected @endif>Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="pendidikan_wali">Pendidikan Wali</label>
                                            <input type="text" class="form-control" id="pendidikan_wali" name="pendidikan_wali" value="{{ $pendaftar->pendidikan_wali }}" placeholder="Pendidikan">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="pekerjaan_wali">Pekerjaan Wali</label>
                                            <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" value="{{ $pendaftar->pekerjaan_wali }}" placeholder="Pekerjaan" >
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pendapatan_wali_perbulan">Pendapatan Perbulan Wali</label>
                                        <input type="number" class="form-control" id="pendapatan_wali_perbulan" name="pendapatan_wali_perbulan" value="{{ $pendaftar->pendapatan_wali_perbulan }}" placeholder="Pendapatan Perbulan" >
                                    </div>
                                    <hr>
                                    <div class="mt-3">
                                        <button type="button" id="next-button-3"
                                            class="btn btn-primary">Selanjutnya</button>
                                        <button type="button" id="back-button-2"
                                            class="btn iq-bg-secondary">Kembali</button>
                                    </div>
                                </div>

                                <!-- Step 4: Berkas -->
                                <div id="step-4" class="step d-none">
                                    <p class="text-danger"><span><i class="ri-information-line"></i></span> Verifikasi
                                        berkas calon santri dibawah dan ubah jika ada perbedaan dengan data asli!</p>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="ktp_pendaftar">KTP pendaftar <span
                                                        class="text-danger">*</span></label>
                                                <input type="file" class="form-control-file mb-3" id="ktp_pendaftar"
                                                    name="ktp_pendaftar">
                                                @if ($pendaftar->ktp_pendaftar !== null)
                                                    <img src="{{ asset('berkas_pendaftar/ktp_pendaftar/' . $pendaftar->ktp_pendaftar) }}"
                                                        alt="KTP pendaftar"
                                                        style="max-width: 460px; border-radius: 20px;">
                                                @else
                                                    <div class="bg-light" style="width: 460px; border-radius:20px;">
                                                        <p class="text-center text-secondary"
                                                            style="padding-top: 100px; padding-bottom:100px;">Gambar tidak
                                                            ada.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="kk_pendaftar">KK pendaftar <span
                                                        class="text-danger">*</span></label>
                                                <input type="file" class="form-control-file mb-3" id="kk_pendaftar"
                                                    name="kk_pendaftar">
                                                @if ($pendaftar->kk_pendaftar !== null)
                                                    <img src="{{ asset('berkas_pendaftar/kk_pendaftar/' . $pendaftar->kk_pendaftar) }}"
                                                        alt="KK pendaftar" style="max-width: 460px; border-radius: 20px;">
                                                @else
                                                    <div class="bg-light" style="width: 460px; border-radius:20px;">
                                                        <p class="text-center text-secondary"
                                                            style="padding-top: 100px; padding-bottom:100px;">Gambar tidak
                                                            ada.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="akta_pendaftar">Akta pendaftar <span
                                                        class="text-danger">*</span></label>
                                                <input type="file" class="form-control-file mb-3" id="akta_pendaftar"
                                                    name="akta_pendaftar">
                                                @if ($pendaftar->akta_pendaftar !== null)
                                                    <img src="{{ asset('berkas_pendaftar/akta_pendaftar/' . $pendaftar->akta_pendaftar) }}"
                                                        alt="Akta pendaftar"
                                                        style="max-width: 460px; border-radius: 20px;">
                                                @else
                                                    <div class="bg-light" style="width: 460px; border-radius:20px;">
                                                        <p class="text-center text-secondary"
                                                            style="padding-top: 100px; padding-bottom:100px;">Gambar tidak
                                                            ada.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="pas_foto_pendaftar">Pas Foto pendaftar <span
                                                        class="text-danger">*</span></label>
                                                <input type="file" class="form-control-file mb-3"
                                                    id="pas_foto_pendaftar" name="pas_foto_pendaftar">
                                                @if ($pendaftar->pas_foto_pendaftar !== null)
                                                    <img src="{{ asset('berkas_pendaftar/pas_foto_pendaftar/' . $pendaftar->pas_foto_pendaftar) }}"
                                                        alt="Pas Foto pendaftar"
                                                        style="max-width: 460px; border-radius: 20px;">
                                                @else
                                                    <div class="bg-light" style="width: 460px; border-radius:20px;">
                                                        <p class="text-center text-secondary"
                                                            style="padding-top: 100px; padding-bottom:100px;">Gambar tidak
                                                            ada.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mt-3">
                                        <button type="button" id="next-button-4"
                                            class="btn btn-primary">Selanjutnya</button>
                                        <button type="button" id="back-button-3"
                                            class="btn iq-bg-secondary">Kembali</button>
                                    </div>
                                </div>

                                <!-- Step 5: Verifikasi -->
                                <div id="step-5" class="step d-none">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="verify-checkbox">
                                        <label class="form-check-label" for="verify-checkbox">Saya yakin bahwa data yang saya masukkan di atas sudah diverifikasi dan benar. Saya
                                            ingin menerima calon santri ini sebagai santri.</label>
                                    </div>
                                    <hr>
                                    <div class="mt-3">
                                        <button type="submit" id="submit-button" class="btn btn-primary"
                                            disabled>Submit</button>
                                        <button type="button" id="back-button-4"
                                            class="btn iq-bg-secondary">Kembali</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nextButton1 = document.getElementById('next-button-1');
            const nextButton2 = document.getElementById('next-button-2');
            const nextButton3 = document.getElementById('next-button-3');
            const nextButton4 = document.getElementById('next-button-4');
            const backButton1 = document.getElementById('back-button-1');
            const backButton2 = document.getElementById('back-button-2');
            const backButton3 = document.getElementById('back-button-3');
            const backButton4 = document.getElementById('back-button-4');
            const verifyCheckbox = document.getElementById('verify-checkbox');
            const submitButton = document.getElementById('submit-button');

            const step1 = document.getElementById('step-1');
            const step2 = document.getElementById('step-2');
            const step3 = document.getElementById('step-3');
            const step4 = document.getElementById('step-4');
            const step5 = document.getElementById('step-5');

            nextButton1.addEventListener('click', function() {
                step1.classList.add('d-none');
                step2.classList.remove('d-none');
            });

            nextButton2.addEventListener('click', function() {
                step2.classList.add('d-none');
                step3.classList.remove('d-none');
            });

            nextButton3.addEventListener('click', function() {
                step3.classList.add('d-none');
                step4.classList.remove('d-none');
            });

            nextButton4.addEventListener('click', function() {
                step4.classList.add('d-none');
                step5.classList.remove('d-none');
            });

            backButton1.addEventListener('click', function() {
                step2.classList.add('d-none');
                step1.classList.remove('d-none');
            });

            backButton2.addEventListener('click', function() {
                step3.classList.add('d-none');
                step2.classList.remove('d-none');
            });

            backButton3.addEventListener('click', function() {
                step4.classList.add('d-none');
                step3.classList.remove('d-none');
            });

            backButton4.addEventListener('click', function() {
                step5.classList.add('d-none');
                step4.classList.remove('d-none');
            });

            verifyCheckbox.addEventListener('change', function() {
                submitButton.disabled = !this.checked;
            });
        });
    </script>
@endsection
