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
                <h5 class="mb-0">Point Pelanggaran</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Penilaian Santri</li>
                        <li class="breadcrumb-item active" aria-current="page">Point Pelanggaran</li>
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
    <!-- Page Content  -->
    <div id="content-page" class="content-page">
        <!-- Alert -->
        <div class="container-fluid">
            @if (session('success'))
                <div id="success-alert" class="alert text-white bg-success" role="alert">
                    <div class="iq-bg-icon">
                        <i class="ri-checkbox-circle-line"></i>
                    </div>
                    <div class="iq-bg-text"><b>Berhasil !</b> {{ session('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <div id="error-alert" class="alert text-white bg-danger" role="alert">
                        <div class="iq-bg-icon">
                            <i class="ri-information-line"></i>
                        </div>
                        <div class="iq-bg-text"><b>Gagal ! </b> {{ $err }}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                @endforeach
            @endif
        </div>
        {{-- Tabel --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Data Nilai Point Pelanggaran {{ $santri->nama_santri }}</h4>
                            </div>
                            <div class="text-right">
                                <a type="button" class="btn btn-light mt-1" href="" data-toggle="modal"
                                    data-target="#cek_point">
                                    Cek Daftar Pelanggaran
                                </a>
                                <a type="button" class="btn btn-primary mt-1" href="" data-toggle="modal"
                                    data-target="#create_point">
                                    Tambah Point Santri
                                </a>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <h5>Tahun : <span class="font-weight-normal">{{ $currentSemester['tahun'] }}</span></h5>
                            <h5>Semester : <span class="font-weight-normal">{{ $currentSemester['semester'] }}</span></h5>
                            <div class="table-responsive mt-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th class="text-center" scope="col">Tanggal</th>
                                            <th class="text-center" scope="col">Jenis Pelanggaran</th>
                                            <th class="" scope="col">Deskripsi Pelanggaran</th>
                                            <th class="text-center" scope="col">Point</th>
                                            <th class="text-center" scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($point_santris as $point_santri)
                                            @php

                                                $tanggal_point = \Carbon\Carbon::parse(
                                                    $point_santri->tanggal_point_santri,
                                                )->translatedFormat('d F Y'); // Format tanggal dengan hari dan bulan dalam bahasa Indonesia

                                                $jam_point = \Carbon\Carbon::parse(
                                                    $point_santri->tanggal_point_santri,
                                                )->format('H:i'); // Format waktu

                                            @endphp
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td class="text-center">{{ $tanggal_point }}</td>
                                                <td class="text-center">
                                                    @switch($point_santri->jenis_point_santri)
                                                        @case('A')
                                                            Pelanggaran Kehadiran
                                                        @break

                                                        @case('B')
                                                            Pelanggaran Etika, Kesusilaan, dan Perkelahian
                                                        @break

                                                        @case('C')
                                                            Pelanggaran Administrasi
                                                        @break

                                                        @case('D')
                                                            Pelanggaran Permainan dan Barang atau Benda Terlarang
                                                        @break

                                                        @case('E')
                                                            Pelanggaran Tindakan Pengrusakan dan Kriminal
                                                        @break

                                                        @default
                                                            Lainnya
                                                    @endswitch
                                                </td>
                                                <td style="max-width: 200px;">
                                                    {{ $point_santri->deskripsi_point_santri }}
                                                </td>
                                                <td class="text-center">{{ $point_santri->jumlah_point_santri }}</td>
                                                <td class="text-center">
                                                    <div class="flex align-items-center list-user-action">
                                                        <a data-toggle="modal"
                                                            data-target="#edit_point{{ $point_santri->id_point_santri }}"
                                                            data-original-title="Edit" href="#"><i
                                                                class="ri-pencil-line"></i></a>
                                                        <a data-toggle="modal"
                                                            data-target="#delete_point{{ $point_santri->id_point_santri }}"
                                                            data-original-title="Delete" href="#"><i
                                                                class="ri-delete-bin-line"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                                <tr class="text-center">
                                                    <td colspan="6">Tidak ada data</td>
                                                </tr>
                                            @endforelse
                                            <tr class="border">
                                                <td colspan="3"></td>
                                                <th>Total Point : </th>
                                                <td class="text-center">{{ $point_santris->sum('jumlah_point_santri') }}</td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row text-white">
                                    @php
                                        $totalPoint = $point_santris->sum('jumlah_point_santri');
                                    @endphp

                                    @if ($totalPoint <= 0)
                                        <div class="col-12">
                                            <div class="alert bg-primary" role="alert">
                                                Santri tidak melakukan pelanggaran pada semester ini !
                                            </div>
                                        </div>
                                    @elseif ($totalPoint <= 50)
                                        <div class="col-12">
                                            <div class="alert bg-danger" role="alert">
                                                <div>
                                                    <p class="mb-0">Santri memiliki point pelanggaran sejumlah
                                                        <b>{{ $totalPoint }} point</b>. Berikut adalah beberapa sanksi yang
                                                        akan diberikan :
                                                    </p>
                                                    <ol>
                                                        <li>Peringatan tertulis.</li>
                                                        <li>Tugas tambahan atau pengabdian masyarakat.</li>
                                                        <li>Pembatasan kegiatan ekstrakurikuler.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($totalPoint <= 100)
                                        <div class="col-12">
                                            <div class="alert bg-danger" role="alert">
                                                <div>
                                                    <p class="mb-0">Santri memiliki point pelanggaran sejumlah
                                                        <b>{{ $totalPoint }} point</b>. Berikut adalah beberapa sanksi yang
                                                        akan diberikan :
                                                    </p>
                                                    <ol>
                                                        <li>Peringatan tertulis dan pertemuan dengan orang tua/wali.</li>
                                                        <li>Mengikuti program bimbingan dan konseling.</li>
                                                        <li>Dibatasi dalam kegiatan sosial atau organisasi.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($totalPoint <= 150)
                                        <div class="col-12">
                                            <div class="alert bg-danger" role="alert">
                                                <div>
                                                    <p class="mb-0">Santri memiliki point pelanggaran sejumlah
                                                        <b>{{ $totalPoint }} point</b>. Berikut adalah beberapa sanksi yang
                                                        akan diberikan :
                                                    </p>
                                                    <ol>
                                                        <li>Dikenakan denda atau pembayaran kompensasi.</li>
                                                        <li>Dilarang mengikuti kegiatan khusus.</li>
                                                        <li>Dilarang menggunakan fasilitas tertentu di pesantren.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($totalPoint <= 200)
                                        <div class="col-12">
                                            <div class="alert bg-danger" role="alert">
                                                <div>
                                                    <p class="mb-0">Santri memiliki point pelanggaran sejumlah
                                                        <b>{{ $totalPoint }} point</b>. Berikut adalah beberapa sanksi yang
                                                        akan diberikan :
                                                    </p>
                                                    <ol>
                                                        <li>Dikeluarkan dari kegiatan atau acara penting di pesantren.</li>
                                                        <li>Penundaan sementara keanggotaan organisasi atau komite.</li>
                                                        <li>Perluasan sanksi administratif yang lebih serius.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Info Point-->
        <div class="modal fade" id="cek_point" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Daftar Pelanggaran Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="pdf-viewer mb-4">
                            <iframe src="{{ asset('assets/local/point_santri.pdf') }}" width="100%" height="450px">
                            </iframe>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Create-->
        <div class="modal fade" id="create_point" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Point Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ url('/admin/point_pelanggaran/' . $santri->id_santri . '/create') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tanggal_point_santri">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_point_santri"
                                    name="tanggal_point_santri">
                            </div>
                            <div class="form-group">
                                <label for="jenis_point_santri">Jenis Point <span class="text-danger">*</span></label>
                                <select class="form-control" id="jenis_point_santri" name="jenis_point_santri">
                                    <option selected="" disabled="">Pilih Jenis Point</option>
                                    <option value="A">Pelanggaran Kehadiran</option>
                                    <option value="B">Pelanggaran Etika, Kesusilaan, dan Perkelahian</option>
                                    <option value="C">Pelanggaran Administrasi</option>
                                    <option value="D">Pelanggaran Permainan dan Barang atau Benda Terlarang</option>
                                    <option value="E">Pelanggaran Tindakan Pengrusakan dan Kriminal</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_point_santri">Jumlah Point <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="jumlah_point_santri"
                                    name="jumlah_point_santri">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_point_santri">Deskripsi Point <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="deskripsi_point_santri" name="deskripsi_point_santri" rows="2"
                                    required=""></textarea>
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

        <!-- Modal Edit-->
        @foreach ($point_santris as $point_santri)
            <div class="modal fade" id="edit_point{{ $point_santri->id_point_santri }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Point Santri</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/admin/point_pelanggaran/' . $point_santri->id_point_santri . '/edit') }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="tanggal_point_santri">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_point_santri"
                                        name="tanggal_point_santri"
                                        value="{{ date('Y-m-d', strtotime($point_santri->tanggal_point_santri)) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_point_santri">Jenis Point <span class="text-danger">*</span></label>
                                    <select class="form-control" id="jenis_point_santri" name="jenis_point_santri" required>
                                        <option value="A"
                                            {{ $point_santri->jenis_point_santri == 'A' ? 'selected' : '' }}>Pelanggaran
                                            Kehadiran</option>
                                        <option value="B"
                                            {{ $point_santri->jenis_point_santri == 'B' ? 'selected' : '' }}>Pelanggaran Etika,
                                            Kesusilaan, dan Perkelahian</option>
                                        <option value="C"
                                            {{ $point_santri->jenis_point_santri == 'C' ? 'selected' : '' }}>Pelanggaran
                                            Administrasi</option>
                                        <option value="D"
                                            {{ $point_santri->jenis_point_santri == 'D' ? 'selected' : '' }}>Pelanggaran
                                            Permainan dan Barang atau Benda Terlarang</option>
                                        <option value="E"
                                            {{ $point_santri->jenis_point_santri == 'E' ? 'selected' : '' }}>Pelanggaran
                                            Tindakan Pengrusakan dan Kriminal</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_point_santri">Jumlah Point <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="jumlah_point_santri"
                                        name="jumlah_point_santri" value="{{ $point_santri->jumlah_point_santri }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi_point_santri">Deskripsi Point <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="deskripsi_point_santri" name="deskripsi_point_santri" rows="2" required>{{ $point_santri->deskripsi_point_santri }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Modal Delete Nilai-->
        @foreach ($point_santris as $point_santri)
            <div class="modal fade" id="delete_point{{ $point_santri->id_point_santri }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{ url('/admin/point_pelanggaran/' . $point_santri->id_point_santri . '/delete') }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body px-4">
                                <div class="text-center">
                                    <img src="{{ asset('images/local/danger.png') }}" width="80px" alt="">
                                    <h3 class="mt-4">Anda yakin ingin hapus point santri ini?</h3>
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
    @endsection
