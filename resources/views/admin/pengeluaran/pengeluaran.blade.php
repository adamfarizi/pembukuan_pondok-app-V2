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
                <h5 class="mb-0">Pengeluaran</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengeluaran</li>
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
                                <h4 class="card-title">Pengeluaran Pondok</h4>
                            </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-primary mt-1" data-toggle="modal"
                                    data-target="#createModal">
                                    Tambah Pengeluaran
                                </button>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive pb-3 pt-2 px-3">
                                <table id="tablePengeluaran" class="table" role="grid"
                                    aria-describedby="user-list-page-info" style="width: 100%; min-height: 500px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal Pengeluaran</th>
                                            <th>Jumlah Pengeluaran</th>
                                            <th>Deskripsi Pengeluaran</th>
                                            <th>Nama Pengeluar</th>
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
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/admin/pengeluaran/create/action') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_pengeluar">Nama Pengeluar <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_pengeluar" name="nama_pengeluar"
                                value="" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_pengeluaran">Jumlah Pengeluaran <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="jumlah_pengeluaran" name="jumlah_pengeluaran"
                                value="" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_pengeluaran">Deskripsi Pengeluaran</label>
                            <textarea class="form-control" id="deskripsi_pengeluaran" name="deskripsi_pengeluaran" rows="4" required></textarea>
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
    @foreach ($pengeluarans as $pengeluaran)
        <div class="modal fade" id="editModal{{ $pengeluaran->id_pengeluaran }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Pengeluaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('/admin/pengeluaran/edit/' . $pengeluaran->id_pengeluaran . '/action') }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_pengeluar">Nama Pengeluar <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_pengeluar" name="nama_pengeluar"
                                    value="{{ $pengeluaran->nama_pengeluar }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_pengeluaran">Jumlah Pengeluaran <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="jumlah_pengeluaran" name="jumlah_pengeluaran"
                                    value="{{ $pengeluaran->jumlah_pengeluaran }}" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_pengeluaran">Deskripsi Pengeluaran</label>
                                <textarea class="form-control" id="deskripsi_pengeluaran" name="deskripsi_pengeluaran" rows="4" required>{{ $pengeluaran->deskripsi_pengeluaran }}</textarea>
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
    @endforeach

    <!-- Modal Delete -->
    @foreach ($pengeluarans as $pengeluaran)
        <div class="modal fade" id="deleteModal{{ $pengeluaran->id_pengeluaran }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $pengeluaran->id_pengeluaran }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <form id="deleteForm" method="post"
                        action="{{ url('/admin/pengeluaran/delete/' . $pengeluaran->id_pengeluaran) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body text-center">
                            <img src="{{ asset('images/local/danger.png') }}" width="80px" alt="">
                            <h3 class="mt-4">Anda yakin ingin hapus pengeluaran dari {{ $pengeluaran->nama_pengeluar }}?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('js')
    {{-- Datatable --}}
    <script>
        $(document).ready(function() {
            $('#tablePengeluaran').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengeluaran') }}",
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
                    // Kolom tanggal pembayaran
                    {
                        data: 'tanggal_pengeluaran',
                        render: function(data, type, full, meta) {
                            var tanggal_pengeluaran = data.split(' ');
                            var tanggal = tanggal_pengeluaran[0].split(
                                '-'); // Memisahkan tanggal berdasarkan "-"
                            var jam = tanggal_pengeluaran[1];

                            // Mengubah format tanggal dari Y-m-d ke d-m-Y
                            var formattedDate = tanggal[2] + '-' + tanggal[1] + '-' + tanggal[
                                0];

                            return '<p class="mb-0">' +
                                formattedDate +
                                '</p>' +
                                '<p class="mb-0">Jam: ' +
                                jam +
                                '</p>';
                        }
                    },
                    // Kolom jumlah pembayaran
                    {
                        data: 'jumlah_pengeluaran',
                        render: function(data, type, full, meta) {
                            return 'Rp. ' + data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                    },
                    // Kolom diterima oleh
                    {
                        data: 'deskripsi_pengeluaran',
                        name: 'deskripsi_pengeluaran',
                    },
                    // Kolom status pembayaran
                    {
                        data: 'nama_pengeluar',
                        name: 'nama_pengeluar',
                    },
                    {
                        data: 'id_pengeluaran',
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return '<div class="d-flex align-items-center list-user-action">' +
                                '<a data-placement="top" title="Edit" href="#" ' + 
                                'data-target="#editModal' + full.id_pengeluaran + 
                                '" data-toggle="modal" ' + 
                                'data-id="' + full.id_pengeluaran +'">' +
                                '<i class="ri-pencil-line"></i>' +
                                '</a>' +
                                '<a data-placement="top" title="Delete" href="#" ' +
                                'data-target="#deleteModal' + full.id_pengeluaran +
                                '" data-toggle="modal" ' +
                                'data-id="' + full.id_pengeluaran + '">' +
                                '<i class="ri-delete-bin-line"></i>' +
                                '</a>' +
                                '</div>';
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
