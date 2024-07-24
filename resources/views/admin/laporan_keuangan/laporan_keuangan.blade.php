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
                <h5 class="mb-0">Laporan Keuangan</h5>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/beranda') }}">Main</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan Keuangan</li>
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
        <!-- Card -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                        <div class="iq-card-body pb-0">
                            <div class="rounded-circle iq-card-icon iq-bg-primary"><i class="ri-exchange-dollar-fill"></i>
                            </div>
                            <span class="float-right line-height-6">Pemasukan Pondok</span>
                            <div class="text-center mt-3">
                                <h2 class="mb-5"><span
                                        class="">{{ 'Rp. ' . number_format($totalpemasukan, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                        <div class="iq-card-body pb-0">
                            <div class="rounded-circle iq-card-icon iq-bg-warning"><i class="ri-shopping-cart-line"></i>
                            </div>
                            <span class="float-right line-height-6">Total Pengeluaran</span>
                            <div class="text-center mt-3">
                                <h2 class="mb-5"><span
                                        class="">{{ 'Rp. ' . number_format($totalpengeluaran, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                        <div class="iq-card-body pb-0">
                            <div class="rounded-circle iq-card-icon iq-bg-success"><i class="ri-bar-chart-grouped-line"></i>
                            </div>
                            <span class="float-right line-height-6">Total Keuangan</span>
                            <div class="text-center mt-3">
                                <h2 class="mb-5"><span
                                        class="">{{ 'Rp. ' . number_format($totalkeuangan, 0, ',', '.') }}</span>
                            </div>
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
        {{-- Grafik Keuangan --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height fadeInUp p-2">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Grafik Keuangan</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div id="chart_keuangan"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Tabel Pemasukan --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Pemasukan Pondok</h4>
                            </div>
                            <div class="col text-right">
                                <button id="exportPemasukanExcel" class="btn text-white"
                                    style="background-color: #209e62;"><i class="ri-file-excel-2-fill"></i>
                                    Export</button>
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
                                            <th>Asal Pemasukan</th>
                                            <th>Jumlah Pemasukan</th>
                                            <th>Diterima Oleh</th>
                                            <th>Jenis Pemasukan</th>
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
        {{-- Tabel Pengeluran --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Pengeluaran Pondok</h4>
                            </div>
                            <div class="col text-right">
                                <button id="exportPengeluaranExcel" class="btn text-white"
                                    style="background-color: #209e62"><i class="ri-file-excel-2-fill"></i> Export</button>
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
@endsection
@section('js')
    {{-- Chart keuangan --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data from PHP
            const chartData = @json($chartDataKeuangan);

            // Extract data for chart
            const pemasukan = chartData.map(item => item.total_pemasukan);
            const pengeluaran = chartData.map(item => item.total_pengeluaran);
            const bulanTahun = chartData.map(item => {
                const namaBulan = new Date(item.tahun, item.bulan - 1, 1).toLocaleDateString('id-ID', {
                    month: 'long'
                });
                return `${namaBulan} ${item.tahun}`;
            });

            // Configure and render chart
            const chartKeuangan = {
                chart: {
                    height: 407,
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [2, 3],
                    curve: 'smooth',
                    dashArray: [0, 5]
                },
                colors: ['#00ca00', '#007bff'],
                series: [{
                        name: "Pemasukan",
                        type: 'area',
                        data: pemasukan
                    },
                    {
                        name: "Pengeluaran",
                        type: 'line',
                        data: pengeluaran
                    }
                ],
                fill: {
                    opacity: [0.2, 1],
                    gradient: {
                        inverseColors: false,
                        shade: 'light',
                        type: "vertical",
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 100, 100]
                    }
                },
                legend: {
                    show: false
                },
                markers: {
                    size: 0,
                    hover: {
                        sizeOffset: 6
                    }
                },
                xaxis: {
                    categories: bulanTahun
                },
                yaxis: {
                    labels: {
                        show: true
                    }
                },
                tooltip: {
                    y: [{
                            title: {
                                formatter: val => val + " (Rp)"
                            }
                        },
                        {
                            title: {
                                formatter: val => val + " (Rp)"
                            }
                        }
                    ]
                },
                grid: {
                    borderColor: '#f1f1f1'
                }
            };

            const chartKeuanganInstance = new ApexCharts(document.querySelector("#chart_keuangan"), chartKeuangan);
            chartKeuanganInstance.render();
        });
    </script>

    {{-- Datatable Pemasukan --}}
    <script>
        $(document).ready(function() {
            $('#tablePemasukan').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getPemasukan') }}",
                columns: [{
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'tanggal_pemasukan',
                        name: 'tanggal_pemasukan',
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
                        data: 'santri.nama_santri',
                        name: 'santri.nama_santri',
                        render: function(data, type, full, meta) {
                            if (full.santri.nama_santri == 'Sumbangan') {
                                return 'Sumbangan luar';
                            } else {
                                return 'Santri : ' + full.santri.nama_santri
                            }
                        }
                    },
                    {
                        data: 'jumlah_pemasukan',
                        name: 'jumlah_pemasukan',
                        render: function(data, type, full, meta) {
                            return 'Rp. ' + data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                    },
                    {
                        data: 'user.nama_admin',
                        name: 'user.nama_admin'
                    },
                    {
                        data: 'jenis_pemasukan',
                        name: 'jenis_pemasukan',
                        render: function(data, type, full, meta) {
                            switch (full.jenis_pemasukan) {
                                case 'daftar_ulang':
                                    return '<span class="badge badge-pill badge-danger">Daftar Ulang</span>';
                                case 'iuran_bulanan':
                                    return '<span class="badge badge-pill badge-warning">Iuran Bulanan</span>';
                                case 'iru':
                                    return '<span class="badge badge-pill badge-success">Tamrin</span>';
                                default:
                                    return '<span class="badge badge-pill badge-primary">Lainnya</span>';
                            }
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

    {{-- Datatable Pengeluaran --}}
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
                    }
                ],
                lengthMenu: [
                    [10, 25, 50, 100, -1], // Jumlah entries per halaman, -1 untuk Tampilkan Semua Data
                    ['10', '25', '50', '100', 'Semua']
                ]
            });

        });
    </script>

    {{-- Export Data --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk menangani ekspor Excel
            function exportToExcel(exportButtonId, tableId, fileName) {
                const exportButton = document.getElementById(exportButtonId);
                const table = document.getElementById(tableId);

                if (!table) {
                    console.error(`Table with ID '${tableId}' not found.`);
                    return;
                }

                exportButton.addEventListener('click', function() {
                    // Mengonversi seluruh tabel menjadi objek lembar kerja
                    const ws = XLSX.utils.table_to_sheet(table);

                    // Membuat buku kerja baru
                    const wb = XLSX.utils.book_new();

                    // Menambahkan lembar kerja ke buku kerja
                    XLSX.utils.book_append_sheet(wb, ws, 'Data');

                    // Menyimpan file Excel
                    XLSX.writeFile(wb, fileName);
                });
            }

            // Memanggil fungsi untuk tombol "Export to Excel" dengan parameter yang sesuai
            exportToExcel('exportPemasukanExcel', 'tablePemasukan', 'pemasukan.xlsx');
            exportToExcel('exportPengeluaranExcel', 'tablePengeluaran', 'pengeluaran.xlsx');
        });
    </script>
@endsection
