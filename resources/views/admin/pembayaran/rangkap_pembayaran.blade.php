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
                <h5 class="mb-0">Rangkap Pembayaran</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin-beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
                        <li class="breadcrumb-item active" aria-current="page">Rangkap Pembayaran</li>
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
                        <li class="nav-item iq-full-screen"><a href="#" class="iq-waves-effect" id="btnFullscreen"><i
                                    class="ri-fullscreen-line"></i></a></li>
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
            @if (session('warning'))
                <div id="warning-alert" class="alert text-white bg-warning" role="alert">
                    <div class="iq-alert-icon">
                        <i class="ri-error-warning-line"></i>
                    </div>
                    <div class="iq-alert-text"><b>Warning !</b> {{ session('warning') }}</div>
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

        <!-- Modal Create -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Pembayaran</h5>
                        <button id="closeModalAddPembayaran" type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="tabPembayaran" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="daftar-ulang-tab" data-toggle="tab"
                                data-target="#daftar-ulang" type="button" role="tab" aria-controls="daftar-ulang"
                                aria-selected="true">
                                Daftar Ulang Tahun Selanjutnya
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tamrin-tab" data-toggle="tab" data-target="#tamrin" type="button"
                                role="tab" aria-controls="tamrin" aria-selected="false">
                                Semester Selanjutnya
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="iuran-bulanan-tab" data-toggle="tab" data-target="#iuran-bulanan"
                                type="button" role="tab" aria-controls="iuran-bulanan" aria-selected="false">
                                Iuran Bulan Selanjutnya
                            </button>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content" id="tabPembayaranContent">

                        <!-- Daftar Ulang -->
                        <div class="tab-pane fade show active" id="daftar-ulang" role="tabpanel"
                            aria-labelledby="daftar-ulang-tab">
                            <span id="alert-status-du" class="alert alert-danger">Santri yang bersangkutan dalam status
                                bebas tagihan daftar ulang</span>
                            <form id="formAddPembayaranBaruDaftarUlang">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama_santri_du">Nama Santri <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_santri_du" name="nama_santri_du"
                                            placeholder="Nama Santri" readonly>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Jumlah Pembayaran</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" id="jumlah_tagihan_du"
                                                name="jumlah_tagihan_du" readonly>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">/ Tahun</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Konten Potongan Harga -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="true"
                                            id="showPotonganHargaDU" name="status_potongan_harga">
                                        <label class="form-check-label" for="showPotonganHargaDU">
                                            Potongan Harga
                                        </label>
                                    </div>
                                    <div class="form-group" id="potonganGroupDU" style="display: none;">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" id="potongan_harga_du"
                                                name="potongan_harga_du" placeholder="0" min="0">
                                        </div>
                                    </div>

                                    <!-- Garis Pemisah -->
                                    <hr class="mt-3 mb-3" style="border-top: 1px dashed #000; display: none;"
                                        id="dashedHrDU">

                                    <!-- Total Setelah Potongan -->
                                    <div class="form-group" id="akhirGroupDU" style="display: none">
                                        <label>Tagihan Akhir</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control font-weight-bold" id="jumlah_akhir_du"
                                                name="jumlah_akhir_du" placeholder="0" readonly>
                                        </div>
                                    </div>
                                    <input type="hidden" name="jenis_pembayaran_du" value="daftar_ulang"
                                        id="jenis_pembayaran_du">
                                    <div class="form-group mt-3">
                                        <label>Tahun Ajaran</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="tahun_pembayaran_du"
                                                name="tahun_pembayaran_du" readonly>
                                        </div>
                                    </div>
                                    <input type="hidden" name="tanggal_pembayaran_du" id="tanggal_pembayaran_du">
                                    <span class="text-muted fs-6" style="font-style: italic;">
                                        Semester otomatis Genap karena tagihan daftar ulang dibuat setiap 1 Januari per
                                        tahunnya
                                    </span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" id="submitBtnDU"
                                        disabled>Tambahkan</button>
                                </div>

                            </form>
                        </div>

                        <!-- Tamrin -->
                        <div class="tab-pane fade" id="tamrin" role="tabpanel" aria-labelledby="tamrin-tab">
                            <span id="alert-status-tamrin" class="alert alert-danger">Santri yang bersangkutan dalam status
                                bebas tagihan semester (Tamrin)</span>
                            <form id="formAddPembayaranBaruTamrin">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama_santri_tamrin">Nama Santri <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_santri_tamrin"
                                            name="nama_santri_tamrin" placeholder="Nama Santri" readonly>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Jumlah Pembayaran</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" id="jumlah_tagihan_tamrin"
                                                name="jumlah_tagihan_tamrin" placeholder="0" readonly>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">/ Semester</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Konten Potongan Harga -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="true"
                                            id="showPotonganHargaTamrin" name="status_potongan_harga">
                                        <label class="form-check-label" for="showPotonganHargaTamrin">
                                            Potongan Harga
                                        </label>
                                    </div>
                                    <div class="form-group" id="potonganGroupTamrin" style="display: none;">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" id="potongan_harga_Tamrin"
                                                name="potongan_harga_Tamrin" placeholder="0" min="0">
                                        </div>
                                    </div>

                                    <!-- Garis Pemisah -->
                                    <hr class="mt-3 mb-3" style="border-top: 1px dashed #000; display: none;"
                                        id="dashedHrTamrin">

                                    <!-- Total Setelah Potongan -->
                                    <div class="form-group" id="akhirGroupTamrin" style="display: none">
                                        <label>Tagihan Akhir</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control font-weight-bold"
                                                id="jumlah_akhir_Tamrin" name="jumlah_akhir_Tamrin" placeholder="0"
                                                readonly>
                                        </div>
                                    </div>

                                    <input type="hidden" name="jenis_pembayaran_tamrin" value="tamrin"
                                        id="jenis_pembayaran_tamrin">
                                    <div class="form-group mt-3">
                                        <label>Semester Ajaran</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="semester_pembayaran_tamrin"
                                                name="semester_pembayaran_tamrin" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Tahun Ajaran</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="tahun_pembayaran_tamrin"
                                                name="tahun_pembayaran_tamrin" readonly>
                                        </div>
                                    </div>
                                    <input type="hidden" name="tanggal_pembayaran_tamrin" id="tanggal_pembayaran_tamrin">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" id="submitBtnTamrin"
                                        disabled>Tambahkan</button>
                                </div>

                            </form>
                        </div>

                        <!-- Iuran Bulanan -->
                        <div class="tab-pane fade" id="iuran-bulanan" role="tabpanel" aria-labelledby="iuran-bulanan-tab">
                            <span id="alert-status-iuran" class="alert alert-danger">Santri yang bersangkutan dalam status
                                bebas tagihan iuran bulanan</span>
                            <form id="formAddPembayaranBaruIuran">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama_santri_iuran">Nama Santri <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_santri_iuran"
                                            name="nama_santri_iuran" placeholder="Nama Santri" readonly>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Jumlah Pembayaran</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" id="jumlah_tagihan_iuran"
                                                name="jumlah_tagihan_iuran" placeholder="0" readonly>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">/ bulan</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Konten Potongan Harga -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="true"
                                            id="showPotonganHargaIuran" name="status_potongan_harga">
                                        <label class="form-check-label" for="showPotonganHargaIuran">
                                            Potongan Harga
                                        </label>
                                    </div>
                                    <div class="form-group" id="potonganGroupIuran" style="display: none;">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" id="potongan_harga_Iuran"
                                                name="potongan_harga_Iuran" placeholder="0" min="0">
                                        </div>
                                    </div>

                                    <!-- Garis Pemisah -->
                                    <hr class="mt-3 mb-3" style="border-top: 1px dashed #000; display: none;"
                                        id="dashedHrIuran">

                                    <!-- Total Setelah Potongan -->
                                    <div class="form-group" id="akhirGroupIuran" style="display: none">
                                        <label>Tagihan Akhir</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control font-weight-bold"
                                                id="jumlah_akhir_Iuran" name="jumlah_akhir_Iuran" placeholder="0" readonly>
                                        </div>
                                    </div>

                                    <input type="hidden" name="jenis_pembayaran_iuran" value="iuran_bulanan"
                                        id="jenis_pembayaran_iuran">
                                    <div class="form-group mt-3">
                                        <label>Bulan Ajaran</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="bulan_pembayaran_iuran"
                                                name="bulan_pembayaran_iuran" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Semester Ajaran</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="semester_pembayaran_iuran"
                                                name="semester_pembayaran_iuran" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Tahun Ajaran</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="tahun_pembayaran_iuran"
                                                name="tahun_pembayaran_iuran" readonly>
                                        </div>
                                    </div>
                                    <input type="hidden" name="tanggal_pembayaran_iuran" id="tanggal_pembayaran_iuran">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" id="submitBtnIuran"
                                        disabled>Tambahkan</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Tabel --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title mt-3">{{ $title }}</h4>
                                <p class="text-dark">Daftar Ulang / Semester (Tamrin) / Iuran Bulanan</p>
                            </div>
                        </div>
                        <div class="py-3 px-2">

                            <form class="d-flex flex-column align-items-start" style="min-height: 70vh"
                                id="formRangkapPembayaran" method="POST">
                                @csrf
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="list_nama_santri">Nama Santri</label>
                                        <select class="form-control" name="list_nama_santri" id="list_nama_santri"
                                            style="width: 100%" required></select>
                                    </div>
                                    <div class="table-responsive mt-4 d-none" id="ContainertableTagihanBelumLunas">
                                        <span class="font-weight-bold">Pembayaran Santri yang Belum Lunas</span>
                                        <table id="tableTagihanBelumLunas" class="table" role="grid"
                                            aria-describedby="user-list-page-info" style="width: 100%; min-height: 100px;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Jumlah Pembayaran</th>
                                                    <th>Jenis Pembayaran</th>
                                                    <th>Semester</th>
                                                    <th>Tahun Ajaran</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="listPembayaranLama"></div>
                                    <div class="text-right mt-4">
                                        <button id="addPembayaranBaru" type="button" class="btn btn-primary mt-1"
                                            data-toggle="modal" data-target="#exampleModalCenter" disabled>
                                            Tambah Pembayaran
                                        </button>
                                    </div>
                                    <div class="table-responsive mt-2">
                                        <span class="font-weight-bold">Rangkap Pembayaran Baru Santri</span>
                                        <table id="tablePembayaranBaru" class="table" role="grid"
                                            aria-describedby="user-list-page-info" style="width: 100%; min-height: 100px;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Jumlah Pembayaran</th>
                                                    <th>Jenis Pembayaran</th>
                                                    <th>Semester</th>
                                                    <th>Tahun Ajaran</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="jumlah_tagihan">Total Tagihan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" id="jumlah_tagihan"
                                                name="jumlah_tagihan" placeholder="0" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mb-4">
                                        <label for="nominal_pembayaran">Jumlah yang dibayarkan <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" id="nominal_pembayaran"
                                                name="nominal_pembayaran" placeholder="0" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" id="clearBtn">Clear</button>
                                        <button type="submit" class="btn btn-primary" id="submitBtn"
                                            disabled>Simpan</button>
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
        $(document).ready(function () {

            let id_santri = '';
            const currentSemester = @json($currentSemester);
            const currentTahun = @json($currentTahun);
            const now = new Date();
            const currentBulan = now.getMonth();

            const bulanIndonesia = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            let valueTahunDaftarUlang = parseInt(currentTahun);
            let valueTahunTamrin = parseInt(currentTahun);
            let valueSemesterTamrin = currentSemester;
            let valueTahunIuran = parseInt(currentTahun);
            let valueSemesterIuran = currentSemester;
            let valueBulanIuran = currentBulan + 1;
            let textValueBulanIuran = bulanIndonesia[currentBulan];

            function formatBulanIndonesia(dateString) {
                const date = new Date(dateString);
                if (isNaN(date)) return ''; // fallback jika tanggal tidak valid
                return bulanIndonesia[date.getMonth()];
            }

            function getCurrentDateTimeWIB() {
                const now = new Date();

                const wibOffset = 7 * 60;
                const localOffset = now.getTimezoneOffset();
                const offsetDiff = (wibOffset + localOffset) * 60 * 1000;

                const wibTime = new Date(now.getTime() + offsetDiff);

                const year = wibTime.getFullYear();
                const month = String(wibTime.getMonth() + 1).padStart(2, '0');
                const day = String(wibTime.getDate()).padStart(2, '0');
                const hours = String(wibTime.getHours()).padStart(2, '0');
                const minutes = String(wibTime.getMinutes()).padStart(2, '0');
                const seconds = String(wibTime.getSeconds()).padStart(2, '0');

                return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            }

            function tambahKeTabel(data) {
                const index = $('#tablePembayaranBaru tbody tr').length + 1;

                let baris = `
                                    <tr data-jenis="${data.jenis_value}" data-bayar="${data.jumlah}">
                                        <td>${index}</td>
                                        <td>
                                            <input type="hidden" name="jumlah_bayar_baru[]" value="${parseInt(data.jumlah)}">
                                            <input type="hidden" name="jumlah_potongan_baru[]" value="${parseInt(data.jumlah_potongan)}">
                                            <input type="hidden" name="jumlah_awal_baru[]" value="${parseInt(data.jumlah_awal)}">
                                            Rp ${parseInt(data.jumlah).toLocaleString('id-ID')} <br/>
                                            <strong>Potongan harga: Rp ${parseInt(data.jumlah_potongan).toLocaleString('id-ID')}</strong>
                                        </td>
                                        <td>
                                            <input type="hidden" name="jenis_bayar_baru[]" value="${data.jenis_value}">
                                            ${data.jenis_text}
                                        </td>
                                        <td>
                                            <input type="hidden" name="semester_bayar_baru[]" value="${data.semester}">
                                            ${data.semester}
                                        </td>
                                        <td>
                                            <input type="hidden" name="createdAt_bayar_baru[]" value="${data.createdAt}">
                                            <input type="hidden" name="tahun_bayar_baru[]" value="${data.tahun_ajaran}">
                                            ${data.tahun_ajaran}
                                        </td>
                                        <td></td> <!-- tombol hapus akan dimasukkan di sini -->
                                    </tr>
                                `;

                $('#tablePembayaranBaru tbody').append(baris);

                // Hapus tombol hapus dari baris dengan jenis yang sama sebelumnya
                $(`#tablePembayaranBaru tbody tr[data-jenis="${data.jenis_value}"] .btn-hapus-baris`).remove();

                // Tambahkan tombol hapus ke baris terakhir dari jenis yang sama
                const lastRow = $(`#tablePembayaranBaru tbody tr[data-jenis="${data.jenis_value}"]`).last();
                const deleteButton = `
                                                        <button type="button" class="btn btn-danger btn-sm btn-hapus-baris">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    `;
                lastRow.find('td:last').html(deleteButton);
            }

            const table = $('#tableTagihanBelumLunas').DataTable({
                paging: false,
                searching: false,
                processing: true,
                serverSide: true,
                ajax: function (data, callback, settings) {
                    if (!id_santri) {
                        callback({ data: [] }); // Jangan load jika belum pilih santri
                        return;
                    }

                    $.ajax({
                        url: "/admin/rangkap_pembayaran/" + id_santri,
                        data: data,
                        success: callback
                    });
                },
                columns: [
                    {
                        render: function (data, type, full, meta) {
                            return `<input id="select_pembayaran_${full.id_pembayaran}" type="checkbox" data-id="${full.id_pembayaran}" data-tagihan="${full.jumlah_pembayaran - full.jumlah_bayar}" data-bayar="${full.jumlah_bayar}" class="select_pembayaran">`;
                        }
                    },
                    {
                        data: 'jumlah_pembayaran',
                        render: function (data, type, full, meta) {
                            var jumlahPembayaran = full.jumlah_pembayaran_sebelum_potongan;
                            var jumlahPotongan = full.jumlah_potongan || 0;
                            var totalSetelahPotongan = data;

                            var format = val => 'Rp. ' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            if (jumlahPotongan <= 0) {
                                return `
                                                                            <table class="table table-borderless m-0" style="width: 90%;">
                                                                                <tr>
                                                                                    <td class="pb-0 pt-1">Tagihan Akhir</td>
                                                                                    <td class="pb-0 pt-1 text-right"><strong>${format(totalSetelahPotongan)}</strong></td>
                                                                                </tr>
                                                                            </table>`;
                            } else {
                                return `
                                                                            <table class="table table-borderless m-0">
                                                                                <tr>
                                                                                    <td class="pb-0 pt-1">Tagihan Awal</td>
                                                                                    <td class="pb-0 pt-1 text-right">${format(jumlahPembayaran)}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="pb-0 pt-1">Potongan</td>
                                                                                    <td class="pb-0 pt-1 text-right">${format(jumlahPotongan)}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2"><hr style="border: 1px solid #e6e6e6; margin: 0;"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="pb-0 pt-1">Tagihan Akhir</td>
                                                                                    <td class="pb-0 pt-1 text-right"><strong>${format(totalSetelahPotongan)}</strong></td>
                                                                                </tr>
                                                                            </table>`;
                            }
                        }
                    },
                    {
                        data: 'jenis_pembayaran',
                        render: function (data, type, full, meta) {
                            const namaBulan = formatBulanIndonesia(full.created_at);
                            if (full.jenis_pembayaran == 'tamrin') {
                                return '<p class="text-muted" >Semester (Tamrin) </p>';
                            } else if (full.jenis_pembayaran == 'iuran_bulanan') {
                                return '<p class="text-muted" >Iuran Bulan ' + namaBulan + '</p>';
                            } else {
                                return '<p class="text-muted" >Daftar Ulang</p>';
                            }
                        }
                    },
                    { data: 'semester_ajaran', name: 'semester_ajaran' },
                    { data: 'tahun_ajaran', name: 'tahun_ajaran' },
                    {
                        data: 'status_pembayaran',
                        render: function (data, type, full, meta) {
                            if (full.status_pembayaran == 'belum_lunas') {
                                if (full.jumlah_bayar == 0) {
                                    return `<div class="d-flex flex-column">
                                                                                        <span class="badge badge-pill badge-danger p-2">Belum bayar</span>
                                                                                    </div>`;
                                } else {
                                    return `<div class="d-flex flex-column">
                                                                                        <span class="badge badge-pill badge-warning p-2"><i class="ri-information-line"></i> Belum lunas</span>
                                                                                        <a class="badge badge-pill badge-success p-2 mt-2" title="Info cicilan" href="/admin/${full.jenis_pembayaran}/cicilan/${full.id_pembayaran}/bayar"> Detail cicilan </a>
                                                                                    </div>`;
                                }
                            }
                            return '';
                        }
                    }
                ],
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ['10', '25', '50', '100', 'Semua']
                ]
            });

            // Inisialisasi Select2 untuk memilih santri
            let cacheSantri = null;
            $('#list_nama_santri').select2({
                placeholder: '-- Pilih Nama Santri --',
                width: '100%',
                dropdownCssClass: 'select2-dropdown-custom',
                templateResult: function (data) {
                    if (!data.id) return data.text;
                    return $('<span>').text(data.text).addClass('select2-result-item');
                },
                templateSelection: function (data) {
                    if (!data.id) return data.text;
                    return $('<span>').text(data.text).addClass('select2-selection-item');
                },
                ajax: {
                    transport: function (params, success, failure) {
                        // Kalau sudah pernah ambil datanya dan tidak sedang search, ambil dari cache
                        if (cacheSantri && (!params.data.term || params.data.term.length === 0)) {
                            success(cacheSantri);
                            return;
                        }

                        // Kalau belum ada cache atau sedang search, fetch dari server
                        $.ajax({
                            url: "{{ secure_url('admin/rangkap_pembayaran') }}",
                            dataType: 'json',
                            data: params.data,
                            success: function (data) {
                                // Transform dulu hasilnya
                                const results = data.map(function (res) {
                                    return {
                                        text: res.nama_santri,
                                        id: res.id_santri,
                                        jumlah_pembayaran_du: res.tagihan_santri.pendaftaran_ulang,
                                        jumlah_pembayaran_tamrin: res.tagihan_santri.semester,
                                        jumlah_pembayaran_iuran: res.tagihan_santri.iuran,
                                        semester_pembayaran_terbaru_tamrin: res.semester_pembayaran_terbaru.tamrin,
                                        semester_pembayaran_terbaru_iuran: res.semester_pembayaran_terbaru.iuran_bulanan,
                                        tahun_pembayaran_terbaru_du: res.tahun_pembayaran_terbaru.daftar_ulang,
                                        tahun_pembayaran_terbaru_tamrin: res.tahun_pembayaran_terbaru.tamrin,
                                        tahun_pembayaran_terbaru_iuran: res.tahun_pembayaran_terbaru.iuran_bulanan,
                                        bulan_pembayaran_terbaru_tamrin: res.bulan_pembayaran_terbaru.tamrin,
                                        bulan_pembayaran_terbaru_iuran: res.bulan_pembayaran_terbaru.iuran_bulanan,
                                        bebas_daftar_ulang: res.bebas_daftar_ulang,
                                        bebas_semester: res.bebas_semester,
                                        bebas_iuran: res.bebas_iuran
                                    };
                                });

                                // Simpan ke cache kalau bukan hasil pencarian
                                if (!params.data.term || params.data.term.length === 0) {
                                    cacheSantri = { results };
                                }

                                success({ results });
                            },
                            error: failure
                        });
                    },
                    processResults: function (data) {
                        return data;
                    }
                }
            });

            // Styling tambahan Select2
            $('.select2-container--default .select2-selection--single').css({
                'height': '38px',
                'border-radius': '4px',
                'border': '1px solid #ced4da'
            });

            $('.select2-container--default .select2-selection--single .select2-selection__rendered').css({
                'line-height': '36px',
                'padding-left': '12px'
            });

            $('.select2-container--default .select2-selection--single .select2-selection__arrow').css({
                'height': '36px'
            });

            // Saat memilih santri
            $('#list_nama_santri').on('change', function () {
                //reset form awal
                $('#exampleModalCenter').find('form').trigger('reset');
                var data = $('#list_nama_santri').select2('data');

                //reset awal setiap ganti santri
                valueTahunDaftarUlang = parseInt(data[0].tahun_pembayaran_terbaru_du);
                valueTahunTamrin = parseInt(data[0].tahun_pembayaran_terbaru_tamrin);
                valueSemesterTamrin = data[0].semester_pembayaran_terbaru_tamrin;
                valueTahunIuran = parseInt(data[0].tahun_pembayaran_terbaru_iuran);
                valueSemesterIuran = data[0].semester_pembayaran_terbaru_iuran;
                const lastMountIuranPay = parseInt(data[0].bulan_pembayaran_terbaru_iuran);
                valueBulanIuran = lastMountIuranPay;
                textValueBulanIuran = bulanIndonesia[currentBulan];

                //mengatur ulang nama santri, dan biaya tagihan tiap jenis pembayaran (untuk pembayaran baru)
                var selectedText = $(this).find('option:selected').text();
                $('#nama_santri_du').val(selectedText);
                $('#nama_santri_tamrin').val(selectedText);
                $('#nama_santri_iuran').val(selectedText);
                $('#jumlah_tagihan_du').val(parseFloat(data[0].jumlah_pembayaran_du));
                $('#jumlah_tagihan_tamrin').val(parseFloat(data[0].jumlah_pembayaran_tamrin));
                $('#jumlah_tagihan_iuran').val(parseFloat(data[0].jumlah_pembayaran_iuran));

                //mengatur apakah santri sedang dalam bebas tagihan tiap jenis pembayaran
                if (data[0].bebas_daftar_ulang === 'false') {
                    document.getElementById('alert-status-du').classList.add("d-none");
                    document.getElementById('submitBtnDU').disabled = false;
                } else {
                    document.getElementById('alert-status-du').classList.remove("d-none");
                    document.getElementById('submitBtnDU').disabled = true;
                }

                if (data[0].bebas_semester === 'false') {
                    document.getElementById('alert-status-tamrin').classList.add("d-none");
                    document.getElementById('submitBtnTamrin').disabled = false;
                } else {
                    document.getElementById('alert-status-tamrin').classList.remove("d-none");
                    document.getElementById('submitBtnTamrin').disabled = true;
                }

                if (data[0].bebas_iuran === 'false') {
                    document.getElementById('alert-status-iuran').classList.add("d-none");
                    document.getElementById('submitBtnIuran').disabled = false;
                } else {
                    document.getElementById('alert-status-iuran').classList.remove("d-none");
                    document.getElementById('submitBtnIuran').disabled = true;
                }

                // Update form action
                id_santri = this.value;
                const form = document.getElementById('formRangkapPembayaran');
                form.setAttribute('action', "/admin/rangkap_pembayaran/edit/" + id_santri + "/action");

                // Aktifkan elemen UI
                document.getElementById('submitBtn').disabled = false;
                document.getElementById('addPembayaranBaru').disabled = false;
                document.getElementById('ContainertableTagihanBelumLunas').classList.remove("d-none");

                //mereset form total tagihan setiap melakukan pemilihan santri lain
                document.getElementById('jumlah_tagihan').value = '';

                //preparation untuk form add pembayaran daftar ulang baru
                const defaultTahun = valueTahunDaftarUlang + 1;
                valueTahunDaftarUlang = defaultTahun;
                const formatted = `${valueTahunDaftarUlang}-01-01 00:00:00`;
                $('#tahun_pembayaran_du').val(valueTahunDaftarUlang)
                $('#tanggal_pembayaran_du').val(formatted);

                //preparation untuk form add pembayaran semester baru
                if (valueSemesterTamrin === 'ganjil') {
                    valueSemesterTamrin = 'genap'
                    const defaultTahunTamrin = valueTahunTamrin + 1
                    valueTahunTamrin = defaultTahunTamrin
                    const formattedTamrin = `${valueTahunTamrin}-01-01 00:00:00`;
                    $('#tanggal_pembayaran_tamrin').val(formattedTamrin);
                } else {
                    valueSemesterTamrin = 'ganjil'
                    const formattedTamrin = `${valueTahunTamrin}-07-01 00:00:00`;
                    $('#tanggal_pembayaran_tamrin').val(formattedTamrin);
                }
                $('#tahun_pembayaran_tamrin').val(valueTahunTamrin)
                $('#semester_pembayaran_tamrin').val(valueSemesterTamrin);

                //preparation untuk form add pembayaran iuran baru
                // lanjut tahun berikutnya jika sekarang bulan desember
                if (valueBulanIuran === 12) {
                    valueBulanIuran = 0;
                    const defaultTahunIuran = valueTahunIuran + 1;
                    valueTahunIuran = defaultTahunIuran;
                }
                //lanjut semester berikutnya jika sekarang bulan juni (juli termasuk semester ganjil)
                if (valueBulanIuran < 6) {
                    valueSemesterIuran = 'genap';
                } else {
                    valueSemesterIuran = 'ganjil';
                }
                //set bulan untuk pembayaran selanjutnya
                textValueBulanIuran = bulanIndonesia[valueBulanIuran];
                const defaultBulanIuran = valueBulanIuran + 1;
                valueBulanIuran = defaultBulanIuran;
                const formattedIuran = `${valueTahunIuran}-${valueBulanIuran}-01 00:00:00`;

                $('#bulan_pembayaran_iuran').val(textValueBulanIuran)
                $('#semester_pembayaran_iuran').val(valueSemesterIuran)
                $('#tahun_pembayaran_iuran').val(valueTahunIuran);
                $('#tanggal_pembayaran_iuran').val(formattedIuran);

                // menghapus list pembayaran baru setiap ganti santri
                $('#tablePembayaranBaru tbody').empty();

                $('#listPembayaranLama').empty();

                //tutup menu potongan harga pada form DU
                var potonganGroupDU = document.getElementById('potonganGroupDU');
                var dashedHrDU = document.getElementById('dashedHrDU');
                var akhirGroupDU = document.getElementById('akhirGroupDU');

                document.getElementById('showPotonganHargaDU').checked = false;
                potonganGroupDU.style.display = 'none';
                akhirGroupDU.style.display = 'none';
                dashedHrDU.style.display = 'none';
                document.getElementById('potongan_harga_du').value = 0;

                // tutup lagi menu potongan pada form Tamrin
                var potonganGroupTamrin = document.getElementById('potonganGroupTamrin');
                var dashedHrTamrin = document.getElementById('dashedHrTamrin');
                var akhirGroupTamrin = document.getElementById('akhirGroupTamrin');

                document.getElementById('showPotonganHargaTamrin').checked = false;
                potonganGroupTamrin.style.display = 'none';
                akhirGroupTamrin.style.display = 'none';
                dashedHrTamrin.style.display = 'none';
                document.getElementById('potongan_harga_Tamrin').value = 0;

                // menutup lagi menu potongan pada form Iuran
                var potonganGroupIuran = document.getElementById('potonganGroupIuran');
                var dashedHrIuran = document.getElementById('dashedHrIuran');
                var akhirGroupIuran = document.getElementById('akhirGroupIuran');

                document.getElementById('showPotonganHargaIuran').checked = false;
                potonganGroupIuran.style.display = 'none';
                akhirGroupIuran.style.display = 'none';
                dashedHrIuran.style.display = 'none';
                document.getElementById('potongan_harga_Iuran').value = 0;

                // Reload DataTable
                table.ajax.reload();
            });

            $('#nominal_pembayaran').on('change', function () {
                const nominalPembayaran = parseFloat($(this).val()) || 0;
                const jumlahTagihan = parseFloat($('#jumlah_tagihan').val()) || 0;
                const namaSantri = $('#list_nama_santri').val();

                if (nominalPembayaran >= jumlahTagihan && namaSantri) {
                    $('#submitBtn').prop('disabled', false);
                } else {
                    $('#submitBtn').prop('disabled', true);
                }
            });

            $('#clearBtn').on("click", function () {
                location.reload();
            });

            $(document).on('change', '.select_pembayaran', function () {
                const total_harga_el = document.getElementById('jumlah_tagihan');
                let total_harga = parseFloat(total_harga_el.value) || 0;
                const tagihan = parseFloat($(this).data('tagihan')) || 0;

                if (this.checked) {
                    total_harga += tagihan;
                    // Tambahkan input hidden ke dalam div listPembayaranLama
                    $('#listPembayaranLama').append(`<input type="hidden" name="id_pembayaran_lama[]" value="${$(this).data('id')}" id="input_pembayaran_lama_${$(this).data('id')}">`);
                } else {
                    total_harga -= tagihan;
                    // Hapus input hidden berdasarkan ID
                    $(`#input_pembayaran_lama_${$(this).data('id')}`).remove();
                }

                total_harga_el.value = Math.round(total_harga);
            });

            $('#formRangkapPembayaran').on('submit', function (e) {
                e.preventDefault();

                const jumlah_tagihan = parseFloat($('#jumlah_tagihan').val()) || 0;
                const nominal_pembayaran = parseFloat($('#nominal_pembayaran').val()) || 0;

                if (jumlah_tagihan < 1) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Opsss...',
                        text: 'Mohon untuk menambahkan pembayaran yang ingin dibayar!',
                        confirmButtonText: 'OK'
                    })
                    return;
                }

                if (nominal_pembayaran < jumlah_tagihan) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Opsss...',
                        text: 'Nominal yang Anda bayarkan kurang dari tagihan yang diberikan!',
                        confirmButtonText: 'OK'
                    })
                    return;
                }

                Swal.fire({
                    title: 'Apakah Anda yakin untuk melakukan pembayaran?',
                    icon: 'question',
                    text: 'Jika ada pembayaran yang sudah lampau tidak akan dapat dibatalkan, yakin lanjutkan?',
                    showCancelButton: true,
                    confirmButtonText: 'Iya, lanjutkan',
                    cancelButtonText: 'Batal',
                }).then(result => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });

            });

            $('#formAddPembayaranBaruDaftarUlang').on('submit', function (e) {
                e.preventDefault();
                var jumlahTagihan = parseFloat($('#jumlah_tagihan_du').val()) || 0; //pasti ada misal daftar_ulang = 200000
                var jumlahPotongan = parseFloat($('#potongan_harga_du').val()) || 0; //jika check potongan akan ada form potongan dan mengambl val tersebut jika tidak ada 0
                var totalPembayaran = parseFloat($('#jumlah_akhir_du').val()) || jumlahTagihan; //jika check potongan akan ada form jumlah akhir dan mengambl val tersebut jika tidak ada 0 (val sudah otomatis menghitung sebelumnya) (atribute jumlah_bayar)
                var jumlahSebelumPotongan = jumlahPotongan > 0 ? jumlahTagihan : 0; //jika ada potongan jumlah sebelumnya sesuai tagihan awal (200000) jika tidak nilai 0

                //tambah ke total tagihan
                const total_harga_el = document.getElementById('jumlah_tagihan');
                let total_harga = parseFloat(total_harga_el.value) || 0;
                total_harga += totalPembayaran;
                total_harga_el.value = Math.round(total_harga);

                tambahKeTabel({
                    jumlah: totalPembayaran,
                    jumlah_potongan: jumlahPotongan,
                    jumlah_awal: jumlahSebelumPotongan,
                    jenis_text: 'Daftar Ulang',
                    jenis_value: $('#jenis_pembayaran_du').val(),
                    semester: 'genap',
                    tahun_ajaran: $('#tahun_pembayaran_du').val(),
                    createdAt: $('#tanggal_pembayaran_du').val()
                });

                $('#closeModalAddPembayaran').click();

                //set value pembayaran berikutnya setelah tertambah ke list (aturan daftar ulang 1 tahun 1 kali) di tahun ajaran semester genap (1 Januari)
                const defaultTahun = valueTahunDaftarUlang + 1;
                $('#tahun_pembayaran_du').val(defaultTahun)
                valueTahunDaftarUlang = defaultTahun;

                //tutup menu potongan harga pada form DU
                var potonganGroupDU = document.getElementById('potonganGroupDU');
                var dashedHrDU = document.getElementById('dashedHrDU');
                var akhirGroupDU = document.getElementById('akhirGroupDU');

                document.getElementById('showPotonganHargaDU').checked = false;
                potonganGroupDU.style.display = 'none';
                akhirGroupDU.style.display = 'none';
                dashedHrDU.style.display = 'none';
                document.getElementById('potongan_harga_du').value = 0;
            });

            $('#formAddPembayaranBaruTamrin').on('submit', function (e) {
                e.preventDefault();
                var jumlahTagihan = parseFloat($('#jumlah_tagihan_tamrin').val()) || 0; //pasti ada misal daftar_ulang = 200000
                var jumlahPotongan = parseFloat($('#potongan_harga_Tamrin').val()) || 0; //jika check potongan akan ada form potongan dan mengambl val tersebut jika tidak ada 0
                var totalPembayaran = parseFloat($('#jumlah_akhir_Tamrin').val()) || jumlahTagihan; //jika check potongan akan ada form jumlah akhir dan mengambl val tersebut jika tidak ada 0 (val sudah otomatis menghitung sebelumnya) (atribute jumlah_bayar)
                var jumlahSebelumPotongan = jumlahPotongan > 0 ? jumlahTagihan : 0; //jika ada potongan jumlah sebelumnya sesuai tagihan awal (200000) jika tidak nilai 0

                //tambah ke total tagihan
                const total_harga_el = document.getElementById('jumlah_tagihan');
                let total_harga = parseFloat(total_harga_el.value) || 0;
                total_harga += totalPembayaran;
                total_harga_el.value = Math.round(total_harga);

                tambahKeTabel({
                    jumlah: totalPembayaran,
                    jumlah_potongan: jumlahPotongan,
                    jumlah_awal: jumlahSebelumPotongan,
                    jenis_text: 'Semester',
                    jenis_value: $('#jenis_pembayaran_tamrin').val(),
                    semester: $('#semester_pembayaran_tamrin').val(), //ganjil
                    tahun_ajaran: $('#tahun_pembayaran_tamrin').val(), //2025
                    createdAt: $('#tanggal_pembayaran_tamrin').val() //2025-07-01 00:00:00
                });

                $('#closeModalAddPembayaran').click();

                //set value pembayaran berikutnya setelah tertambah ke list (aturan tamrin 1 tahun 2 kali ganjil dan genap) dengan rincian (genap 1 januari, ganjil 1 juli)
                valueSemesterTamrin = $('#semester_pembayaran_tamrin').val();
                if (valueSemesterTamrin === 'ganjil') {
                    valueSemesterTamrin = 'genap'
                    const defaultTahunTamrin = valueTahunTamrin + 1
                    valueTahunTamrin = defaultTahunTamrin
                    const formattedTamrin = `${valueTahunTamrin}-01-01 00:00:00`;
                    $('#tanggal_pembayaran_tamrin').val(formattedTamrin);
                } else {
                    valueSemesterTamrin = 'ganjil'
                    const formattedTamrin = `${valueTahunTamrin}-07-01 00:00:00`;
                    $('#tanggal_pembayaran_tamrin').val(formattedTamrin);
                }

                $('#tahun_pembayaran_tamrin').val(valueTahunTamrin)
                $('#semester_pembayaran_tamrin').val(valueSemesterTamrin);

                // tutup lagi menu potongan pada form Tamrin
                var potonganGroupTamrin = document.getElementById('potonganGroupTamrin');
                var dashedHrTamrin = document.getElementById('dashedHrTamrin');
                var akhirGroupTamrin = document.getElementById('akhirGroupTamrin');

                document.getElementById('showPotonganHargaTamrin').checked = false;
                potonganGroupTamrin.style.display = 'none';
                akhirGroupTamrin.style.display = 'none';
                dashedHrTamrin.style.display = 'none';
                document.getElementById('potongan_harga_Tamrin').value = 0;
            });

            $('#formAddPembayaranBaruIuran').on('submit', function (e) {
                e.preventDefault();
                var jumlahTagihan = parseFloat($('#jumlah_tagihan_iuran').val()) || 0; //pasti ada misal daftar_ulang = 200000
                var jumlahPotongan = parseFloat($('#potongan_harga_Iuran').val()) || 0; //jika check potongan akan ada form potongan dan mengambl val tersebut jika tidak ada 0
                var totalPembayaran = parseFloat($('#jumlah_akhir_Iuran').val()) || jumlahTagihan; //jika check potongan akan ada form jumlah akhir dan mengambl val tersebut jika tidak ada 0 (val sudah otomatis menghitung sebelumnya) (atribute jumlah_bayar)
                var jumlahSebelumPotongan = jumlahPotongan > 0 ? jumlahTagihan : 0; //jika ada potongan jumlah sebelumnya sesuai tagihan awal (200000) jika tidak nilai 0

                //tambah ke total tagihan
                const total_harga_el = document.getElementById('jumlah_tagihan');
                let total_harga = parseFloat(total_harga_el.value) || 0;
                total_harga += totalPembayaran;
                total_harga_el.value = Math.round(total_harga);

                tambahKeTabel({
                    jumlah: totalPembayaran,
                    jumlah_potongan: jumlahPotongan,
                    jumlah_awal: jumlahSebelumPotongan,
                    jenis_text: 'Iuran Bulan ' + $('#bulan_pembayaran_iuran').val(),
                    jenis_value: $('#jenis_pembayaran_iuran').val(),
                    semester: $('#semester_pembayaran_iuran').val(), //ganjil
                    tahun_ajaran: $('#tahun_pembayaran_iuran').val(), //2025
                    createdAt: $('#tanggal_pembayaran_iuran').val() //2025-07-01 00:00:00
                });

                $('#closeModalAddPembayaran').click();

                //preparation untuk form add pembayaran iuran baru selanjutnya setelah add list
                // lanjut tahun berikutnya jika sekarang bulan desember
                if (valueBulanIuran === 12) {
                    valueBulanIuran = 0;
                    const defaultTahunIuran = valueTahunIuran + 1;
                    valueTahunIuran = defaultTahunIuran;
                }
                //lanjut semester berikutnya jika sekarang bulan juni (juli termasuk semester ganjil)
                if (valueBulanIuran < 6) {
                    valueSemesterIuran = 'genap';
                } else {
                    valueSemesterIuran = 'ganjil';
                }
                //set bulan untuk pembayaran selanjutnya
                const indexbulan = valueBulanIuran;
                textValueBulanIuran = bulanIndonesia[indexbulan];
                const defaultBulanIuran = valueBulanIuran + 1;
                valueBulanIuran = defaultBulanIuran;
                const formattedIuran = `${valueTahunIuran}-${valueBulanIuran}-01 00:00:00`;

                $('#bulan_pembayaran_iuran').val(textValueBulanIuran)
                $('#semester_pembayaran_iuran').val(valueSemesterIuran)
                $('#tahun_pembayaran_iuran').val(valueTahunIuran);
                $('#tanggal_pembayaran_iuran').val(formattedIuran);

                // menutup lagi menu potongan pada form Iuran
                var potonganGroupIuran = document.getElementById('potonganGroupIuran');
                var dashedHrIuran = document.getElementById('dashedHrIuran');
                var akhirGroupIuran = document.getElementById('akhirGroupIuran');

                document.getElementById('showPotonganHargaIuran').checked = false;
                potonganGroupIuran.style.display = 'none';
                akhirGroupIuran.style.display = 'none';
                dashedHrIuran.style.display = 'none';
                document.getElementById('potongan_harga_Iuran').value = 0;
            });

            $('#tablePembayaranBaru').on('click', '.btn-hapus-baris', function () {
                const row = $(this).closest('tr');

                const jenis = row.data('jenis');
                const jumlah_bayar_tiap_row = row.data('bayar');

                if (jenis === 'daftar_ulang') {
                    const defaultTahun = valueTahunDaftarUlang - 1;
                    $('#tahun_pembayaran_du').val(defaultTahun)
                    valueTahunDaftarUlang = defaultTahun;
                } else if (jenis === 'tamrin') {
                    valueSemesterTamrin = $('#semester_pembayaran_tamrin').val();
                    if (valueSemesterTamrin === 'ganjil') {
                        valueSemesterTamrin = 'genap'
                        const formattedTamrin = `${valueTahunTamrin}-01-01 00:00:00`;
                        $('#tanggal_pembayaran_tamrin').val(formattedTamrin);
                    } else {
                        valueSemesterTamrin = 'ganjil'
                        const defaultTahunTamrin = valueTahunTamrin - 1
                        valueTahunTamrin = defaultTahunTamrin
                        const formattedTamrin = `${valueTahunTamrin}-07-01 00:00:00`;
                        $('#tanggal_pembayaran_tamrin').val(formattedTamrin);
                    }
                    $('#tahun_pembayaran_tamrin').val(valueTahunTamrin)
                    $('#semester_pembayaran_tamrin').val(valueSemesterTamrin);
                } else {
                    const indexBulanSebelumnya = valueBulanIuran === 1 ? 11 : valueBulanIuran - 2;
                    const defaultBulanIuran = valueBulanIuran === 1 ? 12 : valueBulanIuran - 1;
                    valueBulanIuran = defaultBulanIuran;

                    if (valueBulanIuran === 12) {
                        const defaultTahunIuran = valueTahunIuran - 1;
                        valueTahunIuran = defaultTahunIuran;
                    }

                    if (valueBulanIuran <= 6) {
                        valueSemesterIuran = 'genap';
                    } else {
                        valueSemesterIuran = 'ganjil';
                    }

                    textValueBulanIuran = bulanIndonesia[indexBulanSebelumnya];
                    const formattedIuran = `${valueTahunIuran}-${valueBulanIuran}-01 00:00:00`;

                    $('#bulan_pembayaran_iuran').val(textValueBulanIuran)
                    $('#semester_pembayaran_iuran').val(valueSemesterIuran)
                    $('#tahun_pembayaran_iuran').val(valueTahunIuran);
                    $('#tanggal_pembayaran_iuran').val(formattedIuran);
                }
                //kurangi jumlah pembayaran tiap tr dari total tagihan
                const total_harga_el = document.getElementById('jumlah_tagihan');
                let total_harga = parseFloat(total_harga_el.value) || 0;
                const tagihan = parseFloat(jumlah_bayar_tiap_row) || 0;
                total_harga -= tagihan;
                total_harga_el.value = Math.round(total_harga);

                row.remove();

                // Re-index ulang nomor urut
                $('#tablePembayaranBaru tbody tr').each(function (i, tr) {
                    $(tr).find('td:first').text(i + 1);
                });

                // Hapus semua tombol hapus dari jenis yang sama
                $(`#tablePembayaranBaru tbody tr[data-jenis="${jenis}"] .btn-hapus-baris`).remove();

                // Tambahkan kembali tombol hapus ke baris terakhir dari jenis yang sama
                const lastRow = $(`#tablePembayaranBaru tbody tr[data-jenis="${jenis}"]`).last();
                if (lastRow.length) {
                    const createdAt = lastRow.find('input[name="createdAt_bayar_baru[]"]').val() || '';
                    const deleteButton = `
                                                                                                                                                                    <button type="button" class="btn btn-danger btn-sm btn-hapus-baris">
                                                                                                                                                                        <input type="hidden" name="createdAt_bayar_baru[]" value="${createdAt}">
                                                                                                                                                                        <i class="ri-delete-bin-line"></i>
                                                                                                                                                                    </button>
                                                                                                                                                                `;
                    lastRow.find('td:last').html(deleteButton);
                }
            });
        });
    </script>

    {{-- Input Potongan Harga --}}
    <script>

        function hitungTotalDU() {
            var jumlahTagihan = parseFloat(document.getElementById('jumlah_tagihan_du').value) || 0;
            var potonganHarga = parseFloat(document.getElementById('potongan_harga_du').value) || 0;

            var totalAkhir = jumlahTagihan - potonganHarga;
            document.getElementById('jumlah_akhir_du').value = totalAkhir;
        }

        function hitungTotalTamrin() {
            var jumlahTagihan = parseFloat(document.getElementById('jumlah_tagihan_tamrin').value) || 0;
            var potonganHarga = parseFloat(document.getElementById('potongan_harga_Tamrin').value) || 0;

            var totalAkhir = jumlahTagihan - potonganHarga;
            document.getElementById('jumlah_akhir_Tamrin').value = totalAkhir;
        }

        function hitungTotalIuran() {
            var jumlahTagihan = parseFloat(document.getElementById('jumlah_tagihan_iuran').value) || 0;
            var potonganHarga = parseFloat(document.getElementById('potongan_harga_Iuran').value) || 0;

            var totalAkhir = jumlahTagihan - potonganHarga;
            document.getElementById('jumlah_akhir_Iuran').value = totalAkhir;
        }

        document.getElementById('showPotonganHargaDU').addEventListener('change', function () {
            var potonganGroupDU = document.getElementById('potonganGroupDU');
            var dashedHrDU = document.getElementById('dashedHrDU');
            var akhirGroupDU = document.getElementById('akhirGroupDU');

            if (this.checked) {
                potonganGroupDU.style.display = 'block';
                akhirGroupDU.style.display = 'block';
                dashedHrDU.style.display = 'block';
            } else {
                potonganGroupDU.style.display = 'none';
                akhirGroupDU.style.display = 'none';
                dashedHrDU.style.display = 'none';
                document.getElementById('potongan_harga_du').value = 0;
            }
            hitungTotalDU();
        });

        document.getElementById('potongan_harga_du').addEventListener('input', hitungTotalDU);
        document.getElementById('jumlah_tagihan_du').addEventListener('input', hitungTotalDU);

        document.getElementById('showPotonganHargaTamrin').addEventListener('change', function () {
            var potonganGroupTamrin = document.getElementById('potonganGroupTamrin');
            var dashedHrTamrin = document.getElementById('dashedHrTamrin');
            var akhirGroupTamrin = document.getElementById('akhirGroupTamrin');

            if (this.checked) {
                potonganGroupTamrin.style.display = 'block';
                akhirGroupTamrin.style.display = 'block';
                dashedHrTamrin.style.display = 'block';
            } else {
                potonganGroupTamrin.style.display = 'none';
                akhirGroupTamrin.style.display = 'none';
                dashedHrTamrin.style.display = 'none';
                document.getElementById('potongan_harga_Tamrin').value = 0;
            }
            hitungTotalTamrin();
        });

        document.getElementById('potongan_harga_Tamrin').addEventListener('input', hitungTotalTamrin);
        document.getElementById('jumlah_tagihan_tamrin').addEventListener('input', hitungTotalTamrin);

        document.getElementById('showPotonganHargaIuran').addEventListener('change', function () {
            var potonganGroupIuran = document.getElementById('potonganGroupIuran');
            var dashedHrIuran = document.getElementById('dashedHrIuran');
            var akhirGroupIuran = document.getElementById('akhirGroupIuran');

            if (this.checked) {
                potonganGroupIuran.style.display = 'block';
                akhirGroupIuran.style.display = 'block';
                dashedHrIuran.style.display = 'block';
            } else {
                potonganGroupIuran.style.display = 'none';
                akhirGroupIuran.style.display = 'none';
                dashedHrIuran.style.display = 'none';
                document.getElementById('potongan_harga_Iuran').value = 0;
            }
            hitungTotalIuran();
        });

        document.getElementById('potongan_harga_Iuran').addEventListener('input', hitungTotalIuran);
        document.getElementById('jumlah_tagihan_iuran').addEventListener('input', hitungTotalIuran);
    </script>
@endsection