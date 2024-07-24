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
                                <h1 class="mb-2 fw-bold">Donasi Pondok Pesantren</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card p-4 form-step mb-5" id="step-2" style="background-color: #f5f5f5; border:none;">
                            <div class="card-body row">
                                <div class="col-lg-6">
                                    <h3 class="fw-bold p-navy mt-2">Tata Cara Pembayaran / Tata Cara Isi Form</h3>
                                    <p>Anda perlu mengikuti langkah-langkah berikut untuk proses pemasukan:</p>
                                    <ol>
                                        <li>Mengisi nama pengirim.</li>
                                        <li>Masukkan jumlah pemasukan yang sesuai.</li>
                                        <li>Deskripsikan pemasukan dengan jelas.</li>
                                        <li>Unggah bukti pemasukan yang valid.</li>
                                        <li>Setelah mengisi, harap menghubungi admin untuk konfirmasi lebih lanjut.</li>
                                    </ol>
                                    <p class="fw-bold">Berikut adalah daftar akun pembayaran yang dapat Anda gunakan:</p>
                                    <ul>
                                        <li>Bank ABC: Nomor Rekening 1234567890 a/n Pusat Pendidikan ABC</li>
                                        <li>Bank XYZ: Nomor Rekening 0987654321 a/n Yayasan XYZ</li>
                                        <!-- Tambahkan akun pembayaran lainnya sesuai kebutuhan -->
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="text-center align-items-center">
                                        <img src="{{ asset('images/pondok/asset5.png') }}" alt="" class="img-fluid"
                                            style="height: 45vh;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-3">
                            <form action="{{ url('/donasi/create') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama_pengirim">Nama Pengirim</label>
                                    <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim"
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_pemasukan">Jumlah Pemasukan <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="jumlah_pemasukan" name="jumlah_pemasukan"
                                        value="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi_pemasukan">Deskripsi Pemasukan</label>
                                    <textarea class="form-control" id="deskripsi_pemasukan" name="deskripsi_pemasukan" rows="4" required></textarea>
                                </div>
                                <div class="mb-5">
                                    <label for="bukti_pemasukan">Bukti Pemasukan <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control custom-file-input" id="bukti_pemasukan"
                                        name="bukti_pemasukan" required>
                                </div>
                                <a type="button" class="btn btn-secondary" href="/">Kembali</a>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
