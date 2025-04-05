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
                                            <th></th>
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
                        <!-- Nama Santri -->
                        <div class="form-group">
                            <label for="nama_santri">Nama Santri <span class="text-danger">*</span></label>
                            <select class="form-control" name="nama_santri" id="nama_santri"
                                style="width: 100%"></select>
                        </div>

                        <!-- Jumlah Tagihan -->
                        <div class="form-group mt-3">
                            <label>Tagihan Awal</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" id="jumlah_tagihan" name="jumlah_tagihan"
                                    placeholder="0" readonly>
                            </div>
                        </div>

                        <!-- Konten Potongan Harga -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="true" id="showPotonganHarga"
                                name="status_potongan_harga">
                            <label class="form-check-label" for="showPotonganHarga">
                                Potongan Harga
                            </label>
                        </div>
                        <div class="form-group" id="potonganGroup" style="display: none;">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" id="potongan_harga" name="potongan_harga"
                                    placeholder="0" min="0">
                            </div>
                        </div>

                        <!-- Garis Pemisah -->
                        <hr class="mt-3 mb-3" style="border-top: 1px dashed #000; display: none;" id="dashedHr">

                        <!-- Total Setelah Potongan -->
                        <div class="form-group" id="akhirGroup" style="display: none">
                            <label>Tagihan Akhir</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control font-weight-bold" id="jumlah_akhir"
                                    name="jumlah_akhir" placeholder="0" readonly>
                            </div>
                        </div>

                        <!-- Cicilan -->
                        <div class="form-group mt-3">
                            <label for="jenisPembayaran">Jenis Pembayaran <span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis_bayar" id="jenisPembayaran" required>
                                <option value="lunas">Lunas</option>
                                <option value="cicilan">Cicilan</option>
                            </select>
                        </div>
                        <div class="form-group" id="jumlahBayarGroup" style="display: none;">
                            <label for="jumlah_bayar">Nominal Bayar Awal <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" placeholder="0" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    @foreach ($pembayarans_lunas as $tamrin)
        <div class="modal fade" id="deleteModal{{ $tamrin->id_pembayaran }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $tamrin->id_pembayaran }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <form action="{{ url('/admin/tamrin/delete/' . $tamrin->id_pembayaran . '/action') }}"
                        id="deleteForm" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body text-center">
                            <img src="{{ asset('images/local/danger.png') }}" width="80px" alt="Warning Icon"
                                class="mb-3">

                            <h4 class="font-weight-bold text-danger">Konfirmasi Pembatalan Pembayaran</h4>
                            <p class="text-muted">Anda yakin ingin membatalkan pembayaran ini? Tindakan ini tidak dapat
                                dikembalikan.</p>

                            <div class="text-left border rounded p-1 bg-light d-inline-block" style="width: 90%">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody class="text-secondary">
                                            <tr>
                                                <td><strong>Nama Santri</strong></td>
                                                <td>: {{ $tamrin->santri->nama_santri }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tanggal Pembayaran</strong></td>
                                                <td>:
                                                    {{ \Carbon\Carbon::parse($tamrin->tanggal_pembayaran)->format('d-m-Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Jam Pembayaran</strong></td>
                                                <td>:
                                                    {{ \Carbon\Carbon::parse($tamrin->tanggal_pembayaran)->format('H:i:s') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Jumlah Pembayaran</strong></td>
                                                <td>: Rp. {{ number_format($tamrin->jumlah_pembayaran, 0, ',', ',') }}</td>
                                            </tr>                                            
                                            <tr>
                                                <td><strong>Diterima Oleh</strong></td>
                                                <td>: {{ $tamrin->user->nama_admin }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger px-4e">Batalkan Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('js')
    {{-- Cicilan --}}
    <script>
        document.getElementById('jenisPembayaran').addEventListener('change', function() {
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
                            var jumlahPembayaran = full.jumlah_pembayaran_sebelum_potongan; // Jumlah awal (total harga)
                            var jumlahPotongan = full.jumlah_potongan || 0; // Potongan harga, jika ada
                            var totalSetelahPotongan = data;

                            // Format harga dalam format Rupiah
                            var formattedJumlahPembayaran = 'Rp. ' + jumlahPembayaran.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            var formattedJumlahPotongan = 'Rp. ' + jumlahPotongan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            var formattedTotalSetelahPotongan = 'Rp. ' + totalSetelahPotongan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                            // Membuat tampilan dalam format tabel
                            var tableContent = `
                                <table class="table table-borderless m-0">
                                    <tr>
                                        <td class="pb-0 pt-1">Tagihan Awal</td>
                                        <td class="pb-0 pt-1 text-right">${formattedJumlahPembayaran}</td>
                                    </tr>
                                    <tr>
                                        <td class="pb-0 pt-1">Potongan</td>
                                        <td class="pb-0 pt-1 text-right">${formattedJumlahPotongan}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><hr style="border: 1px solid #e6e6e6; margin: 0;"></td>
                                        <td><hr style="border: 1px solid #8a8a8a; margin: 0;"></td>
                                    </tr>
                                    <tr>
                                        <td class="pb-0 pt-1">Tagihan Akhir</td>
                                        <td class="pb-0 pt-1 text-right"><strong>${formattedTotalSetelahPotongan}</strong></td>
                                    </tr>
                                </table>
                            `;

                            if (jumlahPotongan <= 0) {
                                return `
                                <table class="table table-borderless m-0" style="width: 90%;">
                                    <tr>
                                        <td class="pb-0 pt-1">Tagihan Akhir</td>
                                        <td class="pb-0 pt-1 text-right"><strong>${formattedTotalSetelahPotongan}</strong></td>
                                    </tr>
                                </table>`;
                            } else {
                                return tableContent;
                            }
                        }
                    },
                    // Kolom diterima oleh
                    {
                        data: 'user.nama_admin',
                        name: 'user.nama_admin',
                        render: function(data, type, full, meta) {
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
                        render: function(data, type, full, meta) {
                            if (full.status_pembayaran == 'belum_lunas') {
                                // return '<span class="badge badge-pill badge-danger">Belum lunas</span>';
                                return '<div class="d-flex flex-column">' +
                                    '<span class="badge badge-pill badge-danger p-2">Belum lunas</span>' +
                                    '<a class="badge badge-pill badge-success p-2 mt-2" title="Info cicilan" href="/admin/tamrin/cicilan/' +
                                    full
                                    .id_pembayaran + '/bayar">' +
                                    '<i class="ri-information-line"></i> Detail cicilan' +
                                    '</a>' +
                                    '</div>';
                            } else {
                                return '<div class="d-flex flex-column">' +
                                    '<span class="badge badge-pill badge-primary p-2">Lunas</span>' +
                                    '</div>';
                            }
                        }
                    },
                    // Kolom cancel Payment
                    {
                        data: 'id_pembayaran',
                        name: 'id_pembayaran',
                        render: function(data, type, full, meta) {
                            return '<div class="d-flex align-items-center list-user-action">' +
                                '<a data-placement="top" title="Delete" href="#" data-target="#deleteModal' +
                                data + '" data-toggle="modal" data-id="' + data + '">' +
                                '<i class="ri-delete-bin-line"></i>' +
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

    {{-- Select2 --}}
    <script>
        $(document).ready(function() {
            var select2Url = "{{ secure_url('admin/tamrin/seletc2') }}";

            $('#nama_santri').select2({
                dropdownParent: $('#exampleModalCenter'),
                minimumInputLength: 2,
                placeholder: 'Pilih Nama Santri',
                width: '100%',
                dropdownAutoWidth: true,
                dropdownCssClass: 'select2-dropdown-custom',
                templateResult: function(data) {
                    if (!data.id) {
                        return data.text;
                    }
                    return $('<span>').text(data.text).addClass('select2-result-item');
                },
                templateSelection: function(data) {
                    if (!data.id) {
                        return data.text;
                    }
                    return $('<span>').text(data.text).addClass('select2-selection-item');
                },
                ajax: {
                    url: select2Url,
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data.map(function(res) {
                                return {
                                    text: res.santri.nama_santri,
                                    id: res.santri.id_santri,
                                    jumlah_pembayaran: res.jumlah_pembayaran
                                };
                            })
                        };
                    }
                }
            });

            // Add custom styling after initialization
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

            // Mengatur URL aksi formulir berdasarkan id_santri yang dipilih
            $('#nama_santri').on('change', function() {
                var selectedData = $('#nama_santri').select2('data')[0];
                if (selectedData && selectedData.jumlah_pembayaran) {
                    $('#jumlah_tagihan').val(selectedData.jumlah_pembayaran);
                } else {
                    $('#jumlah_tagihan').val(0);
                }
                
                var selectedId = this.value;
                var form = document.getElementById('updateForm');
                var actionUrl = "{{ secure_url('/admin/tamrin/edit') }}/" + selectedId + "/action";
                form.setAttribute('action', actionUrl);

                var submitButton = document.getElementById('submitBtn');
                // Cek apakah ada nilai yang dipilih
                if (this.value) {
                    submitButton.disabled = false; // Mengaktifkan tombol jika ada pilihan
                } else {
                    submitButton.disabled = true; // Menonaktifkan tombol jika tidak ada pilihan
                }
            });
        });
    </script>

    {{-- Input Potongan Harga --}}
    <script>
        document.getElementById('showPotonganHarga').addEventListener('change', function() {
            var potonganGroup = document.getElementById('potonganGroup');
            var dashedHr = document.getElementById('dashedHr');
            var akhirGroup = document.getElementById('akhirGroup');

            if (this.checked) {
                potonganGroup.style.display = 'block';
                akhirGroup.style.display = 'block';
                dashedHr.style.display = 'block';
            } else {
                potonganGroup.style.display = 'none';
                akhirGroup.style.display = 'none';
                dashedHr.style.display = 'none';
                document.getElementById('potongan_harga').value = 0;
            }
            hitungTotal();
        });

        document.getElementById('potongan_harga').addEventListener('input', hitungTotal);
        document.getElementById('jumlah_tagihan').addEventListener('input', hitungTotal);

        function hitungTotal() {
            var jumlahTagihan = parseFloat(document.getElementById('jumlah_tagihan').value) || 0;
            var potonganHarga = parseFloat(document.getElementById('potongan_harga').value) || 0;

            var totalAkhir = jumlahTagihan - potonganHarga;
            document.getElementById('jumlah_akhir').value = totalAkhir;
        }
    </script>
@endsection
