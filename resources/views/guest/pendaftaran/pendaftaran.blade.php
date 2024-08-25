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
    <style>
        .form-control {
            border: none;
            background-color: #e9edf4;
            padding: 10px;
        }

        .form-control:focus {
            border: none;
            background-color: #e5f2ff;
        }

        .form-label {
            font-weight: bold;
        }

        /* CSS untuk merapikan input file */
        .custom-file-input {
            display: inline-block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: transparent;
            /* Ubah background color menjadi transparan */
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            box-sizing: border-box;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .custom-file-input:focus {
            border-color: #80bdff;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .custom-file-input::file-selector-button {
            padding: 0.375rem 0.75rem;
            margin-right: 1rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            background-color: #e9edf4;
            /* Ganti warna background sesuai keinginan */
            color: #495057;
            /* Warna teks putih */
            cursor: pointer;
            box-sizing: border-box;
        }

        .custom-file-input::file-selector-button:hover {
            background-color: #0056b3;
            /* Ganti warna hover sesuai keinginan */
        }

        .form-control-file {
            display: flex;
            align-items: center;
        }

        .form-control-file input[type="file"] {
            flex: 1;
        }
    </style>
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
                        <!-- Step 1: Persyaratan -->
                        <div class="card p-4 form-step" id="step-1"
                            style="display:none; background-color: #f5f5f5; border:none;">
                            <div class="card-body row">
                                <div class="col-lg-6">
                                    <h3 class="fw-bold p-navy mt-2">Persyaratan Pendaftaran</h3>
                                    <p class="mb-0">Berikut adalah beberapa informasi yang akan dimasukkan saat proses
                                        pendaftaran :</p>
                                    <ol>
                                        <li>Nama lengkap calon santri.</li>
                                        <li>No Identitas .</li>
                                        <li>Tempat dan Tanggal Lahir Calon Santri.</li>
                                        <li>Jenis Kelamin Calon Santri.</li>
                                        <li>Alamat Lengkap Calon Santri.</li>
                                        <li>Nomor HP Santri yang aktif.</li>
                                        <li>Email Santri yang aktif.</li>
                                        <li>Identitas Lengkap Orangtua Calon Santri.</li>
                                        <li>Identitas Lengkap Wali Calon Santri.</li>
                                    </ol>
                                    <p class="fw-bold">Pastikan semua informasi yang diberikan adalah benar dan sesuai
                                        dengan dokumen asli.</p>
                                    <button type="button" class="btn btn-primary" onclick="nextStep(2)">Mulai
                                        Pendaftaran</button>
                                </div>
                                <div class="col-lg-6">
                                    <div class="text-center align-items-center">
                                        <img src="{{ asset('images/pondok/asset3.png') }}" alt="" class="img-fluid"
                                            style="height: 65vh;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ url('/pendaftaran-santri-baru') }}" method="POST" enctype="multipart/form-data"
                            id="multiStepForm">
                            @csrf
                            <!-- Step 2: Data Calon Santri -->
                            <div class="form-step p-4" id="step-2" style="display:none;">
                                <p class="text-primary" style="display: flex; align-items: center;">
                                    <i class="bi bi-info-circle" style="margin-right: 5px;"></i>
                                    Lengkapi identitas calon santri dengan benar !
                                </p>
                                <div class="mb-3">
                                    <label for="nama_pendaftar">Nama Calon Santri<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_pendaftar" name="nama_pendaftar"
                                        placeholder="Masukkan Nama" value="{{ old('nama_pendaftar') }}" required>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="no_identitas">No Identitas Calon Santri (KTP/SIM) </label>
                                        <input type="text" class="form-control" id="no_identitas"
                                            name="no_identitas" placeholder="Masukkan No Identitas" value="{{ old('no_identitas') }}">
                                    </div>
                                    <div class="col mb-3">
                                        <label for="status_pendaftar">Status Calon Santri <span class="text-danger">*</span></label>
                                        <select class="form-control" name="status_pendaftar"
                                            id="status_pendaftar" required>
                                            <option value="mukim" @if (old('status_pendaftar') == 'mukim') selected @endif>Mukim (Tinggal)</option>
                                            <option value="tidak_mukim" @if (old('status_pendaftar') == 'tidak_mukim') selected @endif>Tidak Mukim (Pulang)</option>
                                        </select>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="tingkatan_pendaftar">Tingkatan <span class="text-danger">*</span></label>
                                        <select class="form-control" name="tingkatan_pendaftar"
                                            id="tingkatan_pendaftar" required>
                                            <option value="1" @if (old('tingkatan_pendaftar') == '1') selected @endif>Kelas 1</option>
                                            <option value="2" @if (old('tingkatan_pendaftar') == '2') selected @endif>Kelas 2</option>
                                            <option value="3" @if (old('tingkatan_pendaftar') == '3') selected @endif>Kelas 3</option>
                                            <option value="4" @if (old('tingkatan_pendaftar') == '4') selected @endif>Kelas 4</option>
                                            <option value="5" @if (old('tingkatan_pendaftar') == '5') selected @endif>Kelas 5</option>
                                            <option value="6" @if (old('tingkatan_pendaftar') == '6') selected @endif>Kelas 6</option>
                                            <option value="1_TSA" @if (old('tingkatan_pendaftar') == '1_TSA') selected @endif>1 TSA</option>
                                            <option value="2_TSA" @if (old('tingkatan_pendaftar') == '2_TSA') selected @endif>2 TSA</option>
                                            <option value="3_TSA" @if (old('tingkatan_pendaftar') == '3_TSA') selected @endif>3 TSA</option>
                                            <option value="pengurus" @if (old('tingkatan_pendaftar') == 'pengurus') selected @endif>Pengurus</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="tempat_lahir_pendaftar">Tempat
                                            Lahir Calon Santri<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="tempat_lahir_pendaftar"
                                            name="tempat_lahir_pendaftar"
                                            placeholder="contoh. Surabaya" value="{{ old('tempat_lahir_pendaftar') }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="tanggal_lahir_pendaftar">Tanggal
                                            Lahir Calon Santri<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggal_lahir_pendaftar"
                                            name="tanggal_lahir_pendaftar" value="{{ old('tanggal_lahir_pendaftar') }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="jenis_kelamin_pendaftar">Jenis Kelamin Calon Santri<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="jenis_kelamin_pendaftar"
                                            id="jenis_kelamin_pendaftar" required>
                                            <option value="laki-laki" @if (old('jenis_kelamin_pendaftar') == 'laki-laki') selected @endif>Laki Laki</option>
                                            <option value="perempuan" @if (old('jenis_kelamin_pendaftar') == 'perempuan') selected @endif>Perempuan</option>
                                        </select>
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
                                    <div class="col-md-3 mb-3">
                                        <label for="kode_pos">Kode Pos <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="kode_pos"
                                            name="kode_pos" placeholder="Kode Pos" value="{{ old('kode_pos') }}" required>
                                    </div>
                                </div>                                                                          
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="no_hp_pendaftar">No Hp Calon Santri</label>
                                        <input type="number" class="form-control" id="no_hp_pendaftar"
                                            name="no_hp_pendaftar" placeholder="Masukkan No Hp" value="{{ old('no_hp_pendaftar') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email_pendaftar">Email Calon Santri<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email_pendaftar"
                                            name="email_pendaftar" placeholder="Masukkan Email" value="{{ old('email_pendaftar') }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="mulai_masuk_tanggal">Mulai Masuk Tanggal <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="mulai_masuk_tanggal"
                                            name="mulai_masuk_tanggal" placeholder="Mulai Masuk Tanggal" value="{{ old('mulai_masuk_tanggal') }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_saudara_kandung">Jumlah Saudara Kandung </label>
                                        <input type="number" class="form-control" id="jumlah_saudara_kandung"
                                            name="jumlah_saudara_kandung" placeholder="Jumlah Saudara Kandung" value="{{ old('jumlah_saudara_kandung') }}" >
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="anak_ke">Anak ke </label>
                                        <input type="number" class="form-control" id="anak_ke"
                                            name="anak_ke" placeholder="Anak ke" value="{{ old('anak_ke') }}">
                                    </div>
                                </div>                                    
                                <hr>
                                <div class="">
                                    <button type="button" class="btn btn-secondary"
                                        onclick="prevStep(1)">Kembali</button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="nextStep(3)">Selanjutnya</button>
                                </div>
                            </div>

                                <!-- Step 3: Data Orang Tua -->
                                <div class="form-step p-4" id="step-3" style="display:none;">
                                    <p class="text-primary" style="display: flex; align-items: center;">
                                        <i class="bi bi-info-circle" style="margin-right: 5px;"></i>
                                        Lengkapi data orang tua calon santri dibawah dengan benar!
                                    </p>
                                    <div class="mb-3">
                                        <label for="nama_ayah_pendaftar">Nama Ayah <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_ayah_pendaftar"
                                            name="nama_ayah_pendaftar" placeholder="Masukkan Nama Ayah" value="{{ old('nama_ayah_pendaftar') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_ibu_pendaftar">Nama Ibu <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_ibu_pendaftar"
                                            name="nama_ibu_pendaftar" placeholder="Masukkan Nama Ibu" value="{{ old('nama_ibu_pendaftar') }}" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="pendidikan_ayah">Pendidikan Ayah</label>
                                            <input type="text" class="form-control" id="pendidikan_ayah"
                                                name="pendidikan_ayah" placeholder="Masukkan Pendidikan Ayah" value="{{ old('pendidikan_ayah') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="pendidikan_ibu">Pendidikan Ibu </label>
                                            <input type="text" class="form-control" id="pendidikan_ibu"
                                                name="pendidikan_ibu" placeholder="Masukkan Pendidikan Ibu" value="{{ old('pendidikan_ibu') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="pekerjaan_ayah">Pekerjaan Ayah </label>
                                            <input type="text" class="form-control" id="pekerjaan_ayah"
                                                name="pekerjaan_ayah" placeholder="Masukkan Pekerjaan Ayah" value="{{ old('pekerjaan_ayah') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="pekerjaan_ibu">Pekerjaan Ibu </label>
                                            <input type="text" class="form-control" id="pekerjaan_ibu"
                                                name="pekerjaan_ibu" placeholder="Masukkan Pekerjaan Ibu" value="{{ old('pekerjaan_ibu') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="pendapatan_ayah_perbulan">Pendapatan Perbulan Ayah </label>
                                            <input type="number" class="form-control" id="pendapatan_ayah_perbulan"
                                                name="pendapatan_ayah_perbulan" placeholder="Masukkan Pendapatan Perbulan Ayah" value="{{ old('pendapatan_ayah_perbulan') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="pendapatan_ibu_perbulan">Pendapatan Perbulan Ibu </label>
                                            <input type="number" class="form-control" id="pendapatan_ibu_perbulan"
                                                name="pendapatan_ibu_perbulan" placeholder="Masukkan Pendapatan Perbulan Ibu" value="{{ old('pendapatan_ibu_perbulan') }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="button" class="btn btn-secondary"
                                        onclick="prevStep(2)">Kembali</button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="nextStep(4)">Selanjutnya</button>
                                </div>

                                <!-- Step 4: Data Wali -->
                                <div class="form-step p-4" id="step-4" style="display:none;">
                                    <p class="text-primary" style="display: flex; align-items: center;">
                                        <i class="bi bi-info-circle" style="margin-right: 5px;"></i>
                                        Lengkapi data wali calon santri dibawah dengan benar!
                                    </p>
                                    <div class="mb-3">
                                        <label for="nama_wali_pendaftar">Nama Lengkap Wali<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_wali_pendaftar" name="nama_wali_pendaftar" placeholder="Masukkan Nama Lengkap Wali" value="{{ old('nama_wali_pendaftar') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_identitas_wali">No. Identitas Wali (KTP/SIM) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="no_identitas_wali" name="no_identitas_wali" placeholder="Masukkan No Identitas" value="{{ old('no_identitas_wali') }}" required>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <label for="tempat_lahir_wali">Tempat Lahir Wali <span
                                                    class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="tempat_lahir_wali"
                                                    name="tempat_lahir_wali" value="{{ old('tempat_lahir_wali') }}"
                                                    placeholder="contoh. Madiun" required>
                                            </div>                              
                                        </div>
                                        <div class="col mb-3">
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
                                            <input type="number" class="form-control" id="no_hp_wali_pendaftar" name="no_hp_wali_pendaftar" placeholder="Masukkan No Hp" value="{{ old('no_hp_wali_pendaftar') }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email_wali_pendaftar">Email Wali<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email_wali_pendaftar" name="email_wali_pendaftar" placeholder="Masukkan Email" value="{{ old('email_wali_pendaftar') }}" required>
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
                                        <div class="col-md-4">
                                            <label for="pendidikan_wali">Pendidikan Wali</label>
                                            <input type="text" class="form-control" id="pendidikan_wali" name="pendidikan_wali" placeholder="Pendidikan" value="{{ old('pendidikan_wali') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="pekerjaan_wali">Pekerjaan Wali</label>
                                            <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" placeholder="Pekerjaan" value="{{ old('pekerjaan_wali') }}">
                                        </div>
                                        <div class="col-md-4 ">
                                            <label for="pendapatan_wali_perbulan">Pendapatan Perbulan Wali</label>
                                            <input type="number" class="form-control" id="pendapatan_wali_perbulan" name="pendapatan_wali_perbulan" placeholder="Pendapatan Perbulan" value="{{ old('pendapatan_wali_perbulan') }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="button" class="btn btn-secondary"
                                        onclick="prevStep(3)">Kembali</button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="nextStep(5)">Selanjutnya</button>
                                </div>

                                <!-- Step 5: Berkas Calon Santri -->
                                <div class="form-step p-4" id="step-5" style="display:none;">
                                    <p class="text-primary" style="display: flex; align-items: center;">
                                        <i class="bi bi-info-circle" style="margin-right: 5px;"></i>
                                        Lengkapi berkas santri dibawah dengan benar !
                                    </p>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="ktp_santri">KTP Calon Santri <span class="text-danger">*</span> <span class="text-secondary">(Masukkan ktp orang tua / wali jika tidak ada)</span></label>
                                            <input type="file" class="form-control custom-file-input"
                                                id="ktp_pendaftar" name="ktp_pendaftar" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="kk_pendaftar">Kartu Keluarga Calon Santri <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control custom-file-input"
                                                id="kk_pendaftar" name="kk_pendaftar" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="akta_kelahiran_pendaftar">Akta Kelahiran Calon Santri <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control custom-file-input"
                                                id="akta_kelahiran_pendaftar" name="akta_kelahiran_pendaftar" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="pasfoto_pendaftar">Pas Foto Calon Santri <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control custom-file-input"
                                                id="pasfoto_pendaftar" name="pasfoto_pendaftar" required>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="button" class="btn btn-secondary"
                                        onclick="prevStep(4)">Kembali</button>
                                    <button class="btn btn-primary" type="submit">Daftarkan Santri</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        // Function to go to the next step
        function nextStep(step) {
            // Hide all steps
            var steps = document.querySelectorAll('.form-step');
            steps.forEach(function(step) {
                step.style.display = 'none';
            });

            // Show the current step
            document.getElementById('step-' + step).style.display = 'block';
        }

        // Function to go to the previous step
        function prevStep(stepIndex) {
            var steps = document.querySelectorAll('.form-step');
            steps.forEach(function(step) {
                step.style.display = 'none';
            });
            document.getElementById('step-' + stepIndex).style.display = 'block';
        }

        // Initialize the form by showing the first step
        document.addEventListener('DOMContentLoaded', function() {
            nextStep(1);
        });
    </script>
@endsection
