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
                                        <label for="nama_pendaftar">Nama pendaftar <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_pendaftar" name="nama_pendaftar"
                                            value="{{ $pendaftar->nama_pendaftar }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_tanggal_lahir_pendaftar">Tempat, Tanggal Lahir <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="tempat_tanggal_lahir_pendaftar"
                                            name="tempat_tanggal_lahir_pendaftar"
                                            value="{{ $pendaftar->tempat_tanggal_lahir_pendaftar }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kelamin_pendaftar">Jenis Kelamin pendaftar <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="jenis_kelamin_pendaftar"
                                            id="jenis_kelamin_pendaftar" required>
                                            <option value="laki-laki" @if ($pendaftar->jenis_kelamin_pendaftar == 'laki-laki') selected @endif>
                                                Laki Laki</option>
                                            <option value="perempuan" @if ($pendaftar->jenis_kelamin_pendaftar == 'perempuan') selected @endif>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="no_hp_pendaftar">No Hp pendaftar <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="no_hp_pendaftar"
                                                    name="no_hp_pendaftar" value="{{ $pendaftar->no_hp_pendaftar }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="email_pendaftar">Email pendaftar <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email_pendaftar"
                                                    name="email_pendaftar" value="{{ $pendaftar->email_pendaftar }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat_pendaftar">Alamat pendaftar <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" id="alamat_pendaftar" name="alamat_pendaftar" rows="2" required>{{ $pendaftar->alamat_pendaftar }}</textarea>
                                    </div>
                                    <hr>
                                    <div class="mt-3">
                                        <button type="button" id="next-button-1"
                                            class="btn btn-primary">Selanjutnya</button>
                                        <a type="button" href="{{ route('pendaftaran') }}"
                                            class="btn iq-bg-secondary">Kembali</a>
                                    </div>
                                </div>

                                <!-- Step 2: Data Wali -->
                                <div id="step-2" class="step d-none">
                                    <p class="text-danger"><span><i class="ri-information-line"></i></span> Verifikasi
                                        data wali dari calon santri dibawah dan ubah jika ada perbedaan dengan data asli!
                                    </p>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="nama_wali_pendaftar">Nama Wali pendaftar <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="nama_wali_pendaftar"
                                                    name="nama_wali_pendaftar"
                                                    value="{{ $pendaftar->nama_wali_pendaftar }}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="no_hp_wali_pendaftar">No Hp Wali pendaftar <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="no_hp_wali_pendaftar"
                                                    name="no_hp_wali_pendaftar"
                                                    value="{{ $pendaftar->no_hp_wali_pendaftar }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="email_wali_pendaftar">Email Wali pendaftar <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email_wali_pendaftar"
                                                    name="email_wali_pendaftar"
                                                    value="{{ $pendaftar->email_wali_pendaftar }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat_wali_pendaftar">Alamat Wali pendaftar <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" id="alamat_wali_pendaftar" name="alamat_wali_pendaftar" rows="2" required>{{ $pendaftar->alamat_wali_santri }}</textarea>
                                    </div>
                                    <hr>
                                    <div class="mt-3">
                                        <button type="button" id="next-button-2"
                                            class="btn btn-primary">Selanjutnya</button>
                                        <button type="button" id="back-button-1"
                                            class="btn iq-bg-secondary">Kembali</button>
                                    </div>
                                </div>

                                <!-- Step 3: Berkas -->
                                <div id="step-3" class="step d-none">
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
                                        <button type="button" id="next-button-3"
                                            class="btn btn-primary">Selanjutnya</button>
                                        <button type="button" id="back-button-2"
                                            class="btn iq-bg-secondary">Kembali</button>
                                    </div>
                                </div>

                                <!-- Step 4: Verifikasi -->
                                <div id="step-4" class="step d-none">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="verify-checkbox">
                                        <label class="form-check-label" for="verify-checkbox">Saya yakin bahwa data yang saya masukkan di atas sudah diverifikasi dan benar. Saya
                                            ingin menerima calon santri ini sebagai santri.</label>
                                    </div>
                                    <hr>
                                    <div class="mt-3">
                                        <button type="submit" id="submit-button" class="btn btn-primary"
                                            disabled>Submit</button>
                                        <button type="button" id="back-button-3"
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
            const backButton1 = document.getElementById('back-button-1');
            const backButton2 = document.getElementById('back-button-2');
            const backButton3 = document.getElementById('back-button-3');
            const verifyCheckbox = document.getElementById('verify-checkbox');
            const submitButton = document.getElementById('submit-button');

            const step1 = document.getElementById('step-1');
            const step2 = document.getElementById('step-2');
            const step3 = document.getElementById('step-3');
            const step4 = document.getElementById('step-4');

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

            verifyCheckbox.addEventListener('change', function() {
                submitButton.disabled = !this.checked;
            });
        });
    </script>
@endsection
