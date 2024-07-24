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
                <h5 class="mb-0">Santri</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Santri</li>
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
                                <h4 class="card-title">Data Santri</h4>
                            </div>
                            <div class="text-right">
                                <a type="button" class="btn btn-primary mt-1" href="{{ url('admin/santri/create') }}">
                                    Tambah Santri
                                </a>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive pb-3 pt-3 px-3">
                                <table id="tableSantri" class="table" role="grid"
                                    aria-describedby="user-list-page-info" style="width: 100%; min-height: 500px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Santri</th>
                                            <th>TTL</th>
                                            <th>Alamat</th>
                                            <th>No. HP</th>
                                            <th>Status</th>
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

    <!-- Info Modal -->
    {{-- @foreach ($santris as $santri)
        <div class="modal fade" id="infoModal{{ $santri->id_santri }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $santri->id_santri }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Data Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-dark" id="dynamicContent">
                        <div class="px-3 py-2">
                            <div class="row">
                                <div class="col">
                                    <div class="mt-2">
                                        <h6>Nama Santri:</h6>
                                        <p>{{ $santri->nama_santri }}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>Tempat, Tanggal Lahir:</h6>
                                        <p>{{ $santri->tempat_tanggal_lahir_santri }}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>No Hp:</h6>
                                        <p>{{ $santri->no_hp_santri }}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>Email:</h6>
                                        <p>{{ $santri->email_santri }}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mt-2">
                                        <h6>Jenis Kelami:</h6>
                                        <p>{{ $santri->jenis_kelamin_santri }}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>Status Santri:</h6>
                                        @if ($santri->status_santri === 'pulang')
                                            <span class="badge badge-pill badge-primary">Pulang</span>
                                        @else
                                            <span class="badge badge-pill badge-success">Menetap</span>
                                        @endif
                                    </div>
                                    <div class="mt-2">
                                        <h6>Nama Wali Santri:</h6>
                                        <p>{{ $santri->WaliSantri->nama_wali_santri }}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>No Hp Wali Santri:</h6>
                                        <p>{{ $santri->WaliSantri->no_hp }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <h6>Alamat:</h6>
                                <p>{{ $santri->alamat_santri }}</p>
                            </div>
                            <h5 class="mt-4"><u>Berkas Santri</u></h5>
                            <div class="mt-2">
                                <h6 class="mb-2">KTP Santri:</h6>
                                @if ($santri->ktp_santri === null)
                                    <div class="bg-light" style="width: 440px; border-radius:20px;">
                                        <p class="text-center text-secondary"
                                            style="padding-top: 100px; padding-bottom:100px;">Gambar tidak ada.</p>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img src="{{ asset('berkas_santri/ktp_santri/' . $santri->ktp_santri) }}"
                                            alt="" style="max-width: 440px; border-radius: 20px;">
                                        <p class="mt-2"><a
                                                href="{{ asset('berkas_santri/ktp_santri/' . $santri->ktp_santri) }}"
                                                download>Download KTP</a></p>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-4">
                                <h6 class="mb-2">KK Santri:</h6>
                                @if ($santri->kk_santri === null)
                                    <div class="bg-light" style="width: 440px; border-radius:20px;">
                                        <p class="text-center text-secondary"
                                            style="padding-top: 100px; padding-bottom:100px;">Gambar tidak ada.</p>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img src="{{ asset('berkas_santri/kk_santri/' . $santri->kk_santri) }}"
                                            alt="" style="max-width: 440px; border-radius: 20px;">
                                        <p class="mt-2"><a
                                                href="{{ asset('berkas_santri/kk_santri/' . $santri->kk_santri) }}"
                                                download>Download KK</a></p>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-4">
                                <h6 class="mb-2">Akta Santri:</h6>
                                @if ($santri->akta_santri === null)
                                    <div class="bg-light" style="width: 440px; border-radius:20px;">
                                        <p class="text-center text-secondary"
                                            style="padding-top: 100px; padding-bottom:100px;">Gambar tidak ada.</p>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img src="{{ asset('berkas_santri/akta_santri/' . $santri->akta_santri) }}"
                                            alt="" style="max-width: 440px; border-radius: 20px;">
                                        <p class="mt-2"><a
                                                href="{{ asset('berkas_santri/akta_santri/' . $santri->akta_santri) }}"
                                                download>Download Akta</a></p>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-4">
                                <h6 class="mb-2">Pas Foto Santri:</h6>
                                @if ($santri->pas_foto_santri === null)
                                    <div class="bg-light" style="width: 440px; border-radius:20px;">
                                        <p class="text-center text-secondary"
                                            style="padding-top: 100px; padding-bottom:100px;">Gambar tidak ada.</p>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img src="{{ asset('berkas_santri/pas_foto_santri/' . $santri->pas_foto_santri) }}"
                                            alt="" style="max-width: 440px; border-radius: 20px;">
                                        <p class="mt-2"><a
                                                href="{{ asset('berkas_santri/pas_foto_santri/' . $santri->pas_foto_santri) }}"
                                                download>Download Akta</a></p>
                                    </div>
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
    @endforeach --}}

    <!-- Modal Delete -->
    @foreach ($santris as $santri)
        <div class="modal fade" id="deleteModal{{ $santri->id_santri }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $santri->id_santri }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <form id="deleteForm" method="post"
                        action="{{ url('/admin/santri/delete/' . $santri->id_santri) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body text-center">
                            <img src="{{ asset('images/local/danger.png') }}" width="80px" alt="">
                            <h3 class="mt-4">Anda yakin ingin hapus data {{ $santri->nama_santri }} ?</h3>
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
    <script>
        $(document).ready(function() {
            $('#tableSantri').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('santri') }}",
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
                    // Kolom nama santri
                    {
                        data: 'nama_santri',
                        name: 'nama_santri'
                    },
                    // Kolom tempat tanggal lahir santri
                    {
                        data: 'tempat_tanggal_lahir_santri',
                        name: 'tempat_tanggal_lahir_santri'
                    },
                    // Kolom alamat santri
                    {
                        data: 'alamat_santri',
                        name: 'alamat_santri'
                    },
                    // Kolom nomor HP santri
                    {
                        data: 'no_hp_santri',
                        name: 'no_hp_santri'
                    },
                    // Kolom status santri
                    {
                        data: 'status_santri',
                        name: 'status_santri',
                        render: function(data, type, full, meta) {
                            if (data === 'pulang') {
                                return '<span class="badge badge-pill badge-primary">Pulang</span>';
                            } else {
                                return '<span class="badge badge-pill badge-success">Menetap</span>';
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
                                '<a data-placement="top" title="Info" href="/admin/santri/' + full
                                .id_santri + '/info">' +
                                '<i class="ri-information-line"></i>' +
                                '</a>' +
                                '<a data-placement="top" title="Delete" href="#" data-target="#deleteModal' +
                                full.id_santri + '" data-toggle="modal" data-id="' + full
                                .id_santri + '">' +
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
