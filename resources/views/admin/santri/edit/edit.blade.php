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
                        <h4 class="card-title">Edit Data Santri</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <p>Lengkapi form dibawah dengan benar untuk mengedit data santri.</p>
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
                                <label for="no_identitas">No Identitas (KTP/SIM) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="no_identitas" name="no_identitas"
                                    value="{{ $santri->no_identitas }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tempat_tanggal_lahir_santri">Tempat, Tanggal Lahir <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="tempat_tanggal_lahir_santri"
                                    name="tempat_tanggal_lahir_santri" value="{{ $santri->tempat_tanggal_lahir_santri }}"
                                    required>
                            </div>
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
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="rt">RT <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="rt"
                                        name="rt" placeholder="RT" value="{{ $santri->rt }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="rw">RW <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="rw"
                                        name="rw" placeholder="RW" value="{{ $santri->rw }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="dusun">Dusun <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="dusun"
                                        name="dusun" placeholder="Dusun" value="{{ $santri->dusun }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="desa">Desa <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="desa"
                                        name="desa" placeholder="Desa" value="{{ $santri->desa }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="kecamatan">Kecamatan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kecamatan"
                                        name="kecamatan" placeholder="Kecamatan" value="{{ $santri->kecamatan }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="kab_kota">Kabupaten/Kota <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kab_kota"
                                        name="kab_kota" placeholder="Kabupaten/Kota" value="{{ $santri->kab_kota }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="provinsi">Provinsi <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="provinsi"
                                        name="provinsi" placeholder="Provinsi" value="{{ $santri->provinsi }}">
                                </div>
                                <div class="col-md-3 mb-3"">
                                    <label for="kode_pos">Kode Pos <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kode_pos"
                                        name="kode_pos" placeholder="Kode Pos" value="{{ $santri->kode_pos }}">
                                </div>
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
                                <div class="col-md-6 mb-3">
                                    <label for="jumlah_saudara_kandung">Jumlah Saudara Kandung <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="jumlah_saudara_kandung"
                                        name="jumlah_saudara_kandung" placeholder="Jumlah Saudara Kandung" value="{{ $santri->jumlah_saudara_kandung }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="anak_ke">Anak ke <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="anak_ke"
                                        name="anak_ke" placeholder="Anak ke" value="{{ $santri->anak_ke }}">
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="nama_ayah">Nama Ayah <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                    value="{{ $santri->nama_ayah }}" placeholder="Masukkan Nama Ayah" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_ibu">Nama Ibu <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                    value="{{ $santri->nama_ibu }}" placeholder="Masukkan Nama Ibu" required>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pendidikan_ayah">Pendidikan Ayah<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="pendidikan_ayah"
                                            name="pendidikan_ayah" value="{{ $santri->pendidikan_ayah }}" placeholder="Masukkan Pendidikan Ayah" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pendidikan_ibu">Pendidikan Ibu<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="pendidikan_ibu"
                                            name="pendidikan_ibu" value="{{ $santri->pendidikan_ibu }}" placeholder="Masukkan Pendidikan Ibu" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pekerjaan_ayah">Pekerjaan Ayah<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="pekerjaan_ayah"
                                            name="pekerjaan_ayah" value="{{ $santri->pekerjaan_ayah }}" placeholder="Masukkan Pekerjaan Ayah" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pekerjaan_ibu">Pekerjaan Ibu<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="pekerjaan_ibu"
                                            name="pekerjaan_ibu" value="{{ $santri->pekerjaan_ibu }}" placeholder="Masukkan Pekerjaan Ibu" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pendapatan_ayah_perbulan">Pendapatan Perbulan Ayah<span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="pendapatan_ayah_perbulan"
                                            name="pendapatan_ayah_perbulan" value="{{ $santri->pendapatan_ayah_perbulan }}" placeholder="Masukkan Pendapatan Perbulan Ayah" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pendapatan_ibu_perbulan">Pendapatan Perbulan Ibu<span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="pendapatan_ibu_perbulan"
                                            name="pendapatan_ibu_perbulan" value="{{ $santri->pendapatan_ibu_perbulan }}" placeholder="Masukkan Pendapatan Perbulan Ibu" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="nama_wali">Nama Wali Santri <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nama_wali" name="nama_wali" placeholder="Masukkan Nama Wali Santri" value="{{ $wali->nama_wali }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="no_identitas_wali">No. Identitas Wali Santri (KTP/SIM) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="no_identitas_wali" name="no_identitas_wali" placeholder="Masukkan No Identitas Wali Santri" value="{{ $wali->no_identitas_wali }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tempat_tanggal_lahir_wali">Tempat & Tanggal Lahir Wali Santri <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="tempat_tanggal_lahir_wali" name="tempat_tanggal_lahir_wali" placeholder="contoh. Madiun, 20 Oktober 2001" value="{{ $wali->tempat_tanggal_lahir_wali }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label for="rt_wali">RT <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="rt_wali" name="rt_wali" placeholder="RT" value="{{ $wali->rt_wali }}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="rw_wali">RW <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="rw_wali" name="rw_wali" placeholder="RW" value="{{ $wali->rw_wali }}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="dusun_wali">Dusun <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="dusun_wali" name="dusun_wali" placeholder="Dusun" value="{{ $wali->dusun_wali }}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="desa_wali">Desa <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="desa_wali" name="desa_wali" placeholder="Desa" value="{{ $wali->desa_wali }}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="kecamatan_wali">Kecamatan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="kecamatan_wali" name="kecamatan_wali" placeholder="Kecamatan" value="{{ $wali->kecamatan_wali }}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="kab_kota_wali">Kabupaten/Kota <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="kab_kota_wali" name="kab_kota_wali" placeholder="Kabupaten/Kota" value="{{ $wali->kab_kota_wali }}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="provinsi_wali">Provinsi <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="provinsi_wali" name="provinsi_wali" placeholder="Provinsi" value="{{ $wali->provinsi_wali }}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="kode_pos_wali">Kode Pos <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="kode_pos_wali" name="kode_pos_wali" placeholder="Kode Pos" value="{{ $wali->kode_pos_wali }}">
                                            </div>                                        
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="no_hp_wali">No Hp Wali Santri <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="no_hp_wali" name="no_hp_wali" placeholder="Masukkan No Hp Wali Santri" value="{{ $wali->no_hp }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email_wali">Email Wali Santri<span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email_wali" name="email_wali" placeholder="Masukkan Email Wali Santri" value="{{ $wali->email }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status_wali">Status Wali Sebagai <span class="text-danger">*</span></label>
                                            <select class="form-control" name="status_wali"
                                                id="status_wali" required>
                                                <option value="Ayah Kandung" @if ($wali->status_wali == 'Ayah Kandung') selected @endif>Ayah Kandung</option>
                                                <option value="Ibu Kandung" @if ($wali->status_wali == 'Ibu Kandung') selected @endif>Ibu Kandung</option>
                                                <option value="Paman" @if ($wali->status_wali == 'Paman') selected @endif>Paman</option>
                                                <option value="Bibi" @if ($wali->status_wali == 'Bibi') selected @endif>Bibi</option>
                                                <option value="Lainnya" @if ($wali->status_wali == 'Lainnya') selected @endif>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="pendidikan_wali">Pendidikan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="pendidikan_wali" name="pendidikan_wali" placeholder="Pendidikan" value="{{ $wali->pendidikan_wali }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="pekerjaan_wali">Pekerjaan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" placeholder="Pekerjaan" value="{{ $wali->pekerjaan_wali }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pendapatan_wali_perbulan">Pendapatan Perbulan <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="pendapatan_wali_perbulan" name="pendapatan_wali_perbulan" placeholder="Pendapatan Perbulan" value="{{ $wali->pendapatan_wali_perbulan }}">
                                        </div>
                                    </div>
                                </div>
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
