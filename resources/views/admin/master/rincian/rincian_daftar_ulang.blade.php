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
                <h5 class="mb-0">Master Admin</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/admin/master_admin') }}">Master Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rincian Daftar Ulang</li>
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
    <div id="content-page" class="content-page">
        <div class="container-fluid col-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card iq-mb-3 text-white bg-secondary">
                        <div class="card-body">
                            <h4 class="card-title text-white">Informasi</h4>
                            <blockquote class="blockquote mb-0">
                                <p class="font-size-14">
                                    "Perubahan pada rincian tagihan dan nominal, tidak akan
                                    mempengaruhi tagihan yang sudah dibuat. Namun, perubahan tersebut akan berlaku dan
                                    diterapkan pada tagihan berikutnya."</p>
                                <footer class="blockquote-footer text-white font-size-12">Developer</footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Daftar Ulang</h4>
                            </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-primary mt-1" data-toggle="modal"
                                    data-target="#create_jenis_rincian">
                                    Tambah Jenis Rincian
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Mukim --}}
            <div class="row">
                {{-- Laki-laki --}}
                <div class="col-sm-6">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Santri Mukim Laki-laki</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <table class="table" style="margin-bottom: 0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Keterangan Pembayaran</th>
                                            <th class="text-center">Jumlah Pembayaran</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($mukim_pria as $data)
                                            <form
                                                action="{{ url('/admin/master_admin/rincian/edit/' . $data->id_master_admin_rincian) }}"
                                                method="POST">
                                                @method('PUT')
                                                @csrf
                                                <tr>
                                                    <td style="vertical-align: middle; ">
                                                        <p style="margin: 0;">
                                                            {{ $data->keterangan_pembayaran }}
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="nominal">Rp.</span>
                                                            </div>
                                                            <input type="hidden" name="jenis_pembayaran"
                                                                value="pendaftaran_ulang">
                                                            <input type="hidden" name="jenis_mukim" value="mukim">
                                                            <input type="number" class="form-control"
                                                                name="jumlah_pembayaran"
                                                                value="{{ $data->jumlah_pembayaran }}" required
                                                                onchange="this.form.submit();">
                                                        </div>
                                                    </td>
                                                    <td class="text-center" style="vertical-align: middle;">
                                                        <div class="flex align-items-center list-user-action">
                                                            <a data-placement="top" title="Delete" href="#"
                                                                data-target="#delete_jenis_rincian{{ $data->id_master_admin_rincian }}"
                                                                data-original-title="Delete" data-toggle="modal"><i
                                                                    class="ri-delete-bin-line"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </form>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="3">Tidak ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">Total Tagihan</th>
                                            <th>
                                                <p style="font-size: medium; margin-bottom: 0; margin-left: 10px;">
                                                    Rp.
                                                    <span style="margin-left: 20px">
                                                        {{ number_format($total_mukim_pria, 0, ',', '.') }}
                                                    </span>
                                                </p>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Perempuan --}}
                <div class="col-sm-6">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Santri Mukim Perempuan</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <table class="table" style="margin-bottom: 0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Keterangan Pembayaran</th>
                                            <th class="text-center">Jumlah Pembayaran</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($mukim_perempuan as $data)
                                            <form
                                                action="{{ url('/admin/master_admin/rincian/edit/' . $data->id_master_admin_rincian) }}"
                                                method="POST">
                                                @method('PUT')
                                                @csrf
                                                <tr>
                                                    <td style="vertical-align: middle; ">
                                                        <p style="margin: 0;">
                                                            {{ $data->keterangan_pembayaran }}
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="nominal">Rp.</span>
                                                            </div>
                                                            <input type="hidden" name="jenis_pembayaran"
                                                                value="pendaftaran_ulang">
                                                            <input type="hidden" name="jenis_mukim" value="mukim">
                                                            <input type="number" class="form-control"
                                                                name="jumlah_pembayaran"
                                                                value="{{ $data->jumlah_pembayaran }}" required
                                                                onchange="this.form.submit();">
                                                        </div>
                                                    </td>
                                                    <td class="text-center" style="vertical-align: middle;">
                                                        <div class="flex align-items-center list-user-action">
                                                            <a data-placement="top" title="Delete" href="#"
                                                                data-target="#delete_jenis_rincian{{ $data->id_master_admin_rincian }}"
                                                                data-original-title="Delete" data-toggle="modal"><i
                                                                    class="ri-delete-bin-line"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </form>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="3">Tidak ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">Total Tagihan</th>
                                            <th>
                                                <p style="font-size: medium; margin-bottom: 0; margin-left: 10px;">
                                                    Rp.
                                                    <span style="margin-left: 20px">
                                                        {{ number_format($total_mukim_perempuan, 0, ',', '.') }}
                                                    </span>
                                                </p>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Non Mukim --}}
            <div class="row">
                {{-- Laki-laki --}}
                <div class="col-sm-6">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Santri Non Mukim Laki-laki</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <table class="table" style="margin-bottom: 0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Keterangan Pembayaran</th>
                                            <th class="text-center">Jumlah Pembayaran</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($non_mukim_pria as $data)
                                            <form
                                                action="{{ url('/admin/master_admin/rincian/edit/' . $data->id_master_admin_rincian) }}"
                                                method="POST">
                                                @method('PUT')
                                                @csrf
                                                <tr>
                                                    <td style="vertical-align: middle; ">
                                                        <p style="margin: 0;">
                                                            {{ $data->keterangan_pembayaran }}
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="nominal">Rp.</span>
                                                            </div>
                                                            <input type="hidden" name="jenis_pembayaran"
                                                                value="pendaftaran_ulang">
                                                            <input type="hidden" name="jenis_mukim" value="tdk_mukim">
                                                            <input type="number" class="form-control"
                                                                name="jumlah_pembayaran"
                                                                value="{{ $data->jumlah_pembayaran }}" required
                                                                onchange="this.form.submit();">
                                                        </div>
                                                    </td>
                                                    <td class="text-center" style="vertical-align: middle;">
                                                        <div class="flex align-items-center list-user-action">
                                                            <a data-placement="top" title="Delete" href="#"
                                                                data-target="#delete_jenis_rincian{{ $data->id_master_admin_rincian }}"
                                                                data-original-title="Delete" data-toggle="modal"><i
                                                                    class="ri-delete-bin-line"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </form>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="3">Tidak ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">Total Tagihan</th>
                                            <th>
                                                <p style="font-size: medium; margin-bottom: 0; margin-left: 10px;">
                                                    Rp.
                                                    <span style="margin-left: 20px">
                                                        {{ number_format($total_non_mukim_pria, 0, ',', '.') }}
                                                    </span>
                                                </p>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Perempuan --}}
                <div class="col-sm-6">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Santri Non Mukim Perempuan</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <table class="table" style="margin-bottom: 0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Keterangan Pembayaran</th>
                                            <th class="text-center">Jumlah Pembayaran</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($non_mukim_perempuan as $data)
                                            <form
                                                action="{{ url('/admin/master_admin/rincian/edit/' . $data->id_master_admin_rincian) }}"
                                                method="POST">
                                                @method('PUT')
                                                @csrf
                                                <tr>
                                                    <td style="vertical-align: middle; ">
                                                        <p style="margin: 0;">
                                                            {{ $data->keterangan_pembayaran }}
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="nominal">Rp.</span>
                                                            </div>
                                                            <input type="hidden" name="jenis_pembayaran"
                                                                value="pendaftaran_ulang">
                                                            <input type="hidden" name="jenis_mukim" value="tdk_mukim">
                                                            <input type="number" class="form-control"
                                                                name="jumlah_pembayaran"
                                                                value="{{ $data->jumlah_pembayaran }}" required
                                                                onchange="this.form.submit();">
                                                        </div>
                                                    </td>
                                                    <td class="text-center" style="vertical-align: middle;">
                                                        <div class="flex align-items-center list-user-action">
                                                            <a data-placement="top" title="Delete" href="#"
                                                                data-target="#delete_jenis_rincian{{ $data->id_master_admin_rincian }}"
                                                                data-original-title="Delete" data-toggle="modal"><i
                                                                    class="ri-delete-bin-line"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </form>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="3">Tidak ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">Total Tagihan</th>
                                            <th>
                                                <p style="font-size: medium; margin-bottom: 0; margin-left: 10px;">
                                                    Rp.
                                                    <span style="margin-left: 20px">
                                                        {{ number_format($total_non_mukim_perempuan, 0, ',', '.') }}
                                                    </span>
                                                </p>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create Rincian -->
    <div class="modal fade" id="create_jenis_rincian" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Jenis Rincian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/admin/master_admin/rincian/create') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        {{-- Jenis Mukim --}}
                        <div class="form-group">
                            <p style="margin-bottom: 2px;">Jenis Mukim <span class="text-danger">*</span></p>
                            <div class="radio d-inline-block mr-2">
                                <input type="radio" name="jenis_mukim" id="jenis_mukim_mukim" value="mukim"
                                    checked="">
                                <label for="jenis_mukim_mukim">Mukim</label>
                            </div>
                            <div class="radio d-inline-block mr-2">
                                <input type="radio" name="jenis_mukim" id="jenis_mukim_tdk_mukim" value="tdk_mukim">
                                <label for="jenis_mukim_tdk_mukim">Non Mukim</label>
                            </div>
                        </div>
                        {{-- Jenis Pembayaran --}}
                        <div class="form-group">
                            <label for="jenis_pembayaran">Jenis Pembayaran <span class="text-danger">*</span></label>
                            <select class="form-control" id="jenis_pembayaran" name="jenis_pembayaran" required>
                                <option disabled>Jenis Pembayaran</option>
                                <option value="pendaftaran_baru">Pendaftaran Baru</option>
                                <option selected="" value="pendaftaran_ulang">Pendaftaran Ulang</option>
                                <option value="semester">Semester</option>
                                <option value="iuran">Iuran Bulanan</option>
                            </select>
                        </div>
                        {{-- Jenis Santri --}}
                        <div class="form-group">
                            <p style="margin-bottom: 2px;">Jenis Santri <span class="text-danger">*</span></p>
                            <div class="radio d-inline-block mr-2">
                                <input type="radio" name="jenis_santri" id="jenis_santri_laki_laki" value="l">
                                <label for="jenis_santri_laki_laki">Laki-laki</label>
                            </div>
                            <div class="radio d-inline-block mr-2">
                                <input type="radio" name="jenis_santri" id="jenis_santri_perempuan" value="p">
                                <label for="jenis_santri_perempuan">Perempuan</label>
                            </div>
                            <div class="radio d-inline-block mr-2">
                                <input type="radio" name="jenis_santri" id="jenis_santri_campur" value="c"
                                    checked="">
                                <label for="jenis_santri_campur">Semua</label>
                            </div>
                        </div>
                        {{-- Keterangan Pembayaran --}}
                        <div class="form-group">
                            <label for="keterangan_pembayaran">Keterangan Pembayaran <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" name="keterangan_pembayaran" id="keterangan_pembayaran" rows="1" required></textarea>
                        </div>
                        {{-- Jumlah Pembayaran --}}
                        <div class="form-group">
                            <label for="jumlah_pembayaran">Jumlah Pembayaran <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="jumlah_pembayaran" name="jumlah_pembayaran"
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

    <!-- Modal Delete Rincian-->
    @foreach ($pendaftaran_ulang as $data)
        <div class="modal fade" id="delete_jenis_rincian{{ $data->id_master_admin_rincian }}" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ url('/admin/master_admin/rincian/delete/' . $data->id_master_admin_rincian) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body px-4">
                            <input type="hidden" name="jenis_rincian" class="form-control"
                                value="{{ $data->keterangan_pembayaran }}">
                            <div class="text-center">
                                <img src="{{ asset('images/local/danger.png') }}" width="80px" alt="">
                                <h3 class="mt-4">Anda yakin ingin hapus rincian ini?</h3>
                                <p style="font-size: medium">{{ $data->keterangan_pembayaran }}</p>
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
