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
                <h5 class="mb-0">Mata Pelajaran</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Penilaian Santri</li>
                        <li class="breadcrumb-item active" aria-current="page">Mata Pelajaran</li>
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
        {{-- Tabel --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Data Nilai Mata Pelajaran {{ $santri->nama_santri }}</h4>
                            </div>
                            <div class="text-right">
                                <a type="button" class="btn btn-primary mt-1" href="" data-toggle="modal"
                                    data-target="#create_nilai">
                                    Tambah Nilai Santri
                                </a>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <h5>Semester : <span
                                    class="font-weight-normal">{{ ucfirst($currentSemester['semester']) }}</span></h5>
                            <h5>Tahun : <span class="font-weight-normal">{{ $currentSemester['tahun'] }}</span></h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th class="text-center" scope="col">Tahun</th>
                                            <th class="text-center" scope="col">Semester</th>
                                            <th class="text-center" scope="col">Nilai Rata-Rata</th>
                                            <th class="text-center" scope="col">Nilai</th>
                                            <th class="text-center" scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($groupedNilaiSantri as $group => $nilaiSantri)
                                            @php
                                                [$tahun, $semester] = explode('-', $group);
                                                $rata_rata = $nilaiSantri->avg('nilai');
                                            @endphp
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td class="text-center">{{ $tahun }}</td>
                                                <td class="text-center">{{ ucfirst($semester) }}</td>
                                                <td class="text-center">{{ number_format($rata_rata, 2) }}</td>
                                                <td class="text-center"><span class="badge badge-primary"
                                                        data-toggle="modal" data-target="#nilai{{ $group }}"
                                                        style="cursor:pointer;">Lihat Nilai</span></td>
                                                <td class="text-center">
                                                    <div class="flex align-items-center list-user-action">
                                                        <a data-toggle="modal"
                                                            data-target="#edit_nilai{{ $group }}"
                                                            data-original-title="Edit" href="#"><i
                                                                class="ri-pencil-line"></i></a>
                                                        <a data-toggle="modal"
                                                            data-target="#delete_nilai{{ $group }}"
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create-->
    <div class="modal fade" id="create_nilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Nilai Santri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ url('/admin/mata_pelajaran/' . $santri->id_santri . '/create') }}" method="POST">
                    @csrf
                    <div class="modal-body px-4">
                        <div class="row">
                            <div class="col form-group">
                                <label for="semester_ajaran">Semester Ajaran <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="semester_ajaran" name="semester_ajaran"
                                    value="{{ $currentSemester['semester'] }}" readonly>
                            </div>
                            <div class="col form-group">
                                <label for="tahun_ajaran">Tahun Ajaran <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran"
                                    value="{{ $currentSemester['tahun'] }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="al_quran_tajwid">Al-Quran Tajwid <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="al_quran_tajwid" name="al_quran_tajwid"
                                    required>
                            </div>
                            <div class="col form-group">
                                <label for="bahasa_arab">Bahasa Arab <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="bahasa_arab" name="bahasa_arab" required>
                            </div>
                            <div class="col form-group">
                                <label for="fiqh">Fiqh <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="fiqh" name="fiqh" required>
                            </div>
                            <div class="col form-group">
                                <label for="hadist">Hadist <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="hadist" name="hadist" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="aqidah">Aqidah <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="aqidah" name="aqidah" required>
                            </div>
                            <div class="col form-group">
                                <label for="sirah_nabawiyyah">Sirah Nabawiyyah <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="sirah_nabawiyyah" name="sirah_nabawiyyah"
                                    required>
                            </div>
                            <div class="col form-group">
                                <label for="tazkiyatun_nafs">Tazkiyatun Nafs <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="tazkiyatun_nafs" name="tazkiyatun_nafs"
                                    required>
                            </div>
                            <div class="col form-group">
                                <label for="tarikh">Tarikh <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="tarikh" name="tarikh" required>
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

    <!-- Modal Info Nilai-->
    @foreach ($groupedNilaiSantri as $group => $nilaiSantri)
        @php
            [$tahun, $semester] = explode('-', $group);
        @endphp
        <div class="modal fade" id="nilai{{ $group }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Nilai Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Semester : <span class="font-weight-normal">{{ ucfirst($semester) }}</span></h6>
                        <h6>Tahun : <span class="font-weight-normal">{{ $tahun }}</span></h6>
                        <!-- Konten modal di sini -->
                        <table class="table table-sm mt-3">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col">Mata Pelajaran</th>
                                    <th scope="col" class="text-center">Nilai Angka</th>
                                    <th scope="col" class="text-center">Nilai Huruf</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilaiSantri as $nilai)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                        <td>{{ ucwords(str_replace('_', ' ', $nilai->mata_pelajaran)) }}</td>
                                        <td class="text-center">{{ $nilai->nilai }}</td>
                                        <td class="text-center">
                                            {{ $nilai->nilai >= 90 ? 'A' : ($nilai->nilai >= 80 ? 'B' : 'C') }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Edit Nilai-->
    @foreach ($groupedNilaiSantri as $group => $nilaiSantri)
        @php
            [$tahun, $semester] = explode('-', $group);
        @endphp
        <div class="modal fade" id="edit_nilai{{ $group }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Nilai Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ url('/admin/mata_pelajaran/' . $santri->id_santri . '/edit') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body px-4">
                            <div class="row">
                                <div class="col form-group">
                                    <label for="semester_ajaran">Semester Ajaran <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="semester_ajaran"
                                        name="semester_ajaran" value="{{ $semester }}" readonly>
                                </div>
                                <div class="col form-group">
                                    <label for="tahun_ajaran">Tahun Ajaran <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran"
                                        value="{{ $tahun }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="al_quran_tajwid">Al-Quran Tajwid <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="al_quran_tajwid"
                                        name="al_quran_tajwid"
                                        value="{{ $nilaiSantri->where('mata_pelajaran', 'al_quran_tajwid')->first()->nilai }}"
                                        required>
                                </div>
                                <div class="col form-group">
                                    <label for="bahasa_arab">Bahasa Arab <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="bahasa_arab" name="bahasa_arab"
                                        value="{{ $nilaiSantri->where('mata_pelajaran', 'bahasa_arab')->first()->nilai }}"
                                        required>
                                </div>
                                <div class="col form-group">
                                    <label for="fiqh">Fiqh <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="fiqh" name="fiqh"
                                        value="{{ $nilaiSantri->where('mata_pelajaran', 'fiqh')->first()->nilai }}"
                                        required>
                                </div>
                                <div class="col form-group">
                                    <label for="hadist">Hadist <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="hadist" name="hadist"
                                        value="{{ $nilaiSantri->where('mata_pelajaran', 'hadist')->first()->nilai }}"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="aqidah">Aqidah <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="aqidah" name="aqidah"
                                        value="{{ $nilaiSantri->where('mata_pelajaran', 'aqidah')->first()->nilai }}"
                                        required>
                                </div>
                                <div class="col form-group">
                                    <label for="sirah_nabawiyyah">Sirah Nabawiyyah <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="sirah_nabawiyyah"
                                        name="sirah_nabawiyyah"
                                        value="{{ $nilaiSantri->where('mata_pelajaran', 'sirah_nabawiyyah')->first()->nilai }}"
                                        required>
                                </div>
                                <div class="col form-group">
                                    <label for="tazkiyatun_nafs">Tazkiyatun Nafs <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="tazkiyatun_nafs"
                                        name="tazkiyatun_nafs"
                                        value="{{ $nilaiSantri->where('mata_pelajaran', 'tazkiyatun_nafs')->first()->nilai }}"
                                        required>
                                </div>
                                <div class="col form-group">
                                    <label for="tarikh">Tarikh <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="tarikh" name="tarikh"
                                        value="{{ $nilaiSantri->where('mata_pelajaran', 'tarikh')->first()->nilai }}"
                                        required>
                                </div>
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
    @foreach ($groupedNilaiSantri as $group => $nilaiSantri)
        @php
            [$tahun, $semester] = explode('-', $group);
        @endphp
        <div class="modal fade" id="delete_nilai{{ $group }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ url('/admin/mata_pelajaran/' . $santri->id_santri . '/delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body px-4">
                            <div class="text-center">
                                <img src="{{ asset('images/local/danger.png') }}" width="80px" alt="">
                                <h3 class="mt-4">Anda yakin ingin hapus data nilai semester {{ ucwords($semester) }}
                                    tahun
                                    {{ $tahun }}?</h3>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input type="hidden" class="form-control" id="semester_ajaran"
                                        name="semester_ajaran" value="{{ $semester }}" readonly>
                                </div>
                                <div class="col form-group">
                                    <input type="hidden" class="form-control" id="tahun_ajaran" name="tahun_ajaran"
                                        value="{{ $tahun }}" readonly>
                                </div>
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
