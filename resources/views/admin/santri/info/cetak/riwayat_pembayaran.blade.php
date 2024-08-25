<!DOCTYPE html>
<html>
<head>
    <title>Kuitansi Pembayaran - {{ $tanggal }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            font-size: 18px;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
        .signature {
            margin-top: 30px;
            text-align: right;
        }
        .signature div {
            margin-bottom: 50px; /* Space for the signature */
        }
        .signature p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col" style="text-align: right">
      <img src="{{ asset('images/pondok/logo.png') }}" alt="Logo" class="bi me-2" width="50">
    </div>
    <div class="header col">
        <h2>Kuitansi Pembayaran</h2>
        <p>Tanggal: {{ $tanggal }}</p>
    </div>
    <div class="col" style="width: 100%">
    </div>
  </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Santri</th>
                <th>Jenis Pembayaran</th>
                <th>Jumlah</th>
                <th>Tanggal Pembayaran</th>
                <th>Admin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($riwayatPembayaran as $index => $pembayaran)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pembayaran->santri->nama_santri ?? 'Sumbangan' }}</td>
                    <td>
                        @if ($pembayaran->jenis_pembayaran == 'daftar_ulang')
                            Daftar Ulang
                        @elseif ($pembayaran->jenis_pembayaran == 'iuran_bulanan')
                            Iuran Bulanan
                        @else
                            Semester
                        @endif
                    </td>
                    <td>{{ 'RP ' . number_format($pembayaran->jumlah_pembayaran, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d F Y H:i') }}</td>
                    <td>{{ $pembayaran->user->nama_admin ?? 'Lainnya' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Terima kasih atas pembayaran Anda.</p>
    </div>

    <div class="row">
        <div class="col" style="width:150px">
        </div>
        <div class="col-5" style="text-align: center">
            <p style="margin-bottom: 50px">Mengetahui</p>
            <p>.....................................................</p>
            <p>{{ $riwayatPembayaran->first()->user->nama_admin ?? 'Lainnya' }}</p>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        window.print();
    };
</script>

</body>
</html>
