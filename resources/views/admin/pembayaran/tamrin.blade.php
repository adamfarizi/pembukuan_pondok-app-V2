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
                <h5 class="mb-0">Semester</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin-beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
                        <li class="breadcrumb-item active" aria-current="page">Semester</li>
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
                        <li class="nav-item iq-full-screen"><a href="#" class="iq-waves-effect"
                                id="btnFullscreen"><i class="ri-fullscreen-line"></i></a></li>
                    </ul>
                </div>
                <ul class="navbar-list">
                    <li>
                        <a href="#" class="search-toggle iq-waves-effect bg-white text-white"><img
                                src="{{ asset('images/local/user-1.png') }}" class="img-fluid rounded"
                                alt="user"></a>
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
                                <h4 class="card-title mt-3">Pembayaran Semester</h4>
                                <p class="text-dark">Semester {{ ucfirst($currentSemester['semester']) }}, Tahun Ajaran
                                    {{ $currentSemester['tahun'] }}</p>
                            </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-primary mt-1" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                    Tambah Pembayaran
                                </button>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive mb-3">
                                <table id="tableTamrin" class="table" role="grid"
                                    aria-describedby="user-list-page-info" style="width: 100%; min-height: 500px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal Pembayaran</th>
                                            <th>Nama Santri</th>
                                            <th>Jumlah Pembayaran</th>
                                            <th>Diterima Oleh</th>
                                            <th>Status</th>
                                            {{-- <th></th> --}}
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
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateForm" method="post">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_santri">Nama Santri <span class="text-danger">*</span></label>
                            <select class="form-control" name="nama_santri" id="nama_santri" style="width: 100%;"></select>
                        </div>
                        <div class="form-group">
                            <label for="jenisPembayaran">Jenis Pembayaran <span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis_bayar" id="jenisPembayaran" required>
                                <option value="lunas">Lunas</option>
                                <option value="cicilan">Cicilan</option>
                            </select>
                        </div>
                        <div class="form-group" id="jumlahBayarGroup" style="display: none;">
                            <label for="jumlah_bayar">Nominal Bayar Awal <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar">
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

    <!-- Modal Delete -->
    {{-- @foreach ($tamrins as $tamrin)
        <div class="modal fade" id="deleteModal{{ $tamrin->id_pembayaran }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $tamrin->id_pembayaran }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <form action="{{ url('/pembayaran/tamrin/delete/' . $tamrin->id_pembayaran) }}" id="deleteForm"
                        method="post">
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
    @endforeach --}}
@endsection
@section('js')
    <script>
        document.getElementById('jenisPembayaran').addEventListener('change', function () {
            var jumlahBayarGroup = document.getElementById('jumlahBayarGroup');
            if (this.value === 'cicilan') {
                jumlahBayarGroup.style.display = 'block';
                document.getElementById('jumlah_bayar').required = true;
            } else {
                jumlahBayarGroup.style.display = 'none';
                document.getElementById('jumlah_bayar').required = false;
            }
        });
    </script>

    {{-- Datatable --}}
    <script>
        $(document).ready(function() {
            $('#tableTamrin').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ secure_url('admin/tamrin') }}",
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
                        data: 'tanggal_pembayaran',
                        render: function(data, type, full, meta) {
                            if (data === null) {
                                return '<p class="text-muted" >Belum dibayar</p>';
                            } else {
                                var tanggal_pembayaran = data.split(' ');
                                var tanggal = tanggal_pembayaran[0].split(
                                '-'); // Memisahkan tanggal berdasarkan "-"
                                var jam = tanggal_pembayaran[1];

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
                        }
                    },
                    // Kolom nama santri
                    {
                        data: 'santri.nama_santri',
                        name: 'santri.nama_santri'
                    },
                    // Kolom jumlah pembayaran
                    {
                        data: 'jumlah_pembayaran',
                        render: function(data, type, full, meta) {
                            return 'Rp. ' + data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                    },
                // Kolom diterima oleh
                {
                    data: 'user.nama_admin',
                    name: 'user.nama_admin',
                    render: function (data, type, full, meta) {
                        if (data === null) {
                            return '<p class="text-muted" >Belum dibayar</p>';
                        } else {
                            return data
                        }
                    }
                },
                // Kolom status pembayaran
                {
                    data: 'status_pembayaran',
                    name: 'status_pembayaran',
                    render: function (data, type, full, meta) {
                        if (full.status_pembayaran == 'belum_lunas') {
                            // return '<span class="badge badge-pill badge-danger">Belum lunas</span>';
                            return '<div class="d-flex flex-column">' +
                                '<span class="badge badge-pill badge-danger p-2">Belum lunas</span>' +
                                '<a class="badge badge-pill badge-success p-2 mt-2" title="Info cicilan" href="/admin/tamrin/cicilan/' + full
                                    .id_pembayaran + '/bayar">' +
                                '<i class="ri-information-line"></i> Detail cicilan' +
                                '</a>' +
                                '</div>';
                        } else {
                            return '<div class="d-flex flex-column">' + '<span class="badge badge-pill badge-primary p-2">Lunas</span>' + '</div>';
                        }
                    }
                },
                ],
                lengthMenu: [
                    [10, 25, 50, 100, -1], // Jumlah entries per halaman, -1 untuk Tampilkan Semua Data
                    ['10', '25', '50', '100', 'Semua']
                ]
            });

        });
    </script>

    {{-- Select2 --}}
    <script>
        $(document).ready(function(){
            var select2Url = "{{ secure_url('admin/tamrin/seletc2') }}";
            
            $('#nama_santri').select2({
                dropdownParent: $('#exampleModalCenter'),
                minimumInputLength: 2,
                placeholder: 'Pilih Nama Santri',
                ajax: {
                    url: select2Url,
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data.map(function (res) {
                                return { text: res.santri.nama_santri, id: res.santri.id_santri };
                            })
                        };
                    }
                }
            });

            // Mengatur URL aksi formulir berdasarkan id_santri yang dipilih
            $('#nama_santri').on('change', function() {
                var selectedId = this.value;
                var form = document.getElementById('updateForm');
                var actionUrl = "{{ secure_url('/admin/tamrin/edit') }}/" + selectedId + "/action";
                form.setAttribute('action', actionUrl);
            });
        });
    </script>
@endsection

