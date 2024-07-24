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
            background-color: transparent; /* Ubah background color menjadi transparan */
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
            background-color: #e9edf4; /* Ganti warna background sesuai keinginan */
            color: #495057; /* Warna teks putih */
            cursor: pointer;
            box-sizing: border-box;
        }

        .custom-file-input::file-selector-button:hover {
            background-color: #0056b3; /* Ganti warna hover sesuai keinginan */
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
                                        <li>Nama Santri lengkap.</li>
                                        <li>Tempat dan Tanggal Lahir Santri.</li>
                                        <li>Jenis Kelamin Santri.</li>
                                        <li>Nomor HP Santri yang aktif.</li>
                                        <li>Email Santri yang aktif.</li>
                                        <li>Alamat lengkap Santri.</li>
                                        <li>Nama Wali Santri lengkap.</li>
                                        <li>Nomor HP Wali yang aktif.</li>
                                        <li>Email Wali yang aktif.</li>
                                        <li>Alamat lengkap Wali.</li>
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

                        <form action="{{ url('/pendaftaran-santri-baru') }}" method="POST" enctype="multipart/form-data" id="multiStepForm">
                            @csrf
                            <!-- Step 2: Data Santri -->
                            <div class="form-step p-4" id="step-2" style="display:none;">
                                <p class="text-primary" style="display: flex; align-items: center;">
                                    <i class="bi bi-info-circle" style="margin-right: 5px;"></i>
                                    Lengkapi data santri dibawah dengan benar !
                                </p>
                                <div class="mb-3">
                                    <label for="nama_pendaftar">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_pendaftar" name="nama_pendaftar"
                                        placeholder="Masukkan Nama">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tempat_tanggal_lahir_pendaftar">Tempat, Tanggal
                                            Lahir <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="tempat_tanggal_lahir_pendaftar"
                                            name="tempat_tanggal_lahir_pendaftar"
                                            placeholder="contoh. Madiun, 20 Oktober 2001">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_kelamin_pendaftar">Jenis Kelamin <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="jenis_kelamin_pendaftar"
                                            id="jenis_kelamin_pendaftar" required>
                                            <option value="laki-laki">Laki Laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="no_hp_pendaftar">No Hp <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="no_hp_pendaftar"
                                            name="no_hp_pendaftar" placeholder="Masukkan No Hp">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email_pendaftar">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email_pendaftar"
                                            name="email_pendaftar" placeholder="Masukkan Email">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat_pendaftar">Alamat <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat_pendaftar" name="alamat_pendaftar" rows="2" required
                                        placeholder="Masukkan Alamat">{{ old('alamat_pendaftar') }}</textarea>
                                </div>
                                <hr>
                                
                                <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Kembali</button>
                                <button type="button" class="btn btn-primary" onclick="nextStep(3)">Selanjutnya</button>
                            </div>

                            <!-- Step 2: Data Wali -->
                            <div class="form-step p-4" id="step-3" style="display:none;">
                                <p class="text-primary" style="display: flex; align-items: center;">
                                    <i class="bi bi-info-circle" style="margin-right: 5px;"></i>
                                    Lengkapi data wali santri dibawah dengan benar !
                                </p>
                                <div class="mb-3">
                                    <label for="nama_wali_pendaftar">Nama Wali <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_wali_pendaftar"
                                        name="nama_wali_pendaftar" placeholder="Masukkan Nama Wali">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="no_hp_wali">No Hp Wali <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="no_hp_wali"
                                            name="no_hp_wali_pendaftar" placeholder="Masukkan No Hp Wali">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email_wali_pendaftar">Email Wali <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email_wali_pendaftar"
                                            name="email_wali_pendaftar" placeholder="Masukkan Email Wali">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat_wali_pendaftar">Alamat Wali <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat_wali_pendaftar" name="alamat_wali_pendaftar" rows="2" required
                                        placeholder="Masukkan Alamat Wali">{{ old('alamat_wali_pendaftar') }}</textarea>
                                </div>
                                <hr>
                                <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Kembali</button>
                                <button type="button" class="btn btn-primary" onclick="nextStep(4)">Selanjutnya</button>
                            </div>

                            <!-- Step 3: Berkas Santri -->
                            <div class="form-step p-4" id="step-4" style="display:none;">
                                <p class="text-primary" style="display: flex; align-items: center;">
                                    <i class="bi bi-info-circle" style="margin-right: 5px;"></i>
                                    Lengkapi berkas santri dibawah dengan benar !
                                </p>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="ktp_pendaftar">KTP <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control custom-file-input" id="ktp_pendaftar"
                                            name="ktp_pendaftar" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="kk_pendaftar">Kartu Keluarga <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control custom-file-input" id="kk_pendaftar" name="kk_pendaftar"
                                            required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="akta_kelahiran_pendaftar">Akta Kelahiran <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control custom-file-input" id="akta_kelahiran_pendaftar"
                                            name="akta_kelahiran_pendaftar" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="pasfoto_pendaftar">Pas Foto <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control custom-file-input" id="pasfoto_pendaftar"
                                            name="pasfoto_pendaftar" required>
                                    </div>
                                </div>
                                <hr>
                                <button type="button" class="btn btn-secondary" onclick="prevStep(3)">Kembali</button>
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
