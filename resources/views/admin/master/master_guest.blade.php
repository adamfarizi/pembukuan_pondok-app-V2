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
                <h5 class="mb-0">Master Guest</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Master Guest</li>
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
                                        <h5 class="mb-0 text-white line-height">Nama User</h5>
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
                                <h4 class="card-title">Data Guest</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <form action="/update-pondok" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="table-responsive pb-3 pt-3 px-3">
                                    <table id="tableEditPondok" class="table" role="grid" style="width: 100%; min-height: 500px;">
                                        <thead>
                                            <tr>
                                                <th>Field</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Visi</td>
                                                <td>
                                                    <textarea class="form-control" name="visi" rows="3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Misi</td>
                                                <td>
                                                    <textarea class="form-control" name="misi" rows="3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Foto</td>
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
                                            <tr>
                                                <td>Lokasi</td>
                                                <td>
                                                    <input type="text" class="form-control" name="lokasi" value="lokasi">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Link Gmaps Lokasi</td>
                                                <td>
                                                    <input type="text" class="form-control" name="gmaps_link" value="link gmaps">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Telepon</td>
                                                <td>
                                                    <input type="text" class="form-control" name="telepon" value="no telp">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>
                                                    <input type="email" class="form-control" name="email" value="email">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Instagram</td>
                                                <td>
                                                    <input type="text" class="form-control" name="instagram" value="instgram">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Youtube</td>
                                                <td>
                                                    <input type="text" class="form-control" name="youtube" value="youtube">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Facebook</td>
                                                <td>
                                                    <input type="text" class="form-control" name="facebook" value="facebook">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
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
                        data: 'nama_admin',
                        name: 'nama_admin'
                    },
                    {
                        data: 'email',
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
                                '<a data-placement="top" title="Edit" href="#" data-target="#editModal' +
                                full.id_admin + '" data-toggle="modal" data-id="' + full
                                .id_admin + '">' +
                                '<i class="ri-pencil-line"></i>' +
                                '</a>' +
                                '<a data-placement="top" title="Delete" href="#" data-target="#deleteModal' +
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
    <script>
        jQuery(document).ready(function () {
        ImgUpload();
        });

        function ImgUpload() {
        var imgWrap = "";
        var imgArray = [];

        $('.upload__inputfile').each(function () {
            $(this).on('change', function (e) {
            imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
            var maxLength = $(this).attr('data-max_length');

            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);
            var iterator = 0;
            filesArr.forEach(function (f, index) {

                if (!f.type.match('image.*')) {
                return;
                }

                if (imgArray.length > maxLength) {
                return false
                } else {
                var len = 0;
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i] !== undefined) {
                    len++;
                    }
                }
                if (len > maxLength) {
                    return false;
                } else {
                    imgArray.push(f);

                    var reader = new FileReader();
                    reader.onload = function (e) {
                    var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                    imgWrap.append(html);
                    iterator++;
                    }
                    reader.readAsDataURL(f);
                }
                }
            });
            });
        });

        $('body').on('click', ".upload__img-close", function (e) {
            var file = $(this).parent().data("file");
            for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i].name === file) {
                imgArray.splice(i, 1);
                break;
            }
            }
            $(this).parent().parent().remove();
        });
        }
    </script>
    <style>
        .upload__img-wrap {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
        }

        .upload__img-box {
        width: 200px;
        padding: 0 10px;
        margin-bottom: 12px;
        }

        .upload__img-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10px;
        right: 10px;
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;
        }

        .upload__img-close:after {
        content: "\2716";
        font-size: 14px;
        color: white;
        }

        .img-bg {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        padding-bottom: 100%;
        }
    </style>
@endsection
