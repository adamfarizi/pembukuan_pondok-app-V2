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
                <h5 class="mb-0">Pemasukan</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pemasukan</li>
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
                                <h4 class="card-title">Pemasukan Pondok</h4>
                            </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-primary mt-1" data-toggle="modal"
                                    data-target="#createModal">
                                    Tambah Pemasukan
                                </button>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive pb-3 pt-2 px-3">
                                <table id="tablePemasukan" class="table" role="grid"
                                    aria-describedby="user-list-page-info" style="width: 100%; min-height: 500px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal Pemasukan</th>
                                            <th>Nama Pengirim</th>
                                            <th>Jumlah Pemasukan</th>
                                            <th>Deskripsi Pemasukan</th>
                                            <th>Bukti Pemasukan</th>
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

    <!-- Modal Bukti -->
    @foreach ($pemasukans as $pemasukan)
        <div class="modal fade" id="infoModal{{ $pemasukan->id_pemasukan }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Bukti Pemasukan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="px-3 py-2">
                            <div class="mt-2 text-center">
                                @if ($pemasukan->bukti_pemasukan === null)
                                    <div class="bg-light" style="width: 440px; height: 300px; border-radius: 20px;">
                                        <p class="text-center text-secondary" style="padding-top: 100px;">Gambar tidak ada.
                                        </p>
                                    </div>
                                @else
                                    <img src="{{ asset('bukti_pemasukan/' . $pemasukan->bukti_pemasukan) }}"
                                        alt="KTP Santri" class="img-fluid" style="max-width: 440px; border-radius: 20px;">
                                    <p class="mt-2"><a
                                            href="{{ asset('bukti_pemasukan/' . $pemasukan->bukti_pemasukan) }}"
                                            download>Download Bukti</a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Create -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Pemasukan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/admin/pemasukan/create/action') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_pengirim">Nama Pengirim</label>
                            <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim"
                                value="">
                        </div>
                        <div class="form-group">
                            <label for="jumlah_pemasukan">Jumlah Pemasukan <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="jumlah_pemasukan" name="jumlah_pemasukan"
                                value="" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_pemasukan">Deskripsi Pemasukan</label>
                            <textarea class="form-control" id="deskripsi_pemasukan" name="deskripsi_pemasukan" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="bukti_pemasukan">Bukti Pemasukan <span class="text-danger">*</span></label>
                            <input type="file" class="form-control-file" id="bukti_pemasukan" name="bukti_pemasukan"
                                required>
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
    @foreach ($pemasukans as $pemasukan)
        <div class="modal fade" id="editModal{{ $pemasukan->id_pemasukan }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Data Pemasukan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('/admin/pemasukan/edit/' . $pemasukan->id_pemasukan . '/action') }}"
                        method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_pengirim">Nama Pengirim</label>
                                <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim"
                                    value="{{ $pemasukan->nama_pengirim }}">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_pemasukan">Jumlah Pemasukan <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="jumlah_pemasukan" name="jumlah_pemasukan"
                                    value="{{ $pemasukan->jumlah_pemasukan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_pemasukan">Deskripsi Pemasukan</label>
                                <textarea class="form-control" id="deskripsi_pemasukan" name="deskripsi_pemasukan" rows="4" required>{{ $pemasukan->deskripsi_pemasukan }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="bukti_pemasukan">Bukti Pemasukan <span class="text-danger">*</span></label>
                                <input type="file" class="form-control-file" id="bukti_pemasukan"
                                    name="bukti_pemasukan" required>
                                <p>
                                    File sebelumnya : {{ $pemasukan->bukti_pemasukan }}
                                </p>
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
    @foreach ($pemasukans as $pemasukan)
        <div class="modal fade" id="deleteModal{{ $pemasukan->id_pemasukan }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $pemasukan->id_pemasukan }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <form id="deleteForm" method="post"
                        action="{{ url('/admin/pemasukan/delete/' . $pemasukan->id_pemasukan) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body text-center">
                            <img src="{{ asset('images/local/danger.png') }}" width="80px" alt="">
                            <h3 class="mt-4">Anda yakin ingin hapus data ini?</h3>
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
            $('#tablePemasukan').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pemasukan') }}",
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
                    // Kolom tanggal pemasukan
                    {
                        data: 'tanggal_pemasukan',
                        render: function(data, type, full, meta) {

                            var tanggal_pemasukan = data.split(' ');
                            var tanggal = tanggal_pemasukan[0].split(
                                '-'); // Memisahkan tanggal berdasarkan "-"
                            var jam = tanggal_pemasukan[1];

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
                    {
                        data: 'nama_pengirim',
                        name: 'nama_pengirim',
                    },
                    // Kolom jumlah pemasukan
                    {
                        data: 'jumlah_pemasukan',
                        render: function(data, type, full, meta) {
                            return 'Rp. ' + data.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                                ",");
                        }
                    },
                    // Kolom diterima oleh
                    {
                        data: 'deskripsi_pemasukan',
                        name: 'deskripsi_pemasukan',
                    },
                    {
                        data: 'id_pemasukan',
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return '<div class="d-flex align-items-center">' +
                                '<a data-placement="top" title="Edit" href="#"' +
                                'data-target="#infoModal' + full.id_pemasukan +
                                '" data-toggle="modal" ' +
                                'data-id="' + full.id_pemasukan + '">' +
                                '<i class="ri-information-line"></i> Bukti' +
                                '</a>' +
                                '</div>';
                        }
                    },
                    {
                        data: 'id_pemasukan',
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return '<div class="d-flex align-items-center list-user-action">' +
                                '<a data-placement="top" title="Edit" href="#"' +
                                'data-target="#editModal' + full.id_pemasukan +
                                '" data-toggle="modal" ' +
                                'data-id="' + full.id_pemasukan + '">' +
                                '<i class="ri-pencil-line"></i>' +
                                '</a>' +
                                '<a data-placement="top" title="Delete" href="#" ' +
                                'data-target="#deleteModal' + full.id_pemasukan +
                                '" data-toggle="modal" ' +
                                'data-id="' + full.id_pemasukan + '">' +
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
