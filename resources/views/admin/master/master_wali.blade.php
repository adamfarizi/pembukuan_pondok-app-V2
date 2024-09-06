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
                <h5 class="mb-0">Master Wali</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Master Wali</li>
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
                                    <h4 class="card-title">Jadwal Penjengukan Santri</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <form id="fileUploadForm">
                                    <div class="form-group">
                                        <label for="fileUpload">Pilih File:</label>
                                        <input type="file" class="form-control-file" id="fileUpload">
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary mt-1">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Point Pelanggaran Santri</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <form id="fileUploadForm">
                                    <div class="form-group">
                                        <label for="fileUpload">Pilih File:</label>
                                        <input type="file" class="form-control-file" id="fileUpload">
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary mt-1">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Data Pengumuman</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="table-responsive pb-3 pt-3 px-3">
                                    <table id="" class="table" role="grid"
                                        aria-describedby="user-list-page-info" style="width: 100%; min-height: 500px;">
                                        <thead>
                                            <tr>
                                                <th>Field</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Nama Pengumuman</td>
                                                <td>
                                                    <input class="form-control" name="nama_pengumuman" rows="3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </input>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Deskripsi</td>
                                                <td>
                                                    <textarea class="form-control" name="deskripsi_pengumuman" rows="3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Contact Person</td>
                                                <td>
                                                    <textarea class="form-control" name="cp_pengumuman" rows="3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Gambar</td>
                                                <td>
                                                    <div class="upload__box">
                                                        <input type="file" class="upload__inputfile" name="foto[]" multiple data-max_length="20">
                                                        <div class="upload__img-wrap"></div>
                                                    </div>
                                                    {{-- <input type="file" class="form-control-file" name="foto[]" multiple>
                                                    <div class="mt-3">
                                                        <img src="" alt="Foto Pondok" style="max-width: 200px; margin-top: 10px;">
                                                        @foreach($pondok->foto as $foto)
                                                            <img src="{{ asset('storage/' . $foto) }}" alt="Foto Pondok" style="max-width: 200px; margin-top: 10px;">
                                                        @endforeach
                                                    </div> --}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Daftar Pengajar Pondok Pesantren Al Huda</h4>
                                </div>
                                <div class="text-right">
                                    <a type="button" class="btn btn-primary mt-1" href="" data-toggle="modal"
                                        data-target="#createPengajarModal">
                                        Tambah Pengajar
                                    </a>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="table-responsive pb-3 pt-3 px-3">
                                    <table id="tablePengajar" class="table" role="grid"
                                        aria-describedby="user-list-page-info" style="width: 100%; min-height: 500px;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Pengajar</th>
                                                <th>Nomor Hp Pengajar</th>
                                                <th>Mata Pelajaran</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Daftar Mata Pelajaran</h4>
                                </div>
                                <div class="text-right">
                                    <a type="button" class="btn btn-primary mt-1" href="" data-toggle="modal"
                                        data-target="#createMapelModal">
                                        Tambah Mata Pelajaran
                                    </a>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="table-responsive pb-3 pt-3 px-3">
                                    <table id="tableMapel" class="table" role="grid"
                                        aria-describedby="user-list-page-info" style="width: 100%; min-height: 500px;">
                                        <thead>
                                            <tr>                                                
                                                <th>#</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Keterangan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            
            <!-- PENGUMUMAN -->
            <!-- Modal Create -->
            <div class="modal fade" id="createPengumumanModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Pengumuman</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama_pengumuman">Nama Pengumuman <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_pengumuman" name="nama_pengumuman"
                                        value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi_pengumuman">Deskripsi Pengumuman <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="deskripsi_pengumuman" name="deskripsi_pengumuman" rows="2" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="gambar_pengumuman">Gambar <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control-file" id="gambar_pengumuman" name="gambar_pengumuman" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            {{-- @foreach ($pengeluarans as $pengeluaran) --}}
                <div class="modal fade" id="editPengumumanModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Pengumuman</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                {{-- @method('PUT')
                                @csrf --}}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama_pengumuman">Nama Pengumuman <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_pengumuman" name="nama_pengumuman"
                                            value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi_pengumuman">Deskripsi Pengumuman</label>
                                        <textarea class="form-control" id="deskripsi_pengumuman" name="deskripsi_pengumuman" rows="2" required></textarea>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="gambar_pengumuman">Gambar Pengumuman <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control-file mb-3" id="gambar_pengumuman"
                                            name="bukti_pengeluaran">
                                        {{-- @if ($pengeluaran->bukti_pengeluaran !== null)
                                            <img src="{{ asset('bukti_pengeluaran/' . $pengeluaran->bukti_pengeluaran) }}"
                                                alt="Gambar Pengumuman" style="max-width: 460px; border-radius: 20px;">
                                        @else
                                            <div class="bg-light" style="width: 460px; border-radius:20px;">
                                                <p class="text-center text-secondary"
                                                    style="padding-top: 100px; padding-bottom:100px;">Gambar tidak ada.</p>
                                            </div>
                                        @endif --}}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}

            <!-- Modal Delete -->
            {{-- @foreach ($pengeluarans as $pengeluaran) --}}
                <div class="modal fade" id="deletePengumumanModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            </div>
                            <form id="deleteForm" method="post"
                                {{-- action="{{ url('/admin/pengeluaran/delete/' . $pengeluaran->id_pengeluaran) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body text-center">
                                    <img src="{{ asset('images/local/danger.png') }}" width="80px" alt="">
                                    <h3 class="mt-4">Anda yakin ingin hapus pengumuman dari {{ $pengeluaran->nama_pengeluar }}?</h3>
                                </div> --}}
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}

            <!-- Modal Info -->
            {{-- @foreach ($pengeluarans as $pengeluaran) --}}
                <div class="modal fade" id="infoPengumumanModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Gambar Pengumuman</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="px-3 py-2">
                                    <div class="mt-2 text-center">
                                        {{-- @if ($pengeluaran->bukti_pengeluaran === null) --}}
                                            <div class="bg-light" style="height: 300px; border-radius: 20px;">
                                                <p class="text-center text-secondary" style="padding-top: 130px;">Gambar tidak ada.
                                                </p>
                                            </div>
                                        {{-- @else
                                            <img src="{{ asset('bukti_pengeluaran/' . $pengeluaran->bukti_pengeluaran) }}"
                                                alt="Gambar Pengumuman" class="img-fluid" style="max-width: 440px; border-radius: 20px;">
                                            <p class="mt-2"><a
                                                    href="{{ asset('bukti_pengeluaran/' . $pengeluaran->bukti_pengeluaran) }}"
                                                    download>Download gambar</a></p>
                                        @endif --}}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}



            <!-- DATA PENGAJAR -->
            <!-- Modal Create -->
            <div class="modal fade" id="createPengajarModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Pengajar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama_pengajar">Nama Pengajar <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_pengajar" name="nama_pengajar"
                                        value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_hp_pengajar">No Hp Pengajar <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_hp_pengajar" name="no_hp_pengajar"
                                        value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="mapel_pengajar">Mata Pelajaran <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="mapel_pengajar" name="mapel_pengajar"
                                        value="" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            {{-- @foreach ($pengeluarans as $pengeluaran) --}}
                <div class="modal fade" id="editPengajarModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Pengajar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                {{-- @method('PUT')
                                @csrf --}}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama_pengajar">Nama Pengajar <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_pengajar" name="nama_pengajar"
                                            value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp_pengajar">No Hp Pengajar <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="no_hp_pengajar" name="no_hp_pengajar"
                                            value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="mapel_pengajar">Mata Pelajaran <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="mapel_pengajar" name="mapel_pengajar"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}

            <!-- Modal Delete -->
            {{-- @foreach ($pengeluarans as $pengeluaran) --}}
                <div class="modal fade" id="deletePengajarModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            </div>
                            <form id="deleteForm" method="post"
                                {{-- action="{{ url('/admin/pengeluaran/delete/' . $pengeluaran->id_pengeluaran) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body text-center">
                                    <img src="{{ asset('images/local/danger.png') }}" width="80px" alt="">
                                    <h3 class="mt-4">Anda yakin ingin hapus pengajar  dari {{ $pengeluaran->nama_pengeluar }}?</h3>
                                </div> --}}
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}            



            <!-- DAFTAR MATA PELAJARAN -->
            <!-- Modal Create -->
            <div class="modal fade" id="createMapelModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Pengajar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="mata_pelajaran">Mata Pelajaran <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="mata_pelajaran" name="mata_pelajaran"
                                        value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan_mapel">Keterangan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="keterangan_mapel" name="keterangan_mapel" rows="4" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            {{-- @foreach ($pengeluarans as $pengeluaran) --}}
                <div class="modal fade" id="editMapelModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Pengajar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                {{-- @method('PUT')
                                @csrf --}}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="mata_pelajaran">Mata Pelajaran <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="mata_pelajaran" name="mata_pelajaran"
                                            value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan_mapel">Keterangan <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="keterangan_mapel" name="keterangan_mapel" rows="4" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}

            <!-- Modal Delete -->
            {{-- @foreach ($pengeluarans as $pengeluaran) --}}
                <div class="modal fade" id="deleteMapelModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            </div>
                            <form id="deleteForm" method="post"
                                {{-- action="{{ url('/admin/pengeluaran/delete/' . $pengeluaran->id_pengeluaran) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body text-center">
                                    <img src="{{ asset('images/local/danger.png') }}" width="80px" alt="">
                                    <h3 class="mt-4">Anda yakin ingin hapus mata pelajaran dari {{ $pengeluaran->nama_pengeluar }}?</h3>
                                </div> --}}
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- @endforeach --}}        
    </div>

@endsection
@section('js')

    <!-- Pengumuman -->
    <script>
        $(document).ready(function() {
            $('#tableAdmin').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('master_admin') }}",
                columns: [
                    // Kolom nomor urut
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama_admin', //digantii
                        name: 'nama_admin'
                    },
                    {
                        data: 'email', //digantii
                        name: 'email'
                    },
                    {
                        data: 'id_pengeluaran',
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return '<div class="d-flex align-items-center">' +
                                '<a data-placement="top" title="Gambar" href="#"' +
                                'data-target="#infoPengumumanModal' + full.id_pengeluaran +
                                '" data-toggle="modal" ' +
                                'data-id="' + full.id_pengeluaran + '">' +
                                '<i class="ri-information-line"></i> Gambar' +
                                '</a>' +
                                '</div>';
                        }
                    },
                    // Kolom aksi (tombol Info, Edit, Delete)
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return '<td class="text-center">' +
                                '<div class="d-flex align-items-center list-user-action">' +
                                '<a data-placement="top" title="Edit" href="#" data-target="#editPengumumanModal' +
                                full.id_admin + '" data-toggle="modal" data-id="' + full
                                .id_admin + '">' +
                                '<i class="ri-pencil-line"></i>' +
                                '</a>' +
                                '<a data-placement="top" title="Delete" href="#" data-target="#deletePengumumanModal' +
                                full.id_admin + '" data-toggle="modal" data-id="' + full
                                .id_admin + '">' +
                                '<i class="ri-delete-bin-line"></i>' +
                                '</a>' +
                                '</div>' +
                                '</td>';
                        }
                    }
                ],
                lengthMenu: [
                    [10, 25, 50, 100, -1], // Jumlah entries per halaman, -1 untuk Tampilkan Semua Data
                    ['10', '25', '50', '100', 'Semua']
                ]
            });

        });
    </script>

    <!-- Pengajar -->
    <script>
        $(document).ready(function() {
            $('#tablePengajar').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('master_admin') }}",
                columns: [
                    // Kolom nomor urut
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama_admin', //digantii
                        name: 'nama_admin'
                    },
                    {
                        data: 'email', //digantii
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role',
                        render: function(data, type, full, meta) {
                            if (data === 'super_admin') {
                                return '<span class="badge badge-pill badge-primary">Super Admin</span>';
                            } else if (data === 'admin_pembayaran') {
                                return '<span class="badge badge-pill badge-warning">Admin Pembayaran</span>';
                            } else {
                                return '<span class="badge badge-pill badge-success">Admin Penilaian</span>';
                            }
                        }
                    },
                    // Kolom aksi (tombol Info, Edit, Delete)
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return '<td class="text-center">' +
                                '<div class="d-flex align-items-center list-user-action">' +
                                '<a data-placement="top" title="Edit" href="#" data-target="#editPengajarModal' +
                                full.id_admin + '" data-toggle="modal" data-id="' + full
                                .id_admin + '">' +
                                '<i class="ri-pencil-line"></i>' +
                                '</a>' +
                                '<a data-placement="top" title="Delete" href="#" data-target="#deletePengajarModal' +
                                full.id_admin + '" data-toggle="modal" data-id="' + full
                                .id_admin + '">' +
                                '<i class="ri-delete-bin-line"></i>' +
                                '</a>' +
                                '</div>' +
                                '</td>';
                        }
                    }
                ],
                lengthMenu: [
                    [10, 25, 50, 100, -1], // Jumlah entries per halaman, -1 untuk Tampilkan Semua Data
                    ['10', '25', '50', '100', 'Semua']
                ]
            });

        });
    </script>

    <!-- Mata Pelajaran -->
    <script>
        $(document).ready(function() {
            $('#tableMapel').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('master_admin') }}",
                columns: [
                    // Kolom nomor urut
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama_admin', //digantii
                        name: 'nama_admin'
                    },
                    {
                        data: 'email', //digantii
                        name: 'email'
                    },
                    // Kolom aksi (tombol Info, Edit, Delete)
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return '<td class="text-center">' +
                                '<div class="d-flex align-items-center list-user-action">' +
                                '<a data-placement="top" title="Edit" href="#" data-target="#editPengajarModal' +
                                full.id_admin + '" data-toggle="modal" data-id="' + full
                                .id_admin + '">' +
                                '<i class="ri-pencil-line"></i>' +
                                '</a>' +
                                '<a data-placement="top" title="Delete" href="#" data-target="#deletePengajarModal' +
                                full.id_admin + '" data-toggle="modal" data-id="' + full
                                .id_admin + '">' +
                                '<i class="ri-delete-bin-line"></i>' +
                                '</a>' +
                                '</div>' +
                                '</td>';
                        }
                    }
                ],
                lengthMenu: [
                    [10, 25, 50, 100, -1], // Jumlah entries per halaman, -1 untuk Tampilkan Semua Data
                    ['10', '25', '50', '100', 'Semua']
                ]
            });

        });
    </script>
@endsection
