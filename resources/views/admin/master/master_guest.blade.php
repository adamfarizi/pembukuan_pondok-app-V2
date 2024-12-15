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
                            @foreach ($guests as $guest)
                                <form action="{{ route('master_guest_save', $guest->id_guest) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="table-responsive pb-3 pt-3 px-3">
                                        <table id="tableEditPondok" class="table" role="grid"
                                            style="width: 100%; min-height: 500px;">
                                            <thead>
                                                <tr>
                                                    <th>Field</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($guests as $guest)
                                                    <tr>
                                                        <td>Visi</td>
                                                        <td>
                                                            <textarea class="form-control" name="visi" rows="3">{{ $guest->visi }}</textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Misi</td>
                                                        <td>
                                                            @if (!empty($guest->misi))
                                                                @foreach ($guest->misi as $misi)
                                                                    <ul id="missionList"
                                                                        style="list-style-type: none; padding-left: 0;">
                                                                        <li
                                                                            style="display: flex; align-items: center; margin-bottom: 10px;">
                                                                            <input class="form-control" name="misi[]"
                                                                                style="flex: 1; margin-right: 10px;"
                                                                                value="{{ $misi->misi }}" />
                                                                            <i class="ri-delete-bin-line remove-mission"
                                                                                style="cursor: pointer; color: red; font-size: 20px;"
                                                                                data-toggle="modal"
                                                                                data-target="#delete_misi{{ $misi->id_misi }}"></i>
                                                                        </li>
                                                                    </ul>
                                                                @endforeach
                                                            @endif
                                                            <button type="button" class="btn btn-primary"
                                                                id="addMissionButton">Tambah Misi</button>
                                                        </td>
                                                    </tr>
                                                    <tr><td>Rekening</td>
                                                        <td>
                                                            @if (!empty($guest->rekening))
                                                                @foreach ($guest->rekening as $rekening)
                                                                    <ul id="rekeningList"
                                                                        style="list-style-type: none; padding-left: 0;">
                                                                        <li
                                                                            style="display: flex; align-items: center; margin-bottom: 10px;">
                                                                            <input class="form-control" name="rekening[]"
                                                                                style="flex: 1; margin-right: 10px;"
                                                                                value="{{ $rekening->rekening }}" />
                                                                            <i class="ri-delete-bin-line remove-mission"
                                                                                style="cursor: pointer; color: red; font-size: 20px;"
                                                                                data-toggle="modal"
                                                                                data-target="#delete_rekening{{ $rekening->id_rekening }}"></i>
                                                                        </li>
                                                                    </ul>
                                                                @endforeach
                                                            @endif
                                                            <button type="button" class="btn btn-primary" id="addRekeningButton">Tambah Rekening</button>
                                                        </td>                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>Foto</td>
                                                        <td>
                                                            @if (!empty($guest->foto))
                                                                <div class="mb-3">
                                                                    @foreach ($guest->foto as $fotos)
                                                                        <div
                                                                            style="position: relative; display: inline-block; margin-top: 10px;">
                                                                            <img src="{{ asset('gambar_pondok/' . $fotos->foto) }}"
                                                                                alt="{{ $fotos->foto }}"
                                                                                style="max-width: 200px;">
                                                                                <button type="button" class="close delete-image" data-toggle="modal"
                                                                                data-target="#delete_foto{{ $fotos->id_foto }}" style="position: absolute; top: 5px; right: 5px; background-color: transparent; border: none;">
                                                                                <i class="ri-delete-bin-line" alt="Delete" style="cursor: pointer; color: red; font-size: 20px;"></i>
                                                                            </button>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                            <div class="upload__box">
                                                                <input type="file" class="upload__inputfile"
                                                                    name="foto[]" multiple data-max_length="20">
                                                                <div class="upload__img-wrap"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lokasi</td>
                                                        <td>
                                                            <input type="text" class="form-control" name="lokasi"
                                                                value="{{ $guest->lokasi }}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Link Gmaps Lokasi</td>
                                                        <td>
                                                            <input type="text" class="form-control" name="gmaps_link"
                                                                value="{{ $guest->linkgmaps }}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nomor Telepon</td>
                                                        <td>
                                                            <input type="text" class="form-control" name="no_tlp"
                                                                value="{{ $guest->no_tlp }}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td>
                                                            <input type="email" class="form-control" name="email"
                                                                value="{{ $guest->email }}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Instagram</td>
                                                        <td>
                                                            <input type="text" class="form-control" name="instagram"
                                                                value="{{ $guest->instagram }}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Youtube</td>
                                                        <td>
                                                            <input type="text" class="form-control" name="youtube"
                                                                value="{{ $guest->youtube }}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Facebook</td>
                                                        <td>
                                                            <input type="text" class="form-control" name="facebook"
                                                                value="{{ $guest->facebook }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Misi -->
    @foreach ($guest->misi as $misi)
        <div class="modal fade" id="delete_misi{{ $misi->id_misi }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $misi->id_misi }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <form id="deleteForm" method="post"
                        action="{{ url('/admin/master_guest/delete_misi/' . $misi->id_misi) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body text-center">
                            <img src="{{ asset('images/local/danger.png') }}" width="80px" alt="">
                            <h3 class="mt-4">Anda yakin ingin hapus {{ $misi->misi }} ?</h3>
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

    <!-- Modal Delete Rekening -->
    @foreach ($guest->rekening as $rekening)
        <div class="modal fade" id="delete_rekening{{ $rekening->id_rekening }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $rekening->id_rekening }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <form id="deleteForm" method="post"
                        action="{{ url('/admin/master_guest/delete_rekening/' . $rekening->id_rekening) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body text-center">
                            <img src="{{ asset('images/local/danger.png') }}" width="80px" alt="">
                            <h3 class="mt-4">Anda yakin ingin hapus {{ $rekening->rekening }} ?</h3>
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

    <!-- Modal Delete Foto -->
    @foreach ($guest->foto as $fotos)
        <div class="modal fade" id="delete_foto{{ $fotos->id_foto }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $fotos->id_foto }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <form id="deleteForm" method="post"
                        action="{{ url('/admin/master_guest/delete_foto/' . $fotos->id_foto) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body text-center">
                            <img src="{{ asset('images/local/danger.png') }}" width="80px" alt="">
                            <h3 class="mt-4">Anda yakin ingin hapus?</h3>
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
        $('#tablePengeluaran').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ secure_url('pengeluaran') }}",
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
               // Kolom nama pengeluar
               {
                    data: 'nama_pengeluar',
                    name: 'nama_pengeluar',
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
                {
                    data: 'id_pengeluaran',
                    searchable: false,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return '<div class="d-flex align-items-center">' +
                            '<a data-placement="top" title="Bukti" href="#"' +
                            'data-target="#infoModal' + full.id_pengeluaran +
                            '" data-toggle="modal" ' +
                            'data-id="' + full.id_pengeluaran + '">' +
                            '<i class="ri-information-line"></i> Bukti' +
                            '</a>' +
                            '</div>';
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
    <script>
        jQuery(document).ready(function() {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function(f, index) {

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
                                reader.onload = function(e) {
                                    var html =
                                        "<div class='upload__img-box'><div style='background-image: url(" +
                                        e.target.result + ")' data-number='" + $(
                                            ".upload__img-close").length + "' data-file='" + f
                                        .name +
                                        "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function(e) {
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

        document.getElementById('addMissionButton').addEventListener('click', function() {
            var missionList = document.getElementById('missionList');

            var newLi = document.createElement('li');
            newLi.style.display = 'flex';
            newLi.style.alignItems = 'center';
            newLi.style.marginBottom = '10px';
            newLi.innerHTML =
                '<input class="form-control" name="misi[]" placeholder="Masukkan misi baru" style="flex: 1; margin-right: 10px;"/>' +
                '<i class="ri-delete-bin-line remove-mission" style="cursor: pointer; color: red; font-size: 20px;"></i>';

            missionList.appendChild(newLi);
        });
    </script>
    <script>
        document.getElementById('addRekeningButton').addEventListener('click', function() {
        const rekeningList = document.getElementById('rekeningList');
        const newRekeningItem = document.createElement('li');
        newRekeningItem.style.display = 'flex';
        newRekeningItem.style.alignItems = 'center';
        newRekeningItem.style.marginBottom = '10px';

        newRekeningItem.innerHTML = `
            <input class="form-control" name="rekening[]" placeholder="Silahkan masukkan nama bank dan no rekening" style="flex: 1; margin-right: 10px;" />
            <i class="ri-delete-bin-line remove-rekening" style="cursor: pointer; color: red; font-size: 20px;"></i>
        `;

        newRekeningItem.querySelector('.remove-rekening').addEventListener('click', function() {
            rekeningList.removeChild(newRekeningItem);
        });

        rekeningList.appendChild(newRekeningItem);
    });
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
